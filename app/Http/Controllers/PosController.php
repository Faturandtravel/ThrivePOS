<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PosController extends Controller
{
    public function dashboard()
    {
        return view('pos.dashboard');
    }

    public function cashier(Request $request)
    {
        $query = \App\Models\Product::with('category');
        
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->get();
        $categories = \App\Models\Category::all();

        return view('pos.cashier', compact('products', 'categories'));
    }


    public function storeOrder(Request $request)
    {
        $validated = $request->validate([
            'total' => 'required|numeric|min:0',
            'payment_method' => 'required|string|in:cash,xendit',
            'cash_amount' => 'nullable|numeric|min:0',
            'change_amount' => 'nullable|numeric',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        try {
            \Illuminate\Support\Facades\DB::beginTransaction();

            $order = \App\Models\Order::create([
                'total' => $validated['total'],
                'payment_method' => $validated['payment_method'],
                'cash_amount' => $validated['cash_amount'] ?? null,
                'change_amount' => $validated['change_amount'] ?? null,
                'payment_status' => $validated['payment_method'] === 'xendit' ? 'pending' : 'paid',
            ]);

            foreach ($validated['items'] as $item) {
                $product = \App\Models\Product::findOrFail($item['product_id']);
                
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Insufficient stock for {$product->name}");
                }

                $product->decrement('stock', $item['quantity']);

                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }

            $invoiceUrl = null;

            if ($validated['payment_method'] === 'xendit') {
                \Xendit\Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));

                $apiInstance = new \Xendit\Invoice\InvoiceApi();
                $create_invoice_request = new \Xendit\Invoice\CreateInvoiceRequest([
                    'external_id' => (string) $order->id,
                    'amount' => $validated['total'],
                    'description' => 'Payment for Order #' . $order->id,
                    'invoice_duration' => 86400, // 24 hours
                    'currency' => 'IDR',
                    'success_redirect_url' => route('xendit.success'),
                ]);

                $result = $apiInstance->createInvoice($create_invoice_request);
                
                $order->update([
                    'xendit_invoice_id' => $result['id'],
                    'xendit_invoice_url' => $result['invoice_url']
                ]);

                $invoiceUrl = $result['invoice_url'];
            }

            \Illuminate\Support\Facades\DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully',
                'order_id' => $order->id,
                'invoice_url' => $invoiceUrl
            ]);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function printReceipt(\App\Models\Order $order)
    {
        $order->load('items.product');
        $setting = \App\Models\Setting::first();
        return view('pos.receipt', compact('order', 'setting'));
    }

    public function setting()
    {
        $setting = \App\Models\Setting::first();
        return view('pos.setting', compact('setting'));
    }

    public function updateSetting(Request $request)
    {
        $validated = $request->validate([
            'store_name' => 'nullable|string|max:255',
            'store_phone' => 'nullable|string|max:255',
            'store_address' => 'nullable|string',
            'receipt_footer' => 'nullable|string',
            'receipt_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $setting = \App\Models\Setting::first() ?? new \App\Models\Setting();

        if ($request->hasFile('receipt_logo')) {
            if ($setting->receipt_logo && \Illuminate\Support\Facades\Storage::disk('public')->exists($setting->receipt_logo)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($setting->receipt_logo);
            }
            $path = $request->file('receipt_logo')->store('receipt_logos', 'public');
            $validated['receipt_logo'] = $path;
        } else {
            // keep the old logo
            unset($validated['receipt_logo']);
        }

        $setting->fill($validated);
        $setting->save();

        return redirect()->back()->with('success', 'Store settings updated successfully.');
    }

    public function checkPaymentStatus(\App\Models\Order $order)
    {
        return response()->json([
            'status' => $order->payment_status
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PosController extends Controller
{
    public function dashboard(Request $request)
    {
        $startDate = $request->query('start_date') ? \Carbon\Carbon::parse($request->query('start_date'))->startOfDay() : \Carbon\Carbon::now()->startOfMonth();
        $endDate = $request->query('end_date') ? \Carbon\Carbon::parse($request->query('end_date'))->endOfDay() : \Carbon\Carbon::now()->endOfDay();

        $today = \Carbon\Carbon::today();
        $yesterday = \Carbon\Carbon::yesterday();
        $startOfWeek = \Carbon\Carbon::now()->startOfWeek();
        $startOfLastWeek = \Carbon\Carbon::now()->subWeek()->startOfWeek();
        $startOfWeekSubSec = $startOfWeek->copy()->subSecond();
        $startOfMonth = \Carbon\Carbon::now()->startOfMonth();
        $startOfLastMonth = \Carbon\Carbon::now()->subMonth()->startOfMonth();
        $startOfMonthSubSec = $startOfMonth->copy()->subSecond();

        $salesToday = \App\Models\Order::where('payment_status', 'paid')
            ->whereDate('created_at', $today)
            ->sum('total');
        $salesYesterday = \App\Models\Order::where('payment_status', 'paid')
            ->whereDate('created_at', $yesterday)
            ->sum('total');
        
        $todayGrowth = $salesYesterday > 0 
            ? (($salesToday - $salesYesterday) / $salesYesterday) * 100 
            : ($salesToday > 0 ? 100 : 0);

        $salesThisWeek = \App\Models\Order::where('payment_status', 'paid')
            ->whereBetween('created_at', [$startOfWeek, \Carbon\Carbon::now()])
            ->sum('total');
        $salesLastWeek = \App\Models\Order::where('payment_status', 'paid')
            ->whereBetween('created_at', [$startOfLastWeek, $startOfWeekSubSec])
            ->sum('total');
            
        $weekGrowth = $salesLastWeek > 0 
            ? (($salesThisWeek - $salesLastWeek) / $salesLastWeek) * 100 
            : ($salesThisWeek > 0 ? 100 : 0);

        $salesThisMonth = \App\Models\Order::where('payment_status', 'paid')
            ->whereBetween('created_at', [$startOfMonth, \Carbon\Carbon::now()])
            ->sum('total');
        $salesLastMonth = \App\Models\Order::where('payment_status', 'paid')
            ->whereBetween('created_at', [$startOfLastMonth, $startOfMonthSubSec])
            ->sum('total');
            
        $monthGrowth = $salesLastMonth > 0 
            ? (($salesThisMonth - $salesLastMonth) / $salesLastMonth) * 100 
            : ($salesThisMonth > 0 ? 100 : 0);

        // Filter charts and recent transactions by the selected date range
        $categorySales = \Illuminate\Support\Facades\DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('orders.payment_status', 'paid')
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->select('categories.name', \Illuminate\Support\Facades\DB::raw('SUM(order_items.subtotal) as total_sales'))
            ->groupBy('categories.id', 'categories.name')
            ->get();
            
        $categoryLabels = $categorySales->pluck('name')->toArray();
        $categoryData = $categorySales->pluck('total_sales')->toArray();

        $paymentMethods = \App\Models\Order::where('payment_status', 'paid')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select('payment_method', \Illuminate\Support\Facades\DB::raw('COUNT(*) as count'))
            ->groupBy('payment_method')
            ->get();
            
        $paymentLabels = [];
        $paymentData = [];
        foreach($paymentMethods as $pm) {
            $paymentLabels[] = ucfirst($pm->payment_method);
            $paymentData[] = $pm->count;
        }

        $recentTransactions = \App\Models\Order::with('items')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('pos.dashboard', compact(
            'salesToday', 'todayGrowth',
            'salesThisWeek', 'weekGrowth',
            'salesThisMonth', 'monthGrowth',
            'categoryLabels', 'categoryData',
            'paymentLabels', 'paymentData',
            'recentTransactions',
            'startDate', 'endDate'
        ));
    }

    public function transactions(Request $request)
    {
        $startDate = $request->query('start_date') ? \Carbon\Carbon::parse($request->query('start_date'))->startOfDay() : null;
        $endDate = $request->query('end_date') ? \Carbon\Carbon::parse($request->query('end_date'))->endOfDay() : null;

        $query = \App\Models\Order::with('items.product')->orderBy('created_at', 'desc');

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $orders = $query->paginate(15)->appends(request()->query());

        return view('pos.transactions', compact('orders', 'startDate', 'endDate'));
    }

    public function exportExcel(Request $request)
    {
        $startDate = $request->query('start_date') ? \Carbon\Carbon::parse($request->query('start_date'))->startOfDay() : \Carbon\Carbon::now()->startOfMonth();
        $endDate = $request->query('end_date') ? \Carbon\Carbon::parse($request->query('end_date'))->endOfDay() : \Carbon\Carbon::now()->endOfDay();

        $filename = 'transactions_' . $startDate->format('Ymd') . '_to_' . $endDate->format('Ymd') . '.xlsx';

        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\OrdersExport($startDate, $endDate), $filename);
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
        $users = \App\Models\User::orderBy('created_at', 'desc')->get();
        return view('pos.setting', compact('setting', 'users'));
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

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'nullable|string|max:255',
            'role' => 'required|string|in:kasir,super_admin',
        ]);

        $name = $validated['name'] ?? explode('@', $validated['email'])[0];

        \App\Models\User::create([
            'email' => $validated['email'],
            'name' => $name,
            'password' => bcrypt(\Illuminate\Support\Str::random(16)),
            'role' => $validated['role'],
        ]);

        return redirect()->back()->with('success_user', 'Akses staf berhasil ditambahkan.');
    }

    public function updateUser(Request $request, \App\Models\User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error_user', 'Anda tidak dapat mengubah peran Anda sendiri.');
        }

        if ($user->email === env('SUPER_ADMIN_EMAIL')) {
            return redirect()->back()->with('error_user', 'Peran Super Admin utama tidak dapat diubah.');
        }

        $validated = $request->validate([
            'role' => 'required|string|in:kasir,super_admin',
        ]);

        $user->update([
            'role' => $validated['role'],
        ]);

        return redirect()->back()->with('success_user', 'Peran staf berhasil diperbarui.');
    }

    public function destroyUser(\App\Models\User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error_user', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->back()->with('success_user', 'Akses staf berhasil dihapus.');
    }
}
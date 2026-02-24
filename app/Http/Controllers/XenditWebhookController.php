<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class XenditWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $xenditToken = env('XENDIT_WEBHOOK_TOKEN');

        if ($request->header('x-callback-token') !== $xenditToken) {
            Log::warning('Invalid Xendit Webhook Token', $request->all());
            return response()->json(['success' => false, 'message' => 'Invalid token'], 403);
        }

        $status = $request->input('status');
        $externalId = $request->input('external_id');
        $invoiceId = $request->input('id');

        Log::info('Xendit Webhook Received', $request->all());

        if ($status === 'PAID' || $status === 'SETTLED') {
            $order = Order::find($externalId);
            if ($order) {
                $order->update([
                    'payment_status' => 'paid',
                ]);
            }
        } else if ($status === 'EXPIRED') {
            $order = Order::find($externalId);
            if ($order) {
                $order->update([
                    'payment_status' => 'expired',
                ]);
            }
        }

        return response()->json(['success' => true]);
    }
}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk #{{ $order->id }}</title>
    @vite(['resources/css/app.css'])
    <style>
        @media print {
            body { 
                width: 80mm; 
                margin: 0; 
                padding: 0; 
                font-family: monospace; 
                font-size: 12px;
            }
            .no-print { display: none; }
        }
        body { width: 80mm; margin: 0 auto; padding: 10px; font-family: monospace; }
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
        .mb-2 { margin-bottom: 8px; }
        .my-4 { margin-top: 16px; margin-bottom: 16px; }
        .border-b { border-bottom: 1px dashed #000; padding-bottom: 8px; }
        table { width: 100%; border-collapse: collapse; }
        table td { padding: 4px 0; }
        table th { text-align: left; padding: 4px 0; border-bottom: 1px dashed #000; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
    </style>
</head>
<body>
    <div class="text-center mb-2">
        @if(isset($setting) && $setting->receipt_logo)
            <img src="{{ Storage::url($setting->receipt_logo) }}" alt="Logo" style="max-height: 60px; margin-bottom: 8px;">
        @endif
        <h2 style="margin:0;font-size:16px;font-weight:bold;">{{ $setting->store_name ?? 'THRIVE POS' }}</h2>
        @if(isset($setting) && $setting->store_address)
            <p style="margin:0;font-size:11px;white-space:pre-wrap;">{{ $setting->store_address }}</p>
        @endif
        <p style="margin:4px 0 0 0;font-weight:bold;">Struk #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
        <p style="margin:0;font-weight:bold;">{{ $order->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="my-4 border-b">
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="text-right">Jml</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product ? $item->product->name : 'Produk Tidak Dikenal' }}</td>
                    <td class="text-right">{{ $item->quantity }}</td>
                    <td class="text-right">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="my-4">
        <table>
            <tr>
                <td class="font-bold">Total</td>
                <td class="text-right font-bold">{{ number_format($order->total, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Metode Pembayaran</td>
                <td class="text-right">{{ strtoupper($order->payment_method) }}</td>
            </tr>
            @if($order->payment_method === 'cash')
            <tr>
                <td>Jumlah Tunai</td>
                <td class="text-right">{{ number_format($order->cash_amount ?? $order->total, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Kembalian</td>
                <td class="text-right">{{ number_format($order->change_amount, 0, ',', '.') }}</td>
            </tr>
            @elseif($order->payment_method === 'xendit')
            <tr>
                <td>Status</td>
                <td class="text-right">{{ strtoupper($order->payment_status) }}</td>
            </tr>
            @endif
        </table>
    </div>

    <div class="text-center mt-4" style="margin-top: 20px;">
        @if(isset($setting) && $setting->receipt_footer)
            <p style="white-space: pre-wrap;">{{ $setting->receipt_footer }}</p>
        @else
            <p class="font-bold">Terima Kasih!</p>
        @endif
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>

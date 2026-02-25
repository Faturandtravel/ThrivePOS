<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class OrdersExport implements FromQuery, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct(Carbon $startDate, Carbon $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function query()
    {
        return Order::with('items.product')->whereBetween('created_at', [$this->startDate, $this->endDate]);
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Date',
            'Time',
            'Total',
            'Payment Method',
            'Status',
            'Items Count',
            'Items Detail'
        ];
    }

    public function map($order): array
    {
        $itemsDetail = $order->items->map(function ($item) {
            return $item->product->name . ' (x' . $item->quantity . ')';
        })->implode(', ');

        return [
            $order->id,
            $order->created_at->format('Y-m-d'),
            $order->created_at->format('H:i:s'),
            'Rp ' . number_format($order->total, 0, ',', '.'),
            ucfirst($order->payment_method),
            ucfirst($order->payment_status),
            $order->items->count(),
            $itemsDetail
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'total',
        'payment_method',
        'cash_amount',
        'change_amount',
        'payment_status',
        'xendit_invoice_id',
        'xendit_invoice_url',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

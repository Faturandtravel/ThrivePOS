<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'store_name',
        'store_phone',
        'store_address',
        'receipt_footer',
        'receipt_logo',
    ];
}

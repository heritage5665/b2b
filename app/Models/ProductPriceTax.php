<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPriceTax extends Model
{
    protected $fillable = [
        'agency_id',
        'product_price_id',
        'tax',
        'amount'
    ];
    protected $table = 'product_price_taxes';

    const GST = 'gst';

    public static $__taxes = [
        self::GST => 'GST'
    ];
}
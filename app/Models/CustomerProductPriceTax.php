<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerProductPriceTax extends Model
{
    use HasFactory;
    protected $table = 'customer_product_price_taxes';

    protected $fillable = [
        'agency_id',
        'customer_id',
        'product_price_id',
        'tax'
    ];

    const AIRLINE_FEE_TAX = 'airline_fee_tax';

    public static $__taxes = [
        self::AIRLINE_FEE_TAX => 'Airline tax and Fee'
    ];
}

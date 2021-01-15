<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    protected $fillable = [
        'agency_id',
        'product_id',
        'price',
        'is_active',
        'updated_at',
        'created_at'
    ];

    public function taxes() {

        return $this->hasMany('App\Models\ProductPriceTax');
    }
    
    public function agencyTaxes() {

        return $this->hasMany('App\Models\CustomerProductPriceTax');
    }
}

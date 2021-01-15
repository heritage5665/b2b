<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightBooking extends Model
{
    use HasFactory;
    public function productBooking() {
        return $this->belongsTo('App\Models\ProductBooking');
    }

    public function getAgencyPrice() {

        $details = json_decode($this->productBooking->details);
        $return['base_price'] = $details->price;
        $totalPrice = $return['base_price'];
        $productPrice = $this->productBooking->product->price;
        $return['product_price'] = $productPrice;
        $user = auth()->user();
        $customer = $user->customer;

        $agencyGlobalTaxes = CustomerProductPriceTax::where('agency_id', $this->agency_id)->where('customer_id', $customer->id)
            ->where(function($q) use ($productPrice){
                $q->where('product_price_id', $productPrice->id)->orWhere('product_price_id', null);
            })
            ->get();
        if($agencyGlobalTaxes) {
            $customerTaxes = [];
            foreach($agencyGlobalTaxes as $taxes) {
                if(!$taxes->product_price_id) {
                    $customerTaxes[$taxes->tax] = $taxes;
                }
            }
            foreach($agencyGlobalTaxes as $taxes) {
                if($taxes->product_price_id) {
                    $customerTaxes[$taxes->tax] = $taxes;
                }
            }
            foreach($customerTaxes as $customerTax) {
                $totalPrice += $customerTax['amount'];
            }
            $return['taxes'] = $customerTaxes;
        }
        
        $return['total'] = ($totalPrice);
        return $return;
    }
}

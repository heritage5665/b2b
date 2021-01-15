<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\CustomerProductPriceTax;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    protected $user;
    public function global(Request $request) {

        $user = auth()->user();
        $markup = CustomerProductPriceTax::firstOrCreate([
            'customer_id' => $user->customer->id,
            'agency_id'=> $user->agency_id,
            'product_price_id' => null
        ]);
        if ($request->isMethod('post')) {

            $validated = $request->validate([
                'markup' => 'required|numeric',
            ]);
            $markup->amount = $request->input('markup');
            $markup->save();
        }
        
        
        return view('agency.settings.global', compact('markup'));
    }
}

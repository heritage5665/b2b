<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerProductPriceTax;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')
                    ->where('email', $request->get('email'))
                    ->where('agency_id', $request->agency->id)
            ],
            'phone' => 'required|string|max:10',
            'password' => 'required|string|confirmed|min:8',
        ]);

        
        $user = User::create([
            'name' => $request->name,
            'agency_name' => $request->agency_name,
            'agency_id' => $request->agency->id,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'user_type' => 'agency',
        ]);
		Auth::login($user);
        $customer = Customer::create([
            'agency_id' => $request->agency->id,
            'user_id' => $user->id,
            'customer_type' => 'agency'
        ]);
        $markup = CustomerProductPriceTax::create([
            'customer_id' => $customer->id,
            'agency_id'=> $request->agency->id,
            'tax' => 'airline_fee_tax',
            'amount' => 0
        ]);

         $destination = \public_path() . \DIRECTORY_SEPARATOR . "assets" . \DIRECTORY_SEPARATOR . "general";
        Storage::makeDirectory($destination);

        File::copyDirectory(\public_path("assets/n6ukpq3n98xvfkfzznxc"), $destination);

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }
}

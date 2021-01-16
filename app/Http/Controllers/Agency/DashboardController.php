<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\CustomerProductPriceTax;
use App\Models\FlightBooking;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    protected $user;
    public function index()
    {

        $this->user = auth()->user();

        $data = FlightBooking::whereHas('productBooking', function ($query) {
            $query->where('user_id', $this->user->id);
        })->where('agency_id', $this->user->agency_id)->with([
            'productBooking',
            'productBooking.product',
            'productBooking.product.flightTicketWithTrashed',
            'productBooking.product.flightTicket.flightTicketsDestination',
            'productBooking.product.flightTicket.flightTicketsDestination.fromAirport',
            'productBooking.product.flightTicket.flightTicketsDestination.toAirport',
            'productBooking.user'
        ])->has('productBooking')->take(8)->orderBy('id', 'desc')->get();

        return view('agency.dashboard.index', compact('data'));
    }

    public function sendTicket(Request $request, $flightBookingId)
    {

        $this->user = auth()->user();
        $agency = $request->agency;
        $customer = $this->user->customer;

        $flightBooking = FlightBooking::find($flightBookingId);
        $productBooking = $flightBooking->productBooking;
        $flightTicket = $productBooking->product->flightTicketWithTrashed;
        $airline = $flightTicket->airline;
        $flightTicketDestination = $flightTicket->flightTicketsDestination;
        $fromAirport = $flightTicketDestination->fromAirport;
        $toAirport = $flightTicketDestination->toAirport;
        $productPrice = $flightBooking->getAgencyPrice();
        $agencyCustomer = json_decode($productBooking->details);

        return view('agency.dashboard.send-ticket', compact('agency', 'customer', 'agencyCustomer', 'airline', 'flightTicket', 'fromAirport', 'toAirport', 'flightBooking', 'productPrice'));
    }

    public function updateMarkUp(Request $request)
    {

        $this->user = auth()->user();
        $agency = $request->agency;
        $customer = $this->user->customer;

        $data = $request->only(['name', 'value', 'pk']);

        $customerProductPriceTax = CustomerProductPriceTax::firstOrCreate(['agency_id' => $agency->id, 'customer_id' => $customer->id, 'product_price_id' => $data['pk'], 'tax' => 'airline_fee_tax']);
        $customerProductPriceTax->amount = $data['value'];
        $customerProductPriceTax->save();
        return response()->json(['success' => true, 'markup' => $data['value']], 201);
    }
}

<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\CustomerProductPriceTax;
use App\Models\FlightBooking;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendTicket;
use App\Models\Agency;

class BookingsController extends Controller
{
    protected $user;
    public function index() {

        $this->user = auth()->user();
        $upcomingFlightBookings = FlightBooking::whereHas('productBooking', function($query){
            $query->where('user_id', $this->user->id);
        })->whereHas('productBooking.product.flightTicket', function($query){
            $query->where('departure_date_time', '>=', date('Y-m-d H:i:s'));
        })->where('agency_id',$this->user->agency_id)->with([
            'productBooking',
            'productBooking.product',
            'productBooking.product.flightTicketWithTrashed',
            'productBooking.product.flightTicket.flightTicketsDestination',
            'productBooking.product.flightTicket.flightTicketsDestination.fromAirport',
            'productBooking.product.flightTicket.flightTicketsDestination.toAirport',
            'productBooking.user'
        ])->has('productBooking')->has('productBooking.product.flightTicket')->orderBy('id', 'desc')->get();
        
        return view('agency.bookings.index', compact('upcomingFlightBookings'));
    }

    
    public function sendTicket(Request $request) {

        $post = $request->only(['flight_booking_id', 'customer_information', 'customer_email']);
        $flightBookingId = $post['flight_booking_id'];

        $user = auth()->user();
        $flightBooking = FlightBooking::where('agency_id',$user->agency_id)->where('id', $flightBookingId)->with([
            'productBooking',
            'productBooking.product',
            'productBooking.product.flightTicket',
            'productBooking.product.flightTicket.flightTicketsDestination',
            'productBooking.product.flightTicket.flightTicketsDestination.fromAirport',
            'productBooking.product.flightTicket.flightTicketsDestination.toAirport',
            'productBooking.user'
        ])->first();

        $fromAirport = $flightBooking->productBooking->product->flightTicket->flightTicketsDestination->fromAirport;
        $toAirport = $flightBooking->productBooking->product->flightTicket->flightTicketsDestination->toAirport;
        $ticketUser = $flightBooking->productBooking->user;
        $passengerDetails = json_decode($flightBooking->productBooking->details, true);

        $data = [
            'logo' => '',
            'customer_name' => $passengerDetails['customer_name'],
            'customer_email' => $passengerDetails['email'],
            'customer_phone' => $passengerDetails['phone'],
            'agency_customer' => $user->customer,
            'agency_user' => $user,
            'pnr' => $flightBooking->pnr,
            'flight_ticket' => $flightBooking->productBooking->product->flightTicket,
            'passenger_details' => $passengerDetails,
            'flight_detail' => $flightBooking->productBooking->product->flightTicket->airline->name . ' ' . $flightBooking->productBooking->product->flightTicket->airline_code,
            'departure' => $fromAirport->cityName . ' ' . $fromAirport->code,
            'arriving' => $toAirport->cityName . ' ' . $toAirport->code,
            'booking_date' => date('M d, Y h:i A', strtotime($flightBooking->productBooking->created_at)),
            'takeoff' => date('M d, Y h:i A', strtotime($flightBooking->productBooking->product->flightTicket->departure_date_time)),
            'landing' => date('M d, Y h:i A', strtotime($flightBooking->productBooking->product->flightTicket->arrival_date_time)),
            'fare' => $flightBooking->productBooking->productPrice->price,
            'taxes' => $flightBooking->productBooking->productPrice->taxes,
            'agency' => Agency::find($user->agency_id),
            'productPrice' => $flightBooking->getAgencyPrice(),
            'customer_information' => $post['customer_information']
        ];

        $ticketDir = storage_path().DIRECTORY_SEPARATOR.'flight-tickets'.DIRECTORY_SEPARATOR.$user->agency_id;
        $ticketPath = storage_path().DIRECTORY_SEPARATOR.'flight-tickets'.DIRECTORY_SEPARATOR.$user->agency_id.DIRECTORY_SEPARATOR.md5($flightBooking->id.time()).'.pdf';

        if(!is_dir($ticketDir)) {
            mkdir($ticketDir, 0777, true);
        }
        $pdf = PDF::loadView('agency.bookings.ticket', $data)->save($ticketPath);
        $data['ticket'] = $ticketPath;

        $email = $post['customer_email'];

        Mail::to($email)->bcc($user->email)->send(new SendTicket($data));
        return redirect('bookings')->with('message', 'Ticket sent!');
    }
}

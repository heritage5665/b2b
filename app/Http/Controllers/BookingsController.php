<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Dto\Tickets;
use App\Models\Agency;
use App\Models\Payment;
use App\Models\ProductBooking;
use App\Models\User;
use App\Models\Product;

use App\Http\Requests\TickectRequest as Request;

use App\Mail\TicketPaid;
use Illuminate\Support\Facades\Mail;
//use Illuminate\Http\Request;
use DB;
use Validator;

class BookingsController extends Controller
{
    public function success(Request $request)
    {
        $ticket = Tickets::fromRequest($request);
        $agency = $request->agency;
        $user = User::find($ticket->userId);
        if (!$ticket->identifyHash($user->email)) {
            return view('bookings.fail');
        }
        $payment = Payment::find($ticket->paymentId);
        $payment->amount =  $ticket->paymentAmount;
        $productBooking = $payment->productBooking;
        $flightTicket = $productBooking->product->flightTicket;
        $flightBooking = $productBooking->flightBooking;
        $details = json_decode($productBooking->details, true);
        $pax = $details['pax'];

        $flightBooking->status = 'paid';
        $flightBooking->save();

        $flightTicket->number_of_sold_tickets = $flightTicket->number_of_sold_tickets + $pax;

        $flightTicket->save();
        $payment->save();

        $data = [
            'user' => $productBooking->user,
            'details' => $details
        ];

        Mail::to($agency->email)->send(new TicketPaid($data));

        return view('bookings.success', compact('payment'));
    }

    public function fail(Request $request)
    {

        return view('bookings.fail');
    }
}

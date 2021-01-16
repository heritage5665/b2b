<?php

namespace  App\Services;

use App\Dto\Tickets;
use App\Models\Payment;

class BookingService
{
    public function  __construct()
    {
    }


    public function handle(Tickets  $ticket)
    {
        $payment = Payment::find($ticket->paymentId);
        $payment->amount =  $ticket->paymentAmount;
        $payment->save();

        $productBooking = $payment->productBooking;

        $flightBooking = $productBooking->flightBooking;
        $details = json_decode($productBooking->details, true);
        $pax = $details['pax'];

        $flightBooking->status = 'paid';
        $flightBooking->save();

        $flightTicket = $productBooking->product->flightTicket;
        $flightTicket->number_of_sold_tickets = $flightTicket->number_of_sold_tickets + $pax;
        $flightTicket->save();
        return [
            'user' => $productBooking->user,
            'details' => $details,
            'payment' => $payment
        ];
    }
}

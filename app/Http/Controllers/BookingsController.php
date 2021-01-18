<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Dto\Tickets;
use App\Models\User;
use App\Http\Requests\TickectRequest as Request;
use App\Mail\TicketPaid;
use Illuminate\Support\Facades\Mail;
use App\Services\BookingService;
use App\Models\FlightBooking;


class BookingsController extends Controller
{
    public function success(Request $request, BookingService $service)
    {
        $ticket = Tickets::fromRequest($request);
        $user = User::find($ticket->userId);
        if (!$ticket->identifyHash($user->email)) {
            return view('bookings.fail');
        }
        $data = $service->handle($ticket);
        $payment = $data['payment'];


        Mail::to($ticket->agency->email)->send(new TicketPaid($data));

        return view('bookings.success', compact('payment'));
    }

    public function fail(Request $request)
    {

        return view('bookings.fail');
    }
}

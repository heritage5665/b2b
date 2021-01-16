<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FlightTicketsDestination;
use App\Models\FlightTicket;
use App\Models\Agency;
use App\Models\Airport;
use App\Models\FlightBooking;
use App\Models\Payment;
use App\Models\ProductBooking;
use App\Models\User;
use App\Models\Product;

use App\Mail\TicketBooked;
use App\Models\CustomerProductPriceTax;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use DB;
use Validator;
use Illuminate\Support\Facades\Auth;

class FlightTicketsController extends Controller
{
    public function list(Request $request)
    {

        $user = Auth::user();
        $availableDates = array();
        $agency = $request->agency;
        $query = $request->query();
        unset($query['agency']);
        $query['flight_date'] = $query && array_key_exists('flight_date', $query) && $query['flight_date'] ? date('Y-m-d', strtotime($query['flight_date'])) : '';
        $flights = [];
        $validationErrors = array();
        $query = array_filter($query);

        $fromAirport = new Airport();
        $toAirport = new Airport();

        if ($query) {
            $validator = Validator::make($query, [
                'from_arpt' => 'required',
                'flight_date' => 'required|date_format:"Y-m-d"|after_or_equal:' . now()->format('Y-m-d'),
                'adults' => 'required|numeric|min:1'
            ], [], [
                'from_arpt' => 'Flying from',
                'to_arpt' => 'Flying to',
                'flight_date' => 'Flight date',
                'adults' => 'Adults'
            ]);
            if (!$validator->passes()) {

                $validationErrors = $validator->errors()->getMessages();
            } else {
                $this->fromAirport = $query['from_arpt'];
                $this->toAirport = $query['to_arpt'];
                $fromAirport = $fromAirport->find($this->fromAirport);
                $toAirport = $toAirport->find($this->toAirport);

                $flights = FlightTicket::where(DB::raw("(DATE_FORMAT(departure_date_time,'%Y-%m-%d'))"), $query['flight_date'])
                    ->where('agency_id', $agency->id)
                    ->whereHas('flightTicketsDestination', function ($dbquery) {
                        $dbquery->where('from_airport_id', '=', $this->fromAirport)
                            ->where('to_airport_id', '=', $this->toAirport);
                    })
                    ->with(['airline', 'flightTicketsDestination.fromAirport', 'flightTicketsDestination.toAirport', 'product.price', 'product.price.taxes'])
                    ->get()
                    ->sortBy('product.price.price', SORT_REGULAR, false);

                $availableDates = FlightTicket::where('agency_id', $agency->id)->whereRaw('number_of_sold_tickets < number_of_tickets')
                    ->whereHas('flightTicketsDestination', function ($dbquery) {
                        $dbquery->where("from_airport_id", '=', $this->fromAirport)->where("to_airport_id", '=', $this->toAirport);
                    })
                    ->pluck("departure_date_time")->toArray();

                $availableDates = array_map(function ($date) {
                    return date('Y-m-d', strtotime($date));
                }, $availableDates);
            }
        }
        return view('flight-tickets.list', compact('availableDates', 'flights', 'validationErrors', 'query', 'fromAirport', 'toAirport'));
    }
    public function book(Request $request, $id)
    {

        $agency = $request->agency;

        $flight = FlightTicket::where('id', $id)
            ->with(['airline', 'flightTicketsDestination.fromAirport', 'flightTicketsDestination.toAirport', 'product.price'])
            ->first();

        $query = $request->query();
        $numberOfSeats = 0;
        $numberOfInfants = 0;
        if (array_key_exists('adults', $query)) {
            $numberOfSeats += $query['adults'];
        }
        if (array_key_exists('children', $query)) {
            $numberOfSeats += $query['children'];
        }
        if (array_key_exists('infants', $query)) {
            //$numberOfSeats += $query['infants'];
            $numberOfInfants = $query['infants'];
        }

        if (($flight->number_of_tickets - $flight->number_of_sold_tickets) < $numberOfSeats) {
            return redirect('flight-tickets/list');
        }

        $query = $request->query();


        if ($request->isMethod('post')) {

            $validatedData = $request->validate([
                'passenger_name.*' => 'required|max:255',
                'gender.*' => 'required',
                'age.*' => 'required',
                'email' => 'required|email'
            ]);

            $post = $request->all();

            if (Auth::check()) {
                $user = Auth::user();
            } else {
                $user = User::firstOrCreate(['agency_id' => $agency->id, 'email' => $post['email']]);
                $user->name = $user->name ? $user->name : $post['customer_name'];
                $user->phone = $user->phone ? $user->phone : $post['phone'];
                $user->save();
            }

            $product = Product::find($post['product_id']);

            $product->getProductDetail();

            $productInfo = 'Ticket ' . $product->flightTicket->flightTicketsDestination->fromAirport->cityName . ' (' . $product->flightTicket->flightTicketsDestination->fromAirport->code . ') - ' . $product->flightTicket->flightTicketsDestination->toAirport->cityName . ' (' . $product->flightTicket->flightTicketsDestination->toAirport->code . ')';

            $productBooking = new ProductBooking();
            $productBooking->agency_id = $agency->id;
            $productBooking->user_id = $user->id;
            $productBooking->product_id = $post['product_id'];
            $productBooking->product_price_id = $post['product_price_id'];
            $productBooking->type = 'flight';

            $expr = '/(?<=\s|^)[a-z]/i';
            preg_match_all($expr, $agency->name, $matches);
            $prefix = implode('', $matches[0]);
            $productBooking->booking_id = strtoupper($prefix) . '-' . substr(md5($product->id . time() . rand(0, 999999)), 0, 10);
            $post['product_info'] = $productInfo;
            unset($post['agency']);
            unset($post['_token']);
            $productBooking->details = json_encode($post);
            $productBooking->save();

            $flightBooking = new FlightBooking();
            $flightBooking->agency_id = $agency->id;
            $flightBooking->product_booking_id = $productBooking->id;
            $flightBooking->save();

            $payment = new Payment();
            $payment->agency_id = $agency->id;
            $payment->product_booking_id = $productBooking->id;
            $payment->amount = $post['price'];
            $payment->save();

            $flightTicketId = $product->flightTicket->id;
            $data = [
                'user' => $user,
                'details' => $post
            ];
            if ($query) {
                $params = '?' . http_build_query($query);
            }
            Mail::to($agency->email)->send(new TicketBooked($data));
            return redirect('flight-tickets/confirm-booking/' . $payment->id . $params);
        }
        return view('flight-tickets.book', compact('flight', 'query', 'numberOfSeats', 'numberOfInfants'));
    }

    public function confirmBooking(Request $request, $paymentId)
    {

        $agency = $request->agency;

        $query = $request->query();

        $payment = Payment::find($paymentId);
        $product = $payment->productBooking->product;
        $flightBooking = $payment->productBooking->flightBooking;
        $productBooking = $flightBooking->productBooking;
        $flightTicket = $productBooking->product->flightTicketWithTrashed;
        $airline = $flightTicket->airline;
        $flightTicketDestination = $flightTicket->flightTicketsDestination;
        $fromAirport = $flightTicketDestination->fromAirport;
        $toAirport = $flightTicketDestination->toAirport;
        $productPrice = $flightBooking->getAgencyPrice();
        $agencyCustomer = json_decode($productBooking->details);

        if (!$product->flightTicket || $product->flightTicket->number_of_tickets <= $product->flightTicket->number_of_sold_tickets) {
            abort(402, 'All tickets are sold.');
        }

        $user = $payment->productBooking->user;

        $productInfo = 'Ticket ' . $product->flightTicket->flightTicketsDestination->fromAirport->cityName . ' (' . $product->flightTicket->flightTicketsDestination->fromAirport->code . ') - ' . $product->flightTicket->flightTicketsDestination->toAirport->cityName . ' (' . $product->flightTicket->flightTicketsDestination->toAirport->code . ')';

        $flightTicketId = $product->flightTicket->id;

        $post = json_decode($payment->productBooking->details, true);

        return view('flight-tickets.confirm-booking', compact('post', 'agency',  'agencyCustomer', 'airline', 'flightTicket', 'fromAirport', 'toAirport', 'flightBooking', 'productPrice', 'productInfo', 'query', 'product', 'agency', 'user', 'payment', 'flightTicketId'));
    }
}

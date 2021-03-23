<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class FlightTicket extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'agency_id',
        'product_id',
        'flight_tickets_destination_id',
        'airline_id',
        'date_time',
        'number_of_tickets'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function airline()
    {

        return $this->belongsTo('App\Models\Airline');
    }
    public function flightTicketsDestination()
    {

        return $this->belongsTo('App\Models\FlightTicketsDestination') ?: new FlightTicketsDestination;
    }

    public function getPrice($pax, $dayEvent, $package)
    {

        $fromAirport = Airport::where('code', $package->from_airport_code)->first();
        $toAirport = Airport::where('code', $package->to_airport_code)->first();
        $destination = FlightTicketsDestination::where('from_airport_id', $fromAirport->id)->where('to_airport_id', $toAirport->id)->first();
        $ticket = $destination->flightTickets->first();

        if ($this->id != $ticket->id) {

            $price = $ticket->product->price ? $ticket->product->price->price : 0;

            $dayCustomEvent = DayEventCustom::firstOrNew([
                'user_id' => ($dayEvent instanceof DayEventCustom) ? $dayEvent->user_id : $dayEvent->userId,
                'day_event_id' => ($dayEvent instanceof DayEventCustom) ? $dayEvent->day_event_id : $dayEvent->id
            ]);

            $dayCustomEvent->product_id = $ticket->product->id;
            $dayCustomEvent->save();

            if ($dayEvent instanceof DayEventCustom) {

                $dayEvent->product->flightTicket->setRelation('flightTicketsDestination', $dayCustomEvent->product->flightTicket->flightTicketsDestination);
                $dayEvent->product->flightTicket->flightTicketsDestination->setRelation('fromAirport', $dayCustomEvent->product->flightTicket->flightTicketsDestination->fromAirport);
                $dayEvent->product->flightTicket->flightTicketsDestination->setRelation('toAirport', $dayCustomEvent->product->flightTicket->flightTicketsDestination->toAirport);
                $price = $dayEvent->product->price ? $dayEvent->product->price->price : 0;
            } else {
                $dayCustomEvent->product->flightTicket->flightTicketsDestination->fromAirport;
                $dayCustomEvent->product->flightTicket->flightTicketsDestination->toAirport;
                $price = $dayCustomEvent->product->price->price;
                $dayEvent->setRelation('customEvent', $dayCustomEvent);
            }
        } else {
            $this->flightTicketsDestination->fromAirport;
            $this->flightTicketsDestination->toAirport;

            $price = $dayEvent->product->price ? $dayEvent->product->price->price : 0;
        }

        return $price * $pax;
    }

    public function getAgencyPrice($getWithMarkup = false)
    {

        $user = Auth::user();
        $price = $this->product->price->price;
        $agencyGlobalTaxes = 0;
        if ($user && 'agency' == $user->user_type && true == $getWithMarkup) {
            $customer = $user->customer;
            $agencyGlobalTaxes = CustomerProductPriceTax::where('agency_id', $user->agency_id)->where('customer_id', $customer->id)->whereNull('product_price_id')
                ->sum('amount');
            $price += $agencyGlobalTaxes;
        }
        return $price;
    }
}

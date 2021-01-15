<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightTicketsDestination extends Model
{
    protected $table = 'flight_tickets_destinations';
    protected $fillable = [
        'agency_id',
        'from_airport_id',
        'to_airport_id'
    ];

    public function flightTickets() {

        return $this->hasMany('App\Models\FlightTicket');
    }

    public function fromAirport() {

        return $this->belongsTo('App\Models\Airport', 'from_airport_id');
    }
    
    public function toAirport() {

        return $this->belongsTo('App\Models\Airport', 'to_airport_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'agency_id',
        'user_id',
        'product_category'
    ];

    public function hotelRoomComponent() {

        return $this->hasOne('App\Models\HotelRoomComponent');
    }

    public function flightTicket() {

        return $this->hasOne('App\Models\FlightTicket');
    }

    public function flightTicketWithTrashed() {

        return $this->hasOne('App\Models\FlightTicket')->withTrashed();
    }

    public function vehicleComponent() {

        return $this->hasOne('App\Models\VehicleComponent');
    }
    
    public function activityComponent() {

        return $this->hasOne('App\Models\ActivityComponent');
    }

    public function personnelComponent() {

        return $this->hasOne('App\Models\PersonnelComponent');
    }

    public function package() {
        return $this->hasOne('App\Models\Package');
    }

    public function dayEvent() {
        return $this->hasOne('App\Models\DayEvent');
    }

    public function price() {

        return $this->hasOne('App\Models\ProductPrice')->where('is_active','=', 1) ? : new ProductPrice;
    }
    public function prices() {

        return $this->hasMany('App\Models\ProductPrice');
    }

    public function createPrice($price) {

        $productPrice = ProductPrice::firstOrNew(['agency_id' => $this->agency_id, 'product_id' => $this->id, 'is_active' => 1, 'price' => $price]);

        if(!$productPrice->id) {
            ProductPrice::where('product_id', $this->id)->update(['is_active' => 0]);
        }
        
        $productPrice->save();
        return;
    }
    public function getProductDetail() {
        switch($this->product_category) {
            case 'flight_ticket':
                (property_exists($this, 'flightTicketWithTrashed') && property_exists($this->flightTicketWithTrashed, 'flightTicketsDestination')) ? $this->flightTicketWithTrashed->flightTicketsDestination->fromAirport : new Airport;
                (property_exists($this, 'flightTicketWithTrashed') && property_exists($this->flightTicketWithTrashed, 'flightTicketsDestination')) ? $this->flightTicketWithTrashed->flightTicketsDestination->toAirport : new Airport;
            break;
            case 'vehicle':
                $this->vehicleComponent->vehicle;
            break;
            case 'hotel':
                $this->hotelRoomComponent->hotelRoom->hotelRoomTitle->hotel;
            break;
            case 'activity':
                $this->activityComponent->activity;
            break;
            case 'personnel':
                $this->personnelComponent->personnel;
            break;
        }
        $this->price;
    }
}

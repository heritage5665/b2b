<?php

namespace App\Http\Controllers\Api\V1\Com;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Models\Airport;
use App\Models\FlightTicket;
use DB;

class DataLoadersController extends Controller
{
    public function loadAirports(Request $request) : JsonResponse
    {
        $keyword = array_key_exists('query', $_GET) ? strtolower($_GET['query']) : '';
        
        if($keyword) {
            $airports = Airport::whereRaw('LOWER(`code`) LIKE ? ', "{$keyword}%")->orWhereRaw('LOWER(`cityName`) LIKE ? ', "{$keyword}%")->orWhereRaw('LOWER(`cityCode`) LIKE ?', "{$keyword}%")->take(30)->get(['cityName as name','id', 'cityCode', 'name as airportname']);
        } else {
            $airports = Airport::whereNotNull('important')->orderBy('important', 'ASC')->get(['cityName as name','id', 'cityCode', 'name as airportname']);
        }
        
        $airportData = [];
        if($airports) {
            $count = 0;
            foreach($airports as $airport) {
                $airportData[$count] = $airport;
                $airportData[$count]['tokens'] = explode(' ', $airport['airportname']);
                $count++;
            }
        }

        return response()->json($airports, 200);
    }

    public function loadAvailability(Request $request) {
        
        $agency = $request->agency;

        $destination = $request->post('sector');
        $this->destination = explode('-', $destination);

        $availableDates = FlightTicket::where('agency_id', $agency->id)->whereRaw('number_of_sold_tickets < number_of_tickets')
            ->whereHas('flightTicketsDestination', function($dbquery){
                $dbquery->where("from_airport_id", '=', $this->destination[0])->where("to_airport_id", '=', $this->destination[1]);
            })
            ->pluck("departure_date_time")->toArray();
   
        $availableDates = array_map(function($date){
            return date('Y-m-d', strtotime($date));
        }, $availableDates);

        return response()->json($availableDates);
    }
}

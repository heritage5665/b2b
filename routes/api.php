<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AddAgency;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->name('api.')->group(function () {
    Route::namespace('V1')->name('v1.')->prefix('v1')->group(function () {
        Route::namespace('Com')->name('common.')->prefix('common')->group(function () {
            Route::get('load-airports/{keyword?}', 'DataLoadersController@loadAirports')->name('load-airports');
            Route::post('flight-tickets/load-availability', 'DataLoadersController@loadAvailability')->middleware(AddAgency::class);
        });
    });
});
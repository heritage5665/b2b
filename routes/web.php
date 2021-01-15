<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\AddAgency;
use App\Http\Middleware\ConditionalAuth;
use Illuminate\Support\Facades\Notification;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Notifications\VerifyEmail;
Route::get('/test-mail', function (){
    Notification::route('mail', 'abrar_alhaq@yahoo.co.in')->notify(new VerifyEmail());
    return 'Sent';
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('home');
    })->name('home')->middleware(AddAgency::class)->middleware('guest');

    Route::get('flight-tickets/list', 'FlightTicketsController@list')->middleware(ConditionalAuth::class)->name('list_flights');
    Route::match(array('GET','POST'),'flight-tickets/book/{id}', 'FlightTicketsController@book')->middleware(ConditionalAuth::class)->middleware(AddAgency::class);
    Route::get('flight-tickets/confirm-booking/{paymentId}', 'FlightTicketsController@confirmBooking')->middleware(ConditionalAuth::class)->middleware(AddAgency::class);

    Route::post('booking-success', 'BookingsController@success')->middleware(AddAgency::class);
    Route::post('booking-fail', 'BookingsController@fail')->middleware(AddAgency::class);

    Route::get('/dashboard', 'Agency\DashboardController@index')->middleware(['auth'])->middleware(AddAgency::class)->name('dashboard');
    Route::get('/send-ticket/{flightBookingId}', 'Agency\DashboardController@sendTicket')->middleware(['auth'])->middleware(AddAgency::class)->name('send-ticket');
    Route::post('/update-markup', 'Agency\DashboardController@updateMarkUp')->middleware(['auth'])->middleware(AddAgency::class)->name('update-markup');

    Route::get('/bookings', 'Agency\BookingsController@index')->middleware(['auth'])->middleware(AddAgency::class)->name('bookings');
    Route::post('/send-ticket', 'Agency\BookingsController@sendTicket')->middleware(['auth'])->middleware(AddAgency::class)->name('email-ticket');
    
    Route::match(array('GET','POST'), '/global-settings', 'Agency\SettingsController@global')->middleware(['auth'])->middleware(AddAgency::class)->name('global-settings');
});
require __DIR__.'/auth.php';

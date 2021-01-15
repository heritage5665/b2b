<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\Payment;
use App\Models\ProductBooking;
use App\Models\User;
use App\Models\Product;

use App\Mail\TicketPaid;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use DB;
use Validator;

class BookingsController extends Controller
{
    public function success(Request $request) {

        $agency = $request->agency;

        $status = $_POST["status"];
		$firstname = $_POST["firstname"];
		$amount = $_POST["amount"];
		$txnid = $_POST["txnid"];
		$postedHash = $_POST["hash"];
		$key = $_POST["key"];
		$productinfo = $_POST["productinfo"];
		
		$salt = $agency->payu_merchant_salt;
        $paymentId = $_POST['udf1'];
        $userId = $_POST['udf2'];
        
        $user = User::find($userId);

        $email = $user->email;
        $paymentAmount = $_POST['udf3'];

        $retHashSeq = $salt.'|'.$status.'||||||||'.$paymentAmount.'|'.$userId.'|'.$paymentId.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

        $hash = hash("sha512", $retHashSeq);
        $payment = new Payment();
        
        if($hash == $postedHash) {
            $payment = Payment::find($paymentId);
            $payment->amount = $paymentAmount;
            $productBooking = $payment->productBooking;
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
        } else {
            return view('bookings.fail');
        }
        
        return view('bookings.success', compact('payment'));
    }    
    
    public function fail(Request $request) {

        return view('bookings.fail');
    }    
}
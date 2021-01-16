@extends('inner')
@section('main')
@php
$params = null;
if($query) {
$params = '?' . http_build_query($query);
}
use App\Models\ProductPriceTax;
use Illuminate\Support\Carbon;
@endphp
<!-- breadcrumb start -->
<?php
$udf1 = $payment->id;
$udf2 = $user->id;

$totalToPay = number_format((float)$payment->amount, 2, '.', '');
$infants = array_key_exists('infants', $post) ? $post['infants'] : 0;
$adults = array_key_exists('adults', $post) ? $post['adults'] : 0;

$udf3 = $totalToPay;

$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
$merchantKey = $agency->payu_merchant_key;
$name = array_key_exists('customer_name', $post) ? $post['customer_name'] : $user->name;
if ('agency' == $user->user_type) {
    $name = $user->name;
    $email = $user->email;
    $phone = $user->phone;
} else {
    $email = array_key_exists('email', $post) ? $post['email'] : $user->email;
    $phone = array_key_exists('phone', $post) ? $post['phone'] : $user->phone;
}

$hashSequence = "$merchantKey|$txnid|$totalToPay|$productInfo|$name|$email|$udf1|$udf2|$udf3||||||||";

$hashSequence .= $agency->payu_merchant_salt;

$hash = strtolower(hash('sha512', $hashSequence));
$user = auth()->user();

if (2 == $user->agency->id) {
    $action = 'https://test.payu.in/_payment';
} else {
    $action = env('PAYU_BASE_URL') . '/_payment';
}
?>
<section class="breadcrumb-section small-sec flight-sec pt-0">
    <img src="/assets/images/flights/flight-breadcrumb2.jpg" class="bg-img img-fluid blur-up lazyload" alt="">
    <div class="content-bottom">
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="/flight-tickets/list{{$params}}">flights</a></li>
                            <li class="breadcrumb-item"><a href="/flight-tickets/book/{{$flightTicketId}}{{$params}}">book</a></li>
                            <li class="breadcrumb-item active">confirm booking</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="small-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="review-section">
                    <div class="review_box">
                        <div class="title-top">
                            <h5>booking details</h5>
                        </div>
                        <div class="col-lg-9 card card-table-one ticket">
                            <div class="row ticket_heading">

                                <div class="col-lg-6">
                                    {{$agencyCustomer->customer_name}}<br>
                                    {{$agencyCustomer->email}}<br>
                                    {{$agencyCustomer->phone}}<br />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="logo-sec">
                                        <span class="title">{{$productInfo}}</span>
                                    </div>
                                </div>
                                @php
                                $taxes = $product->price->taxes;
                                $keyedTaxes = [];
                                $cost = $product->price->price;
                                if($taxes):

                                $totalTax = 0;
                                $price = $cost;
                                foreach($taxes as $tax):

                                $totalTax += $tax['amount'];
                                $price += $tax['amount'];
                                $keyedTaxes[$tax['tax']] = $tax['amount'];
                                endforeach;
                                endif;
                                @endphp
                                <div class="col-md-6">
                                    Per ticket cost: <i class="fas fa-rupee-sign"></i>{{$product->flightTicket->getAgencyPrice()}}
                                </div>
                                <div class="col-md-3">
                                    <?php
                                    $adultPrice = $totalToPay - ($totalTax * $adults);
                                    if ($infants) :
                                        $adultPrice = $totalToPay - (1600 * $infants) - ($totalTax * $adults);
                                    endif;
                                    ?>
                                    <div class="duration">
                                        <div>
                                            <h6> Cost of {{$adults}} tickets: <i class="fas fa-rupee-sign"></i>{{$adultPrice}}</h6>
                                            @if($infants>0)
                                            <p>Cost of {{$infants}} infant tickets: <i class="fas fa-rupee-sign"></i>{{1600*$infants}}</p>
                                            @endif
                                            @php
                                            if($keyedTaxes):
                                            foreach($keyedTaxes as $key=>$tax):

                                            @endphp

                                            <input type="hidden" class="taxes" value="{{$tax}}" />
                                            <tr>
                                                <td>{{ProductPriceTax::$__taxes[$key]}} <span class="adult_count">({{$adults}}</span> X <i class="fas fa-rupee-sign"></i>{{$tax}})</td>
                                                <td><i class="fas fa-rupee-sign"></i> <span class="taxes_total">{{$adults*$tax}}</span></td>
                                            </tr>
                                            @php
                                            $adultPrice += ($adults*$tax);
                                            endforeach;
                                            endif;
                                            @endphp
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row ticket_section_heading">
                                <div class="col-lg-6">
                                    Flight Detail
                                </div>
                                <div class="col-lg-6">
                                    Please verify flight timings & terminal info with the airlines
                                </div>
                            </div>
                            <div class="row ticket_section_sub_heading">
                                <div class="col-lg-2">
                                    Flight
                                </div>
                                <div class="col-lg-2">
                                    Type
                                </div>
                                <div class="col-lg-3">
                                    Departing
                                </div>
                                <div class="col-lg-3">
                                    Arriving
                                </div>
                                <div class="col-lg-2">
                                    Duration
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    {{$flightTicket->airline_code}} <br /> {{$airline->name}}
                                </div>
                                <div class="col-lg-2">
                                    Non Refundable
                                </div>
                                <div class="col-lg-3">
                                    {{date('D, M, d H:i', strtotime($flightTicket->departure_date_time))}}<br />
                                    {{$fromAirport->cityName}},<br />
                                    {{$fromAirport->name}}
                                </div>
                                <div class="col-lg-3">
                                    {{date('D, M, d H:i', strtotime($flightTicket->arrival_date_time))}}<br />
                                    {{$toAirport->cityName}},<br />
                                    {{$toAirport->name}}
                                </div>
                                <div class="col-lg-2">
                                    <?php
                                    $t1 = Carbon::parse($flightTicket->arrival_date_time);
                                    $t2 = Carbon::parse($flightTicket->departure_date_time);
                                    $diff = $t2->diff($t1);
                                    ?>
                                    @if($diff->d)
                                    {{$diff->d}}d
                                    @endif
                                    {{$diff->h}}h {{$diff->i}}m
                                </div>
                            </div>

                            <div class="row ticket_section_heading">
                                <div class="col-lg-12">
                                    Passenger Details
                                </div>
                            </div>
                            <div class="row ticket_section_sub_heading">
                                <div class="col-lg-2">
                                    #
                                </div>
                                <div class="col-lg-4">
                                    Name
                                </div>
                                <div class="col-lg-3">
                                    PNR
                                </div>
                                <div class="col-lg-3">
                                    Baggage
                                </div>
                            </div>

                            @foreach($agencyCustomer->gender as $key=>$gender)
                            <div class="row passenger-row">
                                <div class="col-lg-2">
                                    {{$key+1}}.
                                </div>
                                <div class="col-lg-4">
                                    {{$agencyCustomer->passenger_first_name[$key]}} {{$agencyCustomer->passenger_last_name[$key]}}
                                </div>
                                <div class="col-lg-3">
                                    {{$flightBooking->pnr}}
                                </div>
                                <div class="col-lg-3">
                                    15 Kg | 7 Kg
                                </div>
                            </div>
                            @endforeach
                            @if($agencyCustomer->infants && $agencyCustomer->infants > 0)
                            @foreach($agencyCustomer->infant_gender as $key=>$gender)
                            <div class="row passenger-row">
                                <div class="col-lg-12">
                                    Infant ({{$gender}}) {{$agencyCustomer->infant_name[$key]}} {{$agencyCustomer->infant_dob[$key]}}
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <form action="<?php echo $action; ?>" method="post" name="payuForm" id="pay_u_form">
            <input type="hidden" name="key" value="<?php echo $merchantKey ?>" />
            <input type="hidden" id="hash" name="hash" value="<?php echo $hash ?>" />
            <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />

            <input name="amount" type="hidden" value="<?php echo $totalToPay ?>" />
            <input name="firstname" id="firstname" type="hidden" value="<?php echo $name ?>" />
            <input name="email" id="email" type="hidden" value="<?php echo $email ?>" />
            <input name="phone" id="phone" type="hidden" value="{{$phone}}" />
            <input name="productinfo" id="productinfo" type="hidden" value="<?php echo $productInfo ?>" />
            <input name="surl" id="surl" type="hidden" value="{{env('HTTP_PROTOCOL')}}://<?php echo $_SERVER['HTTP_HOST'] . '/booking-success' ?>" />
            <input name="furl" id="furl" type="hidden" value="{{env('HTTP_PROTOCOL')}}://<?php echo $_SERVER['HTTP_HOST'] . '/booking-fail' ?>" />
            <input name="udf1" id="udf1" type="hidden" value="<?php echo $udf1 ?>" />
            <input name="udf2" id="udf2" type="hidden" value="<?php echo $udf2 ?>" />
            <input name="udf3" id="udf3" type="hidden" value="<?php echo $udf3 ?>" />
            <?php if (env('PAYU_ADD_SERVICE_PROVIDER') && 2 != $user->agency->id) : ?>
                <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
            <?php endif; ?>
            <div class="continue-btn">
                <button class="btn btn-solid" type="submit"><strong>Pay <i class="fas fa-rupee-sign"></i> <?php echo $totalToPay ?></strong></button>
            </div>
        </form>

    </div>
    <section>
        @stop
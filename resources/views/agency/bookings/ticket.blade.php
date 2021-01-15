<!doctype html>
<html>
@php 
  use App\Models\ProductPriceTax;
  use Carbon\Carbon;
@endphp
<head>
    <meta charset="utf-8">
    <title>PNR Generated</title>
    
    <style>
    .card {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid #eee;
        border-radius: .25rem;
    }
 
    .card-header {
        padding: .75rem 1.25rem;
        margin-bottom: 0;
        background-color: rgba(0,0,0,.03);
        border-bottom: 1px solid rgba(0,0,0,.125);
    }
    .card-body {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.25rem;
    }
    .card td{
        padding: .75rem;
        vertical-align: top;
    }
    .border-top-0 {
        border-top: solid 0px !important;
    }
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 13px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td.right-align {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #000;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
        color: #fff;
    }
    .invoice-box table tr.sub-heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
        color: #555;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
        font-size: 13px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    .font-12 {
        font-size: 12px;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="5">
                    <table>
                        <tr>
                            <td class="title">
                                @if($agency_customer->logo)
                                    <img src="{{$agency->domain}}/admin/img/customer_logos/{{$agency_customer->logo}}" style="width:100%; max-width:100px;">
                                @endif
                            </td>
                           
                            <td class="right-align">
                                <h2>Invoice</h2>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="5" class="right-align">
                    <table>
                        <tr>
                            <td>
                                {{$customer_name}}<br>
                                {{$customer_email}}<br>
                                {{$customer_phone}}
                            </td>
                            
                            <td class="right-align">
                                {{$agency_user->name}}<br>
                                {{$agency_user->address}}<br>
                                {{$agency_user->email}}<br/>
                                {{$agency_user->phone}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td colspan="1">
                    Flight Detail
                </td>
                
                <td style="text-align: right;" colspan="4">
                    Please verify flight timings & terminal info with the airlines 
                </td>
            </tr>
            <tr class="sub-heading">
                <td>
                    Flight
                </td>
                <td>
                    Type
                </td>
                <td>
                    Departing
                </td>
                <td>
                    Arriving
                </td>
                <td>
                    Duration
                </td>
            </tr>
            <tr class="details">
                <td>
                    {{$flight_detail}}
                </td>
                <td>
                    Non Refundable
                </td>
                <td>
                    {{date('D, M, d H:i', strtotime($flight_ticket->departure_date_time))}}
                    {{$departure}}
                </td>
                <td>
                    {{date('D, M, d H:i', strtotime($flight_ticket->arrival_date_time))}}
                    {{$arriving}}
                </td>
                <td>
                    <?php 
                        $t1 = Carbon::parse($flight_ticket->arrival_date_time);
                        $t2 = Carbon::parse($flight_ticket->departure_date_time);
                        $diff = $t2->diff($t1);
                    ?>
                    @if($diff->d)
                        {{$diff->d}}d
                    @endif
                    {{$diff->h}}h {{$diff->i}}m
                </td>
            </tr>
            <tr>
              <td colspan="5">
                    
                    <table cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr class="heading">
                                <td colspan="5">
                                    Passenger Details
                                </td>
                            </tr>
                            <tr class="sub-heading">
                                <td width="5">#</td>
                                <td>Name</td>
                                <td>PNR</td>
                                <td>Baggage</td>
                            </tr>
                            <?php 
                            if($passenger_details && array_key_exists('gender', $passenger_details)) :
                            foreach($passenger_details['gender'] as $key=> $gender) :
                            ?>
                            <tr class="detail">
                                <td>
                                    {{$key+1}}
                                </td>
                                <td>
                                    <span class="font-weight-500">{{$gender}} {{$passenger_details['passenger_first_name'][$key]}} {{$passenger_details['passenger_last_name'][$key]}}</span>
                                </td>
                                <td>
                                    <span class="font-weight-500">{{$pnr}}</span>
                                </td>
                                <td>
                                    <span class="font-weight-500">15 Kg | 7 Kg </span>
                                </td>
                            </tr>
                            <?php 
                            endforeach;
                                if(array_key_exists('infants', $passenger_details) && $passenger_details['infants'] > 0):
                                    foreach($passenger_details['infant_gender'] as $key=>$gender) :
                            ?>
                                    <tr>
                                        <td colspan="5">
                                            <span class="font-weight-500"> Infant ({{$gender}}) {{$passenger_details['infant_name'][$key]}} {{$passenger_details['infant_dob'][$key]}}</span>
                                        </td>
                                    </tr>
                            <?php
                                    endforeach;
                                endif;
                            endif;
                            ?>
                        </tbody>
                    </table>
                
              </td>
            </tr>
            <tr>
              <td colspan="5">
                <table class="detail font-12">
                    <tr class="heading">
                        <td colspan="5">
                            Fare Details 
                        </td>
                    </tr>
                        @php
                            $totalTax = 0;
                            if($taxes):
                                
                                foreach($taxes as $tax):
                                    $totalTax += $tax['amount'];
                                endforeach;
                            endif;
                        @endphp
                    <tr>
                      <td class="col-6 border-top-0"><strong>Base Price (Rs. {{$fare+$totalTax}}x{{$passenger_details['pax']-$passenger_details['infants']}})</strong></td>
                      <td class="col-2 border-top-0"><strong>Rs. {{number_format(($passenger_details['pax']-$passenger_details['infants'])*($fare+$totalTax), 2)}}</strong></td>
                    </tr>
                    @php
                        $counter = ($passenger_details['pax']-$passenger_details['infants'])*($fare+$totalTax)
                    @endphp
                    @if(array_key_exists('infants', $passenger_details) && $passenger_details['infants'] > 0)
                        <tr>
                            <td class="col-6 border-top-0"><strong>Infants (Rs. 1600x{{$passenger_details['infants']}})</strong></td>
                            <td class="col-2 border-top-0"><strong>Rs. {{number_format($passenger_details['infants']*1600, 2)}}</strong></td>
                        </tr>
                        @php
                            $counter += ($passenger_details['infants']*1600)
                        @endphp
                    @endif
                    @if(array_key_exists('taxes', $productPrice) && $productPrice['taxes'])
                            
                        @foreach($productPrice['taxes'] as $key=>$tax)
                        
                            <tr>
                                <td class="col-6 border-top-0"><strong> {{\App\Models\CustomerProductPriceTax::$__taxes[$key]}}</strong></td>
                                <td class="col-2 border-top-0"><strong>Rs. {{number_format($tax->amount,2)}}</strong></td>
                            </tr>
                            @php
                                $counter += $tax->amount;
                            @endphp
                        @endforeach
                    @endif
                    
                    <tr>
                      <td class="col-6 border-top-0"><strong>Total</strong></td>
                      <td class="col-2 border-top-0"><strong>Rs. {{number_format($counter, 2)}}</strong></td>
                    </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td colspan="5">
                <table class="detail font-12">
                    <tr class="heading">
                        <td colspan="5">
                            Customer Information
                        </td>
                    </tr>
                    <tr>
                      <td class="col-6 border-top-0">
                          {{$customer_information}}
                      </td>
                    </tr>
                    <tr>
                      <td><small>Powered by <a href="https://www.tripgofersolutions.com" target="_blank">TripGofer</a></small></td>
                  </tr>
                </table>
              </td>
            </tr>
        </table>
    </div>
</body>
</html>
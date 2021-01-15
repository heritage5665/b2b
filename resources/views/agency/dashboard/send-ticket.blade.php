@php 
    use Carbon\Carbon;
@endphp
@push('styles')
    <link href="{{ asset('assets/bootstrap4-editable/css/bootstrap-editable.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('/assets/bootstrap4-editable/js/bootstrap-editable.min.js') }}"></script>
@endpush
@push('inline_script')
<script>
  $(function(){
    $('#markup').editable({
          type:  'text',
          pk:    "{{$productPrice['product_price']->id}}",
          name:  'username',
          url:   '/update-markup',  
          title: 'Enter Markup',
          ajaxOptions: {
              dataType: 'json' //assuming json response
          },           
          success: function(data, config) {
            location.reload();           
          },
      });
  });
</script>
@endpush
<x-app-layout>
<div class="col-lg-9 card card-table-one ticket">
    <div class="row ticket_heading">
      <div class="col-lg-6">
        <img src="/admin/img/customer_logos/{{$customer->logo}}" alt=""
                                      class="img-fluid blur-up lazyload"/>
      </div>
      <div class="col-lg-6">
          {{$agencyCustomer->customer_name}}<br>
          {{$agencyCustomer->email}}<br>
          {{$agencyCustomer->phone}}<br/>
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
        {{$flightTicket->airline_code}} <br/> {{$airline->name}}
      </div>
      <div class="col-lg-2">
        Non Refundable
      </div>
      <div class="col-lg-3">
        {{date('D, M, d H:i', strtotime($flightTicket->departure_date_time))}}<br/>
        {{$fromAirport->cityName}},<br/>
        {{$fromAirport->name}}
      </div>
      <div class="col-lg-3">
        {{date('D, M, d H:i', strtotime($flightTicket->arrival_date_time))}}<br/>
        {{$toAirport->cityName}},<br/>
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
    <div class="row ticket_section_heading">
      <div class="col-lg-12">
        Fare Details
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        Base Price
      </div>
      <div class="col-lg-6">
        Rs. {{ number_format($productPrice['base_price'],2)}}
      </div>
    </div>
    @if(array_key_exists('taxes', $productPrice) && $productPrice['taxes'])
      @foreach($productPrice['taxes'] as $key=>$tax)
        <div class="row">
          <div class="col-lg-6">
            {{\App\Models\CustomerProductPriceTax::$__taxes[$key]}}
          </div>
          <div class="col-lg-6">
            Rs. <a href="#" id="markup">{{number_format($tax->amount,2)}} <i class="fa fa-edit"></i></a>
          </div>
        </div>
      @endforeach
    @endif
    <div class="row">
      <div class="col-lg-6">
        <strong>Total Price</strong>
      </div>
      <div class="col-lg-6">
        <strong>Rs. {{ number_format($productPrice['total'],2)}}</strong>
        
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <button type="button" class="btn btn-solid float-right" data-toggle="modal" data-target="#modaldemo3">Send Ticket</button>
      </div>
    </div>
</div>
<!-- MODAL ALERT MESSAGE -->
<div id="modaldemo3" class="modal">
  <div class="modal-dialog modal-lg" role="document">
  <form action="/send-ticket" method="POST">
    @csrf
    <input type="hidden" name="flight_booking_id" value=" {{$flightBooking->id}}">
    <div class="modal-content modal-content-demo">
      <div class="modal-header">
        <h6 class="modal-title"></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
        <div class="row row-sm">
              <div class="col-lg">
                <input class="form-control" placeholder="Email" name="customer_email" type="text" value="{{$agencyCustomer->email}}">
              </div><!-- col -->
              
            </div><!-- row -->

            <div class="row row-sm mg-t-20">
              <div class="col-lg">
                <label>Terms and Conditions</label>
                <textarea rows="15" class="form-control" placeholder="Ticket TnC" name="customer_information">
  Important information

  Passengers are required to bring this Itinerary/Receipt along with an official ID with photo issued by the government or known corporations upon entering the terminal.
  
  The airline may contact the card holder or the passenger for verification of their payment, and in case the airline suspects or has a reason to believe that the ticket(s) purchased were made fraudulently, the airline may cancel the reservation made by the passenger.
  
  Passengers are recommended to check-in two hours before the scheduled departure time to prevent cancellation of passenger's reservation. The airline shall not be liable for loss or damages due to passenger's failure to comply to the provisions above if without fault by the airline.
                </textarea>
              </div><!-- col -->
            </div><!-- row -->
      </div><!-- modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-solid">Send Ticket</button>
      </div>
    </div>
  </form>
  </div><!-- modal-dialog -->
</div><!-- modal -->
</x-app-layout>

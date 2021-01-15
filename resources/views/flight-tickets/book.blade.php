@extends('inner')
@section('main')
@php
  use Carbon\Carbon;
  use App\Models\ProductPriceTax;

  $params = null;
  if($query) {
      $params = '?' . http_build_query($query);
  }
@endphp
<!-- breadcrumb start -->
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
                            <li class="breadcrumb-item active">book</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb end -->
<section class="small-section">
        <div class="container">
          
            <form action="/flight-tickets/book/{{$flight->id}}{{$params}}" method="POST" class="needs-validation">
              <div class="row">
                  <div class="col-lg-8">
                      <div class="review-section">
                          <div class="review_box">
                              <div class="title-top">
                                  <h5>flight details</h5>
                              </div>
                              <div class="flight_detail">
                                  <div class="row">
                                      <div class="col-md-3">
                                          <div class="logo-sec">
                                              <img src="/assets/images/airline-logos/{{$flight['airline']['logo']}}"
                                                  class="img-fluid blur-up lazyload" alt="">
                                              <span class="title">{{$flight['airline']['name']}}</span>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="airport-part">
                                              <div class="airport-name">
                                                  <h6>{{$flight['flightTicketsDestination']['fromAirport']['cityCode']}} <span>{{date('H:i', strtotime($flight['departure_date_time']))}}</span></h6>
                                                  <p>{{date('D, d M,Y', strtotime($flight['departure_date_time']))}}</p>
                                              </div>
                                              <div class="airport-progress">
                                                  <i class="fas fa-plane-departure float-left"></i>
                                                  <i class="fas fa-plane-arrival float-right"></i>
                                              </div>
                                              <div class="airport-name arrival">
                                                  <h6>{{$flight['flightTicketsDestination']['toAirport']['cityCode']}} <span>{{date('H:i', strtotime($flight['arrival_date_time']))}}</span></h6>
                                                  <p>{{date('D, d M,Y', strtotime($flight['arrival_date_time']))}}</p>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-3">
                                          <div class="duration">
                                              <div>
                                                  <h6>
                                                    <?php 
                                                      $t1 = Carbon::parse($flight['arrival_date_time']);
                                                      $t2 = Carbon::parse($flight['departure_date_time']);
                                                      $diff = $t2->diff($t1);
                                                    ?>
                                                    @if($diff->d)
                                                      {{$diff->d}}d
                                                    @endif 
                                                      {{$diff->h}}h {{$diff->i}}m 
                                                  </h6>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="review_box">
                              <div class="title-top">
                                  <h5>Information</h5>
                              </div>
                              <div class="flight_detail">
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="boxes">
                                              <h6>Cancellation Charges</h6>
                                              <ul>
                                                  <li>airline fee : <span><i class="fas fa-rupee-sign"></i>3500</span></li>
                                                  <li>This airline allows cancellation only before 2 hrs from
                                                      departure time.</li>
                                              </ul>
                                          </div>
                                          <div class="boxes">
                                              <h6>Reschedule Charges</h6>
                                              <ul>
                                                  <li>airline fee : <span><i class="fas fa-rupee-sign"></i>3500 + fare difference</span></li>
                                                  <li>This airline allows reschedule only before 2 hrs from departure
                                                      time.</li>
                                              </ul>
                                          </div>
                                          <div class="boxes">
                                              <h6>baggage policy</h6>
                                              <ul>
                                                  <li>Check-in Baggage : <span>15 kg</span></li>
                                                  <li>Cabin Baggage: <span>7 kg</span></li>
                                              </ul>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="review_box">
                              <div class="title-top">
                                  <h5>traveller details</h5>
                              </div>
                              <div class="flight_detail">
                                  <div class="row form_flight">
                                      <div class="col-md-12">
                                          @csrf
                                          <input type="hidden" name="product_id" value="<?php echo $flight->product->id?>" />
                                          <input type="hidden" name="product_price_id" value="<?php echo $flight->product->price->id?>" />
                                          <input type="hidden" name="price" id="price" value="<?php echo $flight->product->price->price?>" />
                                          <input type="hidden" name="pax" id="pax" value="1" />
                                          <input type="hidden" name="infants" id="infants" value="0" />
                                          <h6>Adults</h6>
                                          <div class="travellerDetails">
                                            <div class="form-row traveller-div-copy">
                                                <div class="form-group col-md-2">
                                                    <label for="inputState">Title</label>
                                                    <select id="inputState" name="gender[]" class="form-control" required>
                                                        <option value="">Choose...</option>
                                                        <option>Mr.</option>
                                                        <option>Ms.</option>
                                                        <option>Mrs.</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                      Please select title.
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="first">First name</label>
                                                    <input type="text" name="passenger_first_name[]" class="form-control" required/>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="last">Last name</label>
                                                    <input type="text" name="passenger_last_name[]" class="form-control" required/>
                                                </div>
                                            </div>
                                          </div>
                                          <div class="infantDetails d-none">
                                            <br/>
                                            <h6>Infants</h6>
                                            <div class="form-row traveller-div infant-div-copy d-none">
                                              <div class="form-group col-md-2">
                                                    <label for="inputState"></label>
                                                    <select id="inputState" class="form-control" name="infant_gender[]">
                                                      <option value="">Choose...</option>
                                                      <option value="Male">Male</option>
                                                      <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="first">Name</label>
                                                    <input type="text" name="infant_name[]" class="form-control"/>
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="last">DOB</label>
                                                    <input type="text" name="infant_dob[]" class="form-control"/>
                                                </div>
                                            </div>
                                          </div>
                                          <h6>Contact Details</h6>
                                          <div class="form-row">
                                              <div class="form-group col-md-4">
                                                  <label for="customer_name">Name</label>
                                                  <input type="text" name="customer_name" class="form-control" id="customer_name" required>
                                              </div>
                                              <div class="form-group col-md-4">
                                                  <label for="customer_email">Email</label>
                                                  <input type="email" name="email" class="form-control" id="customer_email" required>
                                              </div>
                                              <div class="form-group col-md-4">
                                                  <label for="customer_phone">Phone no:</label>
                                                  <input type="text" maxlength="10" name="phone" class="form-control" id="customer_phone" required>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 res-margin">
                      <div class="sticky-cls-top">
                          <div class="review-section">
                            <div class="review_box">
                                  <div class="flight_detail">
                                      <div class="promo-section">
                                          <div class="form-group mb-0">
                                              <label>Travellers</label>
                                          </div>
                                          <div class="promos">
                                                  <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label class="form-check-label title" for="itemSelect">
                                                          Adults
                                                        </label>
                                                        <select autocomplete="off" class="form-control" id="itemSelect" name="adults" required>
                                                            <option value="1" <?php if(1 == $numberOfSeats):?> selected="selected"<?php endif;?>>1 Adult</option>
                                                            <option value="2" <?php if(2 == $numberOfSeats):?> selected="selected"<?php endif;?>>2 Adults</option>
                                                            <option value="3" <?php if(3 == $numberOfSeats):?> selected="selected"<?php endif;?>>3 Adults</option>
                                                            <option value="4" <?php if(4 == $numberOfSeats):?> selected="selected"<?php endif;?>>4 Adults</option>
                                                            <option value="5" <?php if(5 == $numberOfSeats):?> selected="selected"<?php endif;?>>5 Adults</option>
                                                        </select>
                                                    </div>
                                                  </div>
                                                  <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label class="form-check-label title" for="infantSelect">
                                                          Infants
                                                        </label>
                                                        <select autocomplete="off" class="form-control" id="infantSelect">
                                                          <option value="0" <?php if(0 == $numberOfInfants):?> selected="selected"<?php endif;?>>0 Infant</option>
                                                          <option value="1" <?php if(1 == $numberOfInfants):?> selected="selected"<?php endif;?>>1 Infants</option>
                                                          <option value="2" <?php if(2 == $numberOfInfants):?> selected="selected"<?php endif;?>>2 Infants</option>
                                                          <option value="3" <?php if(3 == $numberOfInfants):?> selected="selected"<?php endif;?>>3 Infants</option>
                                                          <option value="4" <?php if(4 == $numberOfInfants):?> selected="selected"<?php endif;?>>4 Infants</option>
                                                        </select>
                                                    </div>
                                                  </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="review_box">
                                  <div class="title-top">
                                      <h5>booking summery</h5>
                                  </div>
                                  <div class="flight_detail">
                                      <div class="summery_box">
                                        
                                          <input type="hidden" id="single_fare" value="{{$flight->getAgencyPrice()}}"/>
                                          <table class="table table-borderless">
                                            @php
                                            $taxes = $flight['product']['price']['taxes'];
                                            $keyedTaxes = [];
                                            $cost = $flight['product']['price']['price'];
                                            if($taxes):
                                                $price = $cost;
                                                foreach($taxes as $tax):
                                                    $price += $tax['amount'];
                                                    $keyedTaxes[$tax['tax']] =  $tax['amount'];
                                                endforeach;
                                            endif;
                                            @endphp
                                              <tbody>
                                                  <tr>
                                                      <td>adults (<span class="adult_count">{{$numberOfSeats}}</span> X <i class="fas fa-rupee-sign"></i> {{$flight->getAgencyPrice()}})</td>
                                                      <td><i class="fas fa-rupee-sign"></i> <span class="adult_total_price">{{$numberOfSeats*$flight->getAgencyPrice()}}</span></td>
                                                  </tr>
                                                  @php
                                                    $totalTax = 0;
                                                    if($keyedTaxes):
                                                        foreach($keyedTaxes as $key=>$tax):
                                                            
                                                            $totalTax += $tax;
                                                  @endphp
                                                 
                                                        <input type="hidden" class="taxes" value="{{$tax}}" />
                                                        
                                                  @php
                                                        endforeach;
                                                  endif;
                                                  @endphp
                                                  <tr class="infant_detailed_price <?php echo $numberOfInfants == 0 ? 'd-none' : ''; ?>">
                                                      <td>Infant (<span class="infant_count">{{$numberOfInfants}}</span> X <i class="fas fa-rupee-sign"></i> 1600)</td>
                                                      <td><i class="fas fa-rupee-sign"></i> <span class="infant_total_price">{{$numberOfInfants*1600}}</span></td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                          <div class="grand_total">
                                              <h5>grand total: <span id="total_fare"><i class="fas fa-rupee-sign"></i>{{($numberOfSeats*$flight['product']['price']['price'])+($numberOfInfants*1600)+($numberOfSeats*$totalTax)}}</span></h5>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="continue-btn">
                  <button class="btn btn-solid"
                      type="submit">continue booking</button>
              </div>
            </form>
        </div>
    </section>
<script type="text/javascript">

	$('#itemSelect, #infantSelect').change(function(){
		$(".clone-info").remove();
		$("#pax").val(parseInt($('#itemSelect').val())+parseInt($('#infantSelect').val()));
		$("#infants").val($('#infantSelect').val());
    var adultCount = $('#itemSelect').val();
    var infantCount = $('#infantSelect').val();
    var taxes = 0;

    $('.taxes').each(function() {
        taxes += Number($(this).val());
    });
    
    $('.taxes_total').text(taxes*adultCount);
    if(infantCount > 0) {
      $('.infant_detailed_price').removeClass('d-none');
    } else {
      $('.infant_detailed_price').addClass('d-none');
    }
    $('.adult_count').html(adultCount);
    $('.infant_count').html(infantCount);

		for(var i=1; i<$('#itemSelect').val(); i++) {
			var container = $(".traveller-div-copy").clone().removeClass("traveller-div-copy").addClass("clone-info").appendTo(".travellerDetails");
		}
		for(var i=0; i<$('#infantSelect').val(); i++) {
      if(i==0) {
        $(".infant-div-copy").removeClass("d-none");
      } else {
        container = $(".infant-div-copy").clone().removeClass("infant-div-copy").removeClass("d-none").addClass("clone-info").appendTo(".infantDetails");
        $('.infantDetails').removeClass('d-none');
      }
		}
    if(0 == $('#infantSelect').val()) {
      $('.infantDetails .clone-info').remove();
      $('.infantDetails').addClass('d-none');
    } else {
      $('.infantDetails').removeClass('d-none');
    }

    var fare = parseInt($("#single_fare").val());
    $('.adult_total_price').html(adultCount*fare);
    $('.infant_total_price').html(infantCount*1600);
    var infantPrice = 0;
    if($('#infantSelect').val() > 0) {
      infantPrice = 1600*parseInt($('#infantSelect').val())
    }
    var totalPrice = parseInt((fare*parseInt($('#itemSelect').val())))+parseInt(infantPrice);
    $("#total_fare").html('<i class="fas fa-rupee-sign"></i> '+totalPrice);
    $("#price").val((fare*$('#itemSelect').val())+infantPrice+(taxes*$('#itemSelect').val()));
	});
  
	$('#itemSelect').trigger('change');
</script>
@stop
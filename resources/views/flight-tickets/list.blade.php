@extends('inner')
@section('main')
@php 
    $agency = request()->agency;
    use Carbon\Carbon;
@endphp
<div class="bg-inner small-section pb-0">
        <div class="container">
            <div class="flight-search">
                <div class="responsive-detail">
                    <div class="destination">
                        <span>{{$fromAirport->cityName}}</span>
                        <span><i class="fas fa-long-arrow-alt-right"></i></span>
                        <span>{{$toAirport->cityName}}</span>
                    </div>
                    <div class="details">
                        <span><?php echo array_key_exists('flight_date', $_GET) ? date('D, d-M-Y',strtotime($_GET['flight_date'])) : '' ?></span>
                        <span class="divider">|</span>
                        <?php 
                        $label = '';
                        if(array_key_exists('adults', $_GET)){
                            $label .= $_GET['adults'].' Adults';
                            $adults = $_GET['adults'];
                        } else { 
                            $label .= '0 Adults';
                        } 
                        if(array_key_exists('infants', $_GET) && $_GET['infants']>0){
                            $label .= ' / ' .$_GET['infants'].' Infants';
                            $infants = $_GET['infants'];
                        }
                        ?>
                        <span>{{$label}}</span>
                    </div>
                    <div class="modify-search">
                        <a href="javascript:void(0)" class="btn btn-solid color1"> modify search</a>
                    </div>
                </div>
                <div class="flight-search-detail">
                    <form class="row m-0" action="/flight-tickets/list">
                        <div class="col-lg-2 pr-0">
                            <div class="form-group">
                                <label>from</label>
                                <input type="text" id="flying_from" data-location="from" class="form-control open-select typeahead" id="exampleInputEmail1"
                                    value="{{$fromAirport->cityName}}" placeholder="from">
                                    
                                <span class="exchange-flight-inner" onclick="swapValues();return false;"><img src="/assets/images/icon/exchange-icon.png"></span>
                            </div>
                        </div>
                        <div class="col-lg-2 pl-0">
                            <div class="form-group">
                                <label>to</label>
                                <input type="text" id="flying_to" data-location="to" class="form-control open-select typeahead" value="{{$toAirport->cityName}}" placeholder="to">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>departure date</label>
                                <input placeholder="Depart Date" name="flight_date" class="form-control" value="<?php echo array_key_exists('flight_date', $_GET) ? $_GET['flight_date'] : '' ?>" id="datepicker" />
                            </div>
                        </div>
                        
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>travellers</label>
                                
                                <?php 
                                    $label = '';
                                    $adults = 0;
                                    $infants = 0;
                                    if(array_key_exists('adults', $_GET)){
                                        $label .= $_GET['adults'].' Adults';
                                        $adults = $_GET['adults'];
                                    } else { 
                                        $label .= '0 Adults';
                                    } 
                                    if(array_key_exists('infants', $_GET)){
                                        $label .= ' / ' .$_GET['infants'].' Infants';
                                        $infants = $_GET['infants'];
                                    } else { 
                                        $label .= ' / 0 Infants';
                                    } 
                                ?>
                                <div class="form-control traveler_count open-select">{{$label}}</div>
                                <img src="/assets/images/icon/user.png" class="img-fluid blur-up lazyload" alt="">
                                <div class="selector-box-flight">
                                <div class="room-cls">
                                    <div class="qty-box">
                                        <label>adult</label>
                                        <div class="input-group">
                                            <button type="button" class="btn quantity-left-minus"
                                                data-type="minus" data-field=""> - </button>
                                            <input type="text" name="adults"
                                                class="form-control qty-input input-number adults"
                                                value="<?php if(array_key_exists('adults', $_GET)){echo $_GET['adults']; } else { echo 0; } ?>">
                                            <button type="button" class="btn quantity-right-plus"
                                                data-type="plus" data-field="">+</button>
                                        </div>
                                    </div>
                                    <div class="qty-box">
                                        <label>infants</label>
                                        <div class="input-group">
                                            <button type="button" class="btn quantity-infant-left-minus"
                                                data-type="minus" data-field=""> - </button>
                                            <input type="text" name="infants"
                                                class="form-control qty-input input-number infants"
                                                value="<?php if(array_key_exists('infants', $_GET)){echo $_GET['infants']; } else { echo 0; } ?>">
                                            <button type="button" class="btn quantity-right-plus"
                                                data-type="plus" data-field=""> + </button>
                                        </div>
                                    </div>
                                </div>
                                    
                                    <div class="bottom-part">
                                        <a href="javascript:void(0)" class="btn apply_travellers">apply</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="from_arpt" id="from_arpt" value="{{$fromAirport->id}}"/>
                        <input type="hidden" name="to_arpt" id="to_arpt" value="{{$toAirport->id}}"/>
                        <div class="col-lg-2">
                            <div class="search-btn">
                                <button type="submit" class="btn btn-solid color1">search</a>
                            </div>
                        </div>
                        <div class="responsive-close">
                            <i class="far fa-times-circle"></i>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <section class="pt-0 bg-inner small-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left-sidebar">
                        <div class="back-btn">
                            back
                        </div>
                        
                        <div class="middle-part collection-collapse-block open">
                            <a href="javascript:void(0)" class="section-title collapse-block-title">
                                <h5>latest filter</h5>
                                <img src="/assets/images/icon/adjust.png" class="img-fluid blur-up lazyload" alt="">
                            </a>
                            <div class="collection-collapse-block-content ">
                                <div class="filter-block">
                                    <div class="collection-collapse-block open">
                                        <h6 class="collapse-block-title">stops</h6>
                                        <div class="collection-collapse-block-content">
                                            <div class="collection-brand-filter">
                                                <div class="custom-control custom-checkbox collection-filter-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="free-d">
                                                    <label class="custom-control-label" for="free-d">non stop</label>
                                                </div>
                                                <div class="custom-control custom-checkbox collection-filter-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="time">
                                                    <label class="custom-control-label" for="time">1 stop</label>
                                                </div>
                                                <div class="custom-control custom-checkbox collection-filter-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="zara">
                                                    <label class="custom-control-label" for="zara">2 stop</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-block">
                                    <div class="collection-collapse-block open">
                                        <h6 class="collapse-block-title">price</h6>
                                        <div class="collection-collapse-block-content">
                                            <div class="wrapper">
                                                <div class="range-slider">
                                                    <input type="text" class="js-range-slider" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-block">
                                    <div class="collection-collapse-block open">
                                        <h6 class="collapse-block-title">airlines</h6>
                                        <div class="collection-collapse-block-content">
                                            <div class="collection-brand-filter">
                                                <div class="custom-control custom-checkbox collection-filter-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="wifi">
                                                    <label class="custom-control-label" for="wifi">Air India</label>
                                                </div>
                                                <div class="custom-control custom-checkbox collection-filter-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="spa">
                                                    <label class="custom-control-label" for="spa">Vistara
                                                        </label>
                                                </div>
                                                <div class="custom-control custom-checkbox collection-filter-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="pet">
                                                    <label class="custom-control-label" for="pet">IndiGo</label>
                                                </div>
                                                <div class="custom-control custom-checkbox collection-filter-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="parking">
                                                    <label class="custom-control-label" for="parking">GoAir
                                                        </label>
                                                </div>
                                                <div class="custom-control custom-checkbox collection-filter-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="swimming">
                                                    <label class="custom-control-label" for="swimming">Air India Express</label>
                                                </div>
                                                <div class="custom-control custom-checkbox collection-filter-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="chinese">
                                                    <label class="custom-control-label" for="chinese">SpiceJet</label>
                                                </div>
                                                <div class="custom-control custom-checkbox collection-filter-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="restaurant">
                                                    <label class="custom-control-label" for="restaurant">AirAsia India</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-block">
                                    <div class="collection-collapse-block open">
                                        <h6 class="collapse-block-title">departure time</h6>
                                        <div class="collection-collapse-block-content">
                                            <div class="collection-brand-filter">
                                                <div class="custom-control custom-checkbox collection-filter-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="suomi">
                                                    <label class="custom-control-label" for="suomi"><img
                                                            src="/assets/images/icon/time/sunrise.png"
                                                            class="img-fluid blur-up lazyload mr-1" alt=""> morning (6am
                                                        to 12pm)</label>
                                                </div>
                                                <div class="custom-control custom-checkbox collection-filter-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="english">
                                                    <label class="custom-control-label" for="english"><img
                                                            src="/assets/images/icon/time/sun.png"
                                                            class="img-fluid blur-up lazyload mr-1" alt=""> noon (12pm
                                                        to 6pm)</label>
                                                </div>
                                                <div class="custom-control custom-checkbox collection-filter-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="sign">
                                                    <label class="custom-control-label" for="sign"><img
                                                            src="/assets/images/icon/time/night.png"
                                                            class="img-fluid blur-up lazyload mr-1" alt=""> evening
                                                        (after 6pm)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-block">
                                    <div class="collection-collapse-block open">
                                        <h6 class="collapse-block-title">arrival time</h6>
                                        <div class="collection-collapse-block-content">
                                            <div class="collection-brand-filter">
                                                <div class="custom-control custom-checkbox collection-filter-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="morning">
                                                    <label class="custom-control-label" for="morning"><img
                                                            src="/assets/images/icon/time/sunrise.png"
                                                            class="img-fluid blur-up lazyload mr-1" alt=""> morning (6am
                                                        to 12pm)</label>
                                                </div>
                                                <div class="custom-control custom-checkbox collection-filter-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="noon">
                                                    <label class="custom-control-label" for="noon"><img
                                                            src="/assets/images/icon/time/sun.png"
                                                            class="img-fluid blur-up lazyload mr-1" alt=""> noon (12pm
                                                        to 6pm)</label>
                                                </div>
                                                <div class="custom-control custom-checkbox collection-filter-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="evening">
                                                    <label class="custom-control-label" for="evening"><img
                                                            src="/assets/images/icon/time/night.png"
                                                            class="img-fluid blur-up lazyload mr-1" alt=""> evening
                                                        (after 6pm)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bottom-info">
                            <h5><span>i</span> need help</h5>
                            <h4>{{$agency->phone}}</h4>
                            <h6>Monday to Saturday 9.00am - 9.30pm</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 ratio3_2">
                    <a href="javascript:void(0)" class="mobile-filter border-top-0">
                        <h5>latest filter</h5>
                        <img src="/assets/images/icon/adjust.png" class="img-fluid blur-up lazyload" alt="">
                    </a>
                    <?php 
                    if($availableDates):
                    ?>
                        <div class="top-bar-flight">
                            <div class="date-fare-slider">
                                <div class="fare-6">
                                    <?php
                                        $repeatDay = [];
                                        foreach($availableDates as $date):
                                            if(!in_array($date, $repeatDay)):
                                                $repeatDay[] = $date;
                                            else:
                                                continue;
                                            endif;
                                    ?>
                                            <div>
                                                <a href="/flight-tickets/list?flight_date={{date('d-m-Y', strtotime($date))}}&adults={{$adults}}&infants={{$infants}}&from_arpt={{$fromAirport->id}}&to_arpt={{$toAirport->id}}">
                                                    <div class="fare-box">
                                                        <h5 class="date">{{date('d M', strtotime($date))}}</h5>
                                                    </div>
                                                </a>
                                            </div>
                                    <?php
                                        endforeach;
                                    ?>
                                </div>
                            </div>
                            <!-- <div class="fare-calender">
                                <div>
                                    <i class="far fa-calendar-alt"></i>
                                    <h6 class="title">fare calender</h6>
                                </div>
                                <div class="calender-external">
                                    <div id='calendar'></div>
                                </div>
                            </div>-->
                        </div>
                    <?php 
                    endif;
                    ?>
                    <div class="flight-detail-sec">
                        <div class="title-bar">
                            <div class="row">
                                <div class="col-2">
                                    <p>Airline</p>
                                </div>
                                <div class="col-5">
                                    <p>departure & arrival</p>
                                </div>
                                <div class="col-2">
                                    <p>price</p>
                                </div>
                            </div>
                        </div>
                        @if($flights && !$validationErrors)
                        <div class="detail-bar">
                            @foreach($flights as $flight) 
                                                
                                @php
                                    $price = $flight->getAgencyPrice(true);
                                    
                                    $seatCount = $flight['number_of_tickets']-$flight['number_of_sold_tickets'];
                                @endphp
                                @if($seatCount > 0) 
                                    <div class="detail-wrap wow fadeInUp">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="logo-sec">
                                                    <img src="/assets/images/airline-logos/{{$flight['airline']['logo']}}"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                    <span class="title">{{$flight['airline']['name']}}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="airport-part">
                                                    <div class="airport-name">
                                                        <h4>{{date('H:i', strtotime($flight['departure_date_time']))}}</h4>
                                                        <h6>{{$flight['flightTicketsDestination']['fromAirport']['code']}}</h6>
                                                    </div>
                                                    <div class="airport-progress">
                                                        <i class="fas fa-plane-departure float-left"></i>
                                                        <i class="fas fa-plane-arrival float-right"></i>
                                                        <div class="stop">
                                                            <?php 
                                                                $t1 = Carbon::parse($flight['arrival_date_time']);
                                                                $t2 = Carbon::parse($flight['departure_date_time']);
                                                                $diff = $t2->diff($t1);
                                                            ?>
                                                            @if($diff->d)
                                                                {{$diff->d}}d
                                                            @endif
                                                            {{$diff->h}}h {{$diff->i}}m
                                                        </div>
                                                    </div>
                                                    <div class="airport-name arrival">
                                                        <h4>{{date('H:i', strtotime($flight['arrival_date_time']))}}</h4>
                                                        <h6>{{$flight['flightTicketsDestination']['toAirport']['code']}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="price">
                                                    <div>
                                                        <h4>INR {{$price}}/-</h4>
                                                        <span>non refundable</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="book-flight pt-3">
                                                    <div>
                                                        @php
                                                            $params = null;
                                                            if($query) {
                                                                $params = '?' . http_build_query($query);
                                                            }
                                                        @endphp
                                                        <a href="/flight-tickets/book/{{$flight['id']}}{{$params}}" class="btn btn-solid color1">book now</a>
                                                        
                                                    </div>
                                                    <small class="clearfix">{{$seatCount}} Seat<?php if($seatCount > 1):?>s<?php endif; ?> available</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
$(document).ready(function(){
    loadCalendar();
    var bestPictures = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        identify: function(obj) { return obj.name; },
        prefetch: '/api/v1/common/load-airports',
        remote: {
            url: '/api/v1/common/load-airports?query=%QUERY',
            wildcard: '%QUERY'
        }
    });
    $('.typeahead').typeahead({
            minLength: 0,
            highlight: true
        }, 
        {
        name: 'best-pictures',
        limit: 20,
        display: 'name',
        source: bestPictures,
        templates: {
            empty: [
            '<div class="empty-message">',
                'Unable to find any Airport that match the current query',
            '</div>'
            ].join('\n'),
            suggestion: function(data) {
                return '<div><strong>'+data.name+'</strong><br/><small>'+data.cityCode+'-'+data.airportname+'</small></div>';
            }
        }
    }).on('typeahead:selected', function(e, datum){

        if('from' == $(this).data('location')) {
            $('#from_arpt').val(datum['id']);
        } else if('to' == $(this).data('location')) {
            $('#to_arpt').val(datum['id']);
        }

        loadCalendar();
    });

    $('.apply_travellers').click(function(){
        var adultCount = $('.qty-input.adults').val();
        var infantCount = $('.qty-input.infants').val();
        $('.traveler_count').text(adultCount+' Adults / '+infantCount+' Infant');
        $(".selector-box-flight").removeClass("show");
    });
});

function swapValues() {
    var airportFrom = $('#from_arpt').val();
    var airportTo = $('#to_arpt').val();
    $('#from_arpt').val(airportTo);
    $('#to_arpt').val(airportFrom);
    var textFlyingFrom = $('#flying_from').val();
    $('#flying_from').val($('#flying_to').val());
    $('#flying_to').val(textFlyingFrom);
    $( "#datepicker" ).val('');
    $('.detail-bar').html("<strong>Please select date and search for flights.<strong>");
    loadCalendar();

}

function loadCalendar() {

    var from = $('#from_arpt').val();
    var to = $('#to_arpt').val();

    if(from && to) {
        $('.skeleton_loader').show();
        var sector = from+'-'+to;
        $.ajax({
            method: "POST",
            url: "/api/v1/common/flight-tickets/load-availability",
            data: {"sector": sector,  },
            context: document.body
        }).done(function(availability) {
            $('.skeleton_loader').hide();
            $( "#datepicker" ).datepicker("destroy");
            $( "#datepicker" ).datepicker({
                uiLibrary: 'bootstrap4',
                minDate:0,
                dateFormat: 'dd-mm-yy',
                beforeShowDay: function(date) {
                    var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                    return [ availability.indexOf(string) != -1 ];
                }
            });
        });
    }
}
</script>
    @stop
<!DOCTYPE html>
<html lang="en">
@php 
    $agency = request()->agency;
    $user = auth()->user();
@endphp

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        $setting = $agency->getWebsiteSetting('meta_description');
        $description = $setting ? $setting->value : '';
        $setting = $agency->getWebsiteSetting('meta_keywords');
        $keywords = $setting ? $setting->value : '';
    ?>
    <meta name="description" content="{{$description}}">
    <meta name="keywords" content="{{$keywords}}">
    <meta name="author" content="{{$agency->name}}">
    <link rel="icon" href="/assets/images/favicon.png" type="image/x-icon" />
    <title>{{$agency->name}}</title>

    <!--Google font-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Vampiro+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script:400,700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.css">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="/assets/css/animate.css">

    <!-- Date-time picker css -->
    <link rel="stylesheet" type="text/css" href="/assets/css/datepicker.min.css">

    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="/assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/slick-theme.css">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="/assets/css/magnific-popup.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/vendor/jquery-ui/jquery-ui.css">
    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="/assets/css/themify-icons.css">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="/assets/{{$agency->agency_access_code}}/css/color2.css">

    <link rel="stylesheet" type="text/css" href="/assets/css/common.css">
</head>

<body>


    <!-- pre-loader start -->
    <div class="loader-wrapper img-gif">
        <img src="/assets/images/loader.gif" alt="">
    </div>
    <!-- pre-loader end -->


    <!-- header start -->
    <header class="overlay-black">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="menu">
                        <div class="brand-logo">
                            <a href="../index.html">
                                <img src="/assets/{{$agency->agency_access_code}}/images/logos/logo.png" alt=""
                                    class="img-fluid blur-up lazyload">
                            </a>
                        </div>
                        @if($user)
                            @include('navigation')
                        @endif
                        
                    </div>
                </div>
                @if(!$user)
                    <div class="col-7 pr-0 top-contact">

                        <?php 
                            $setting = $agency->getWebsiteSetting('homepage_top_corner_contact');
                            $contact = $setting ? $setting->value : '';
                            echo $contact;
                        ?>
                    </div>
                @endif
            </div>
        </div>
    </header>
    <!--  header end -->

    <!-- home section start -->
    <section class="cab-section flight-section home-section p-0">
        <img src="/assets/{{$agency->agency_access_code}}/images/wallpaper/sky.jpg" class="img-fluid blur-up lazyload bg-img" alt="">
        <div class="cloud">
            <img src="/assets/images/flights/cloud-real.png" alt="" class="bg-img">
        </div>
       
        <div class="container">
           
            <div class="row">
                <div class="col-lg-12 m-auto">
                    <div class=" search-content mix-layout smaller-content">
                        @if($agency->is_b_to_c || $user)
                            <div class="bg-transparent">
                                <div id="sticky_cls">
                                    <div class="search-panel">
                                        <div class="search-section">
                                            <div class="search-box rounded10">
                                                <div class="cab-content">
                                                    
                                                        <div>
                                                            <div class="radio-form">
                                                                <input id="radio-2" type="radio" name="exampleRadios" value="option2" checked>
                                                                <label for="radio-2" class="radio-label">one way</label>
                                                            <!-- <input id="radio-1" type="radio" name="exampleRadios" value="option1">
                                                                <label for="radio-1" class="radio-label">round trip</label> -->
                                                            </div>
                                                            <form action="/flight-tickets/list">
                                                                <div class="row">
                                                                    <div class="col-lg-4 form-group pr-lg-0">
                                                                        
                                                                        <span class="form-label"> 
                                                                        <input type="text" id="flying_from" class="form-control typeahead" data-location="from" placeholder="from">  
                                                                        <span class="exchange-flight-inner d-none d-sm-block" onclick="swapValues();return false;">
                                                                            <img src="/assets/images/icon/exchange-icon.png">
                                                                        </span> 
                                                                    </div>
                                                                    <span class="exchange-flight-inner d-block d-sm-none ml-5" onclick="swapValues();return false;">
                                                                        <img src="/assets/images/icon/exchange-icon.png">
                                                                    </span> 
                                                                    <div class="col-lg-4 form-group pl-lg-0">
                                                                        <input type="text" id="flying_to" class="form-control typeahead" data-location="to" placeholder="to">
                                                                    </div>
                                                                    <div class="col">
                                                                        <input placeholder="Travel Date" name="flight_date" class="form-control" id="datepicker" />
                                                                    </div>
                                                                    <div id="dropdate" class="col">
                                                                        <input placeholder="Return Date" class="form-control" id="datepicker1" />
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group mb-1">
                                                                    <div class="row">
                                                                        <div class="col-lg-4 offset-lg-8 col-sm-12">
                                                                            <div class="form-group">
                                                                                <div class="form-control traveler_count open-select">Travellers</div>
                                                                                <img src="/assets/images/icon/user.png"
                                                                                    class="img-fluid blur-up lazyload" alt="">
                                                                                <div class="selector-box-flight">
                                                                                    <div class="room-cls">
                                                                                        <div class="qty-box">
                                                                                            <label>adult</label>
                                                                                            <div class="input-group">
                                                                                                <button type="button" class="btn quantity-left-minus"
                                                                                                    data-type="minus" data-field=""> - </button>
                                                                                                <input type="text" name="adults"
                                                                                                    class="form-control qty-input input-number adults"
                                                                                                    value="1">
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
                                                                                                    value="0">
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
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="from_arpt" id="from_arpt" value=""/>
                                                                <input type="hidden" name="to_arpt" id="to_arpt" value=""/>
                                                                <button type="submit" class="btn btn-rounded btn-sm color1 float-right">search
                                                                now</button>
                                                            </form>
                                                            
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <section class="section-b-space ticket-section animated-section">
        <div class="container">
            
            <div>
                <div>
                    <div class="row">
                        <div class="col-lg-6 col-md-10 ">
                            <?php 
                             $setting = $agency->getWebsiteSetting('homepage_offer_section_content');
                             $offer = $setting ? $setting->value : '';
                             echo $offer;
                            ?>
                        </div>
                        <div class="col-lg-5 col-md-10">
                            @if(!$user)
                                <div class="ticket-box">
                                    
                                    <div class="content">
                                        <div class="detail">
                                            <h4>Are you a Partner?</h4>
                                            <h5>Signin here !</h5>
                                            <!-- Session Status -->
                                            <x-auth-session-status class="mb-4" :status="session('status')" />

                                            <!-- Validation Errors -->
                                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email address</label>
                                                    <input type="email" name="email" :value="old('email')" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                                        anyone else.</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Password</label>
                                                    <input type="password"  name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                                </div>
                                                <div class="form-group form-check">
                                                    <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
                                                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                                                </div>
                                                <div class="button-bottom">
                                                    <button type="submit" class="w-100 btn btn-solid">login</button>
                                                    <div class="divider" style="text-align: center;">
                                                        <h6>or</h6>
                                                    </div>
                                                    <button type="button" class="w-100 btn btn-solid btn-outline" onclick="window.location.href = '/register';">create account</button>
                                                </div>
                                            </form>
                                        </div>
                                    
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    </section>
    
    <footer>
        <div class="sub-footer">
            <div class="container">
                <div class="row ">
                    <div class="col-xl-6 col-md-6 col-sm-12">
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="copy-right">
                            <p>copyright {{date('Y')}} {{request()->agency->name}} By <i class="fas fa-heart"></i> <a target="_blank" href="https://tripgofersolutions.com">TripGofer</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->


    <!-- tap to top -->
    <div class="tap-top">
        <div>
            <i class="fas fa-angle-up"></i>
        </div>
    </div>
    <!-- tap to top end -->


    <!-- setting start -->
   
    <!-- setting end -->


    <!-- latest jquery-->
    <script src="/assets/js/jquery-3.5.1.min.js"></script>

    <!-- popper js-->
    <script src="/assets/js/popper.min.js"></script>

    <!-- date-time picker js -->
    <script src="/assets/js/date-picker.js"></script>

    <!-- footer reveal js -->
    <script src="/assets/js/footer-reveal.min.js"></script>

    <!-- video js-->
    <script src="/assets/js/jquery.vide.min.js"></script>

    <!-- slick js-->
    <script src="/assets/js/slick.js"></script>

    <!-- Bootstrap js-->
    <script src="/assets/js/bootstrap.js"></script>

    <!-- lazyload js-->
    <script src="/assets/js/lazysizes.min.js"></script>

    
  <script src="/assets/js/handlebars.js"></script>
  <script src="/assets/js/typeahead.bundle.js"></script>

  <script src="/assets/vendor/jquery-ui/jquery-ui.js"></script>

    <!-- Theme js-->
    <script src="/assets/js/script.js"></script>

    <script>
        $('#datepicker1').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
@if($agency->is_b_to_c || $user)
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
        $( "#flying_from" ).focus();
        $( "#flying_from" ).blur();
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
        loadCalendar();

    }

    function loadCalendar() {

        var from = $('#from_arpt').val();
        var to = $('#to_arpt').val();

        if(from && to) {
            $('.loader-wrapper').show();
            var sector = from+'-'+to;
            $.ajax({
                method: "POST",
                url: "/api/v1/common/flight-tickets/load-availability",
                data: {"sector": sector,  },
                context: document.body
            }).done(function(availability) {
                $('.loader-wrapper').hide();
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
@endif
</body>
</html>
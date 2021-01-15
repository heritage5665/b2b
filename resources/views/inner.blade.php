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
    <link rel="icon" href="/assets/images/favicon.png" type="image/x-icon" />
    <title>{{$agency->name}}</title>

    <!--Google font-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.css">

    <!-- Animation -->
    <link rel="stylesheet" type="text/css" href="/assets/css/animate.css">

    <!-- Date-time picker css -->
    <link rel="stylesheet" type="text/css" href="/assets/css/datepicker.min.css">

    <!-- fare calender -->
    <link rel="stylesheet" type="text/css" href="/assets/css/fare-calender.css">

    <!-- price range css -->
    <link rel="stylesheet" type="text/css" href="/assets/css/price-range.css">

    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="/assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/slick-theme.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">

    <link rel="stylesheet" href="/assets/vendor/jquery-ui/jquery-ui.css">
    
    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="/assets/{{$agency->agency_access_code}}/css/color2.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/common.css">

    <!-- latest jquery-->
    <script src="/assets/js/jquery-3.5.1.min.js"></script>

    <script src="/assets/js/handlebars.js"></script>
    <script src="/assets/js/typeahead.bundle.js"></script>
    <script src="/assets/vendor/jquery-ui/jquery-ui.js"></script>
</head>

<body>
    <!-- pre-loader start -->
    <div class="skeleton_loader">
        <header class="light_header">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="menu">
                            <div class="brand-logo">
                                <a href="/">
                                    <img src="/assets/{{$agency->agency_access_code}}/images/logos/logo.png" alt=""
                                        class="img-fluid blur-up lazyload">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <div class="bg-inner small-section pb-0">
            <div class="container">
                <div class="flight-search">
                    <div class="responsive-detail">
                        <div class="destination">
                            <span></span>
                        </div>
                        <div class="details">
                            <span></span>
                        </div>
                        <div class="modify-search">
                            <div class="ldr-btn"></div>
                        </div>
                    </div>
                    <div class="flight-search-detail">
                        <form class="row m-0">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label></label>
                                    <input type="text" class="form-control open-select">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label></label>
                                    <input type="text" class="form-control open-select">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label></label>
                                    <input type="text" class="form-control open-select">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label></label>
                                    <input type="text" class="form-control open-select">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label></label>
                                    <input type="text" class="form-control open-select">
                                </div>
                            </div>
                            <div class="col-lg-2 search-col">
                                <div class="form-group">
                                    <input type="text" class="form-control open-select">
                                </div>
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
                            <div class="search-bar">
                                <input>
                            </div>
                            <div class="middle-part collection-collapse-block open">
                                <a href="javascript:void(0)" class="section-title collapse-block-title">
                                    <h5></h5>
                                </a>
                                <div class="collection-collapse-block-content ">
                                    <div class="filter-block">
                                        <div class="collection-collapse-block open">
                                            <h6 class="collapse-block-title"></h6>
                                            <div class="collection-collapse-block-content">
                                                <div class="collection-brand-filter">
                                                    <div
                                                        class="custom-control custom-checkbox collection-filter-checkbox">
                                                        <input class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-checkbox collection-filter-checkbox">
                                                        <input class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-checkbox collection-filter-checkbox">
                                                        <input class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-checkbox collection-filter-checkbox">
                                                        <input class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-checkbox collection-filter-checkbox">
                                                        <input class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-checkbox collection-filter-checkbox">
                                                        <input class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-checkbox collection-filter-checkbox">
                                                        <input class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-block">
                                        <div class="collection-collapse-block open">
                                            <h6 class="collapse-block-title"></h6>
                                            <div class="collection-collapse-block-content">
                                                <div class="collection-brand-filter">
                                                    <div
                                                        class="custom-control custom-checkbox collection-filter-checkbox">
                                                        <input class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-checkbox collection-filter-checkbox">
                                                        <input class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-checkbox collection-filter-checkbox">
                                                        <input class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-checkbox collection-filter-checkbox">
                                                        <input class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-block">
                                        <div class="collection-collapse-block open">
                                            <h6 class="collapse-block-title"></h6>
                                            <div class="collection-collapse-block-content">
                                                <div class="collection-brand-filter">
                                                    <div
                                                        class="custom-control custom-checkbox collection-filter-checkbox">
                                                        <input class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-block">
                                        <div class="collection-collapse-block open">
                                            <h6 class="collapse-block-title"></h6>
                                            <div class="collection-collapse-block-content">
                                                <div class="collection-brand-filter">
                                                    <div
                                                        class="custom-control custom-checkbox collection-filter-checkbox">
                                                        <input class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-checkbox collection-filter-checkbox">
                                                        <input class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-checkbox collection-filter-checkbox">
                                                        <input class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-block">
                                        <div class="collection-collapse-block open">
                                            <h6 class="collapse-block-title"></h6>
                                            <div class="collection-collapse-block-content">
                                                <div class="collection-brand-filter">
                                                    <div
                                                        class="custom-control custom-checkbox collection-filter-checkbox">
                                                        <input class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-checkbox collection-filter-checkbox">
                                                        <input class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-checkbox collection-filter-checkbox">
                                                        <input class="custom-control-input">
                                                        <label class="custom-control-label"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 ratio3_2">
                        <a href="javascript:void(0)" class="mobile-filter border-top-0">
                            <h5></h5>
                            <img src="/assets/images/icon/adjust.png" class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <div class="top-bar-flight">
                            <div class="date-fare-slider">
                                <div class="fare-6">
                                    <div>
                                        <a href="javascript:void(0)">
                                            <div class="fare-box">
                                                <h5 class="date"></h5>
                                                <h6 class="fare"></h6>
                                            </div>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)">
                                            <div class="fare-box">
                                                <h5 class="date"></h5>
                                                <h6 class="fare"></h6>
                                            </div>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)">
                                            <div class="fare-box active">
                                                <h5 class="date"></h5>
                                                <h6 class="fare"></h6>
                                            </div>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)">
                                            <div class="fare-box">
                                                <h5 class="date"></h5>
                                                <h6 class="fare"></h6>
                                            </div>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)">
                                            <div class="fare-box">
                                                <h5 class="date"></h5>
                                                <h6 class="fare"></h6>
                                            </div>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)">
                                            <div class="fare-box">
                                                <h5 class="date"></h5>
                                                <h6 class="fare"></h6>
                                            </div>
                                        </a>
                                    </div>
                                    <div>
                                        <div class="fare-box">
                                            <h5 class="date"></h5>
                                            <h6 class="fare"></h6>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)">
                                            <div class="fare-box">
                                                <h5 class="date"></h5>
                                                <h6 class="fare"></h6>
                                            </div>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)">
                                            <div class="fare-box">
                                                <h5 class="date"></h5>
                                                <h6 class="fare"></h6>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="fare-calender">
                                <div>
                                    <i></i>
                                    <h6 class="title"></h6>
                                </div>
                                <div class="calender-external">
                                </div>
                            </div>
                        </div>
                        <div class="flight-detail-sec">
                            <div class="title-bar">
                                <div class="row">
                                    <div class="col-2">
                                        <p></p>
                                    </div>
                                    <div class="col-5">
                                        <p></p>
                                    </div>
                                    <div class="col-2">
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                            <div class="detail-bar">
                                <div class="detail-wrap">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="logo-sec">
                                                <div class="ldr-img"></div>
                                                <span class="title"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="airport-part">
                                                <div class="airport-name">
                                                    <h4></h4>
                                                    <h6></h6>
                                                </div>
                                                <div class="airport-progress">
                                                    <div class="stop">
                                                    </div>
                                                </div>
                                                <div class="airport-name arrival">
                                                    <h4></h4>
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="price">
                                                <div>
                                                    <h4></h4>
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="book-flight">
                                                <div class="ldr-btn"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="detail-wrap">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="logo-sec">
                                                <div class="ldr-img"></div>
                                                <span class="title"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="airport-part">
                                                <div class="airport-name">
                                                    <h4></h4>
                                                    <h6></h6>
                                                </div>
                                                <div class="airport-progress">
                                                    <div class="stop">
                                                    </div>
                                                </div>
                                                <div class="airport-name arrival">
                                                    <h4></h4>
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="price">
                                                <div>
                                                    <h4></h4>
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="book-flight">
                                                <div class="ldr-btn"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="detail-wrap">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="logo-sec">
                                                <div class="ldr-img"></div>
                                                <span class="title"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="airport-part">
                                                <div class="airport-name">
                                                    <h4></h4>
                                                    <h6></h6>
                                                </div>
                                                <div class="airport-progress">
                                                    <div class="stop">
                                                    </div>
                                                </div>
                                                <div class="airport-name arrival">
                                                    <h4></h4>
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="price">
                                                <div>
                                                    <h4></h4>
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="book-flight">
                                                <div class="ldr-btn"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="detail-wrap">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="logo-sec">
                                                <div class="ldr-img"></div>
                                                <span class="title"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="airport-part">
                                                <div class="airport-name">
                                                    <h4></h4>
                                                    <h6></h6>
                                                </div>
                                                <div class="airport-progress">
                                                    <div class="stop">
                                                    </div>
                                                </div>
                                                <div class="airport-name arrival">
                                                    <h4></h4>
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="price">
                                                <div>
                                                    <h4></h4>
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="book-flight">
                                                <div class="ldr-btn"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="detail-wrap">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="logo-sec">
                                                <div class="ldr-img"></div>
                                                <span class="title"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="airport-part">
                                                <div class="airport-name">
                                                    <h4></h4>
                                                    <h6></h6>
                                                </div>
                                                <div class="airport-progress">
                                                    <div class="stop">
                                                    </div>
                                                </div>
                                                <div class="airport-name arrival">
                                                    <h4></h4>
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="price">
                                                <div>
                                                    <h4></h4>
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="book-flight">
                                                <div class="ldr-btn"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="detail-wrap">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="logo-sec">
                                                <div class="ldr-img"></div>
                                                <span class="title"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="airport-part">
                                                <div class="airport-name">
                                                    <h4></h4>
                                                    <h6></h6>
                                                </div>
                                                <div class="airport-progress">
                                                    <div class="stop">
                                                    </div>
                                                </div>
                                                <div class="airport-name arrival">
                                                    <h4></h4>
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="price">
                                                <div>
                                                    <h4></h4>
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="book-flight">
                                                <div class="ldr-btn"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="detail-wrap">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="logo-sec">
                                                <div class="ldr-img"></div>
                                                <span class="title"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="airport-part">
                                                <div class="airport-name">
                                                    <h4></h4>
                                                    <h6></h6>
                                                </div>
                                                <div class="airport-progress">
                                                    <div class="stop">
                                                    </div>
                                                </div>
                                                <div class="airport-name arrival">
                                                    <h4></h4>
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="price">
                                                <div>
                                                    <h4></h4>
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="book-flight">
                                                <div class="ldr-btn"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- per-loader end -->


    <!-- header start -->
    <header class="light_header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="menu">
                        <div class="brand-logo">
                            <a href="/">
                                <img src="/assets/{{$agency->agency_access_code}}/images/logos/logo.png" alt=""
                                    class="img-fluid blur-up lazyload">
                            </a>
                        </div>
                        @if($user)
                            @include('navigation')
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--  header end -->
    @yield('main')
    <!-- footer start -->
    <footer>
       
        <div class="sub-footer">
            <div class="container">
                <div class="row ">
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="footer-social">
                            
                        </div>
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



    <!-- popper js-->
    <script src="/assets/js/popper.min.js"></script>

    <!-- filter js -->
    <script src="/assets/js/filter.js"></script>
    <script src="/assets/js/isotope.min.js"></script>

    <!-- fare calender -->
    <script src="/assets/js/fare-calender/main.js"></script>
    <script src="/assets/js/fare-calender/main_1.js"></script>
    <script src="/assets/js/fare-calender/calender-data.js"></script>

    <!-- date-time picker js -->

    <!-- price range js -->
    <script src="/assets/js/price-range.js"></script>

    <!-- wow js-->
    <script src="/assets/js/wow.min.js"></script>

    <!-- slick js-->
    <script src="/assets/js/slick.js"></script>

    <!-- Bootstrap js-->
    <script src="/assets/js/bootstrap.js"></script>

    <!-- lazyload js-->
    <script src="/assets/js/lazysizes.min.js"></script>

    <!-- Theme js-->
    <script src="/assets/js/script.js"></script>

    <script>
        new WOW().init();
    </script>


</body>

</html>
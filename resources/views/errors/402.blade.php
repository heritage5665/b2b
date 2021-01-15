@extends('inner')
@section('main')
<section class="breadcrumb-section small-sec flight-sec pt-0">
    <img src="/assets/images/flights/flight-breadcrumb2.jpg" class="bg-img img-fluid blur-up lazyload" alt="">
    <div class="content-bottom">
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="/flight-tickets/list">flights</a></li>
                            <li class="breadcrumb-item active">Tickets sold</li>
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
                        <h5>Tickets sold</h5>
                    </div>
                    <div class="flight_detail">
                        <div class="row">
                            <div class="col-md-12">
                              <div class="alert alert-danger" role="alert">
                                {{ $exception->getMessage() }}
                                <p>For more flights please <a href="/flight-tickets/list">click here</a></p>
                              </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
<section>
@stop
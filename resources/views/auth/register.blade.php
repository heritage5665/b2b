@extends('inner')
@section('main')
<!-- breadcrumb start -->
<section class="breadcrumb-section pt-0">
    <img src="/assets/images/flights/flight-breadcrumb2.jpg" class="bg-img img-fluid blur-up lazyload" alt="">
    <div class="breadcrumb-content">
        <div>
            <h2>sign up</h2>
            <nav aria-label="breadcrumb" class="theme-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">sign up</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="title-breadcrumb">Rica</div>
</section>
<!-- breadcrumb end -->

<section class="section-b-space animated-section dark-cls">
    <img src="/assets/images/cab/grey-bg.jpg" alt="" class="img-fluid blur-up lazyload bg-img">
    <div class="animation-section">
        <div class="cross po-1"></div>
        <div class="cross po-2"></div>
        <div class="round po-4"></div>
        <div class="round po-5"></div>
        <div class="round r-y po-8"></div>
        <div class="square po-10"></div>
        <div class="square po-11"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="offset-lg-3 col-lg-6 offset-sm-2 col-sm-8 col-12">
                <div class="account-sign-in">
                    <div class="title">
                        <h3>sign up</h3>
                    </div>
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <div class="form-group">
                            <x-label for="name" :value="__('Name')" />
                            <x-input id="name" class="form-control" type="text" name="name" placeholder="Enter your name" :value="old('name')" required autofocus />
                        </div>
                        <div class="form-group">
                            <x-label for="name" :value="__('Agency Name')" />
                            <x-input id="name" class="form-control" type="text" name="agency_name" placeholder="Enter your agency name" :value="old('agency_name')" required autofocus />
                        </div>
                        <div class="form-group">
                            <x-label for="email" :value="__('Email address')" />
                            <x-input id="email" class="form-control" type="email" name="email" placeholder="Enter email address" :value="old('email')" required />
                        </div>
                        <div class="form-group">
                            <x-label for="phone" :value="__('Mobile')" />
                            <x-input id="phone" class="form-control" type="text" name="phone" placeholder="Enter mobile number" :value="old('phone')" required />
                        </div>
                        <div class="form-group">
                            <x-label for="password" :value="__('Password')" />

                            <x-input id="password" class="form-control"
                                            type="password"
                                            name="password"
                                            placeholder="Enter password"
                                            required autocomplete="new-password" />
                        </div>
                        <div class="form-group">
                            <x-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-input id="password_confirmation" class="form-control"
                                            type="password"
                                            placeholder="Confirm password"
                                            name="password_confirmation" required />
                        </div>
                        <div class="button-bottom">
                            <button type="submit" class="w-100 btn btn-solid">create account</button>
                            <div class="divider">
                                <h6>or</h6>
                            </div>
                            <button type="submit" class="w-100 btn btn-solid btn-outline"
                                onclick="window.location.href = '/';">login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

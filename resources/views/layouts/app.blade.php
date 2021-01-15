<!DOCTYPE html>
@php 
    $agency = request()->agency;
    $user = auth()->user();
    $customer = $user->customer;
@endphp
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{$agency->name}}">
    <meta name="author" content="{{$agency->name}}">
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

    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="/assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/slick-theme.css">

    <!-- Date-time picker css -->
    <link rel="stylesheet" type="text/css" href="/assets/css/datepicker.min.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="/assets/{{$agency->agency_access_code}}/css/color2.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/common.css">
    @stack('styles')
  </head>
  <body>


    <!-- header start -->
    <header class="inner-page">
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
                        <nav></nav>
                        <ul class="header-right">
                            <li class="front-setting text-success">
                                Balance: 80,000/-
                            </li>
                            <li class="front-setting text-danger">
                                Credit: 20,000/-
                            </li>
                            <li class="front-setting text-warning">
                                Next Due Date: 31, Jan 2021
                            </li>
                        </ul>
                        <div class="coming-soon">Coming Soon</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--  header end -->


    <!-- breadcrumb start -->
    <section class="breadcrumb-section pt-0">
        
    </section>
    <!-- breadcrumb end -->


    <!-- section start-->
    <section class="small-section dashboard-section bg-inner" data-sticky_parent>
        <div class="container">
            <div class="row">
                @include('layouts.navigation')
                {{$slot}}
            </div>
        </div>
    </section>
    <!-- section end-->


    <!-- footer start -->
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

    <!-- edit profile modal start -->
    <div class="modal fade edit-profile-modal" id="edit-profile" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first">first name</label>
                                <input type="text" class="form-control" id="first" placeholder="first name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last">last name</label>
                                <input type="text" class="form-control" id="last" placeholder="last name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="gender">gender</label>
                                <select id="gender" class="form-control">
                                    <option selected>Choose...</option>
                                    <option>female</option>
                                    <option>male</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>birthday</label>
                                <input class="form-control" placeholder="18 april" id="datepicker" />
                            </div>
                            <div class="form-group col-12">
                                <label for="inputAddress">Address</label>
                                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="inputCity">City</label>
                                <input type="text" class="form-control" id="inputCity">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">State</label>
                                <select id="inputState" class="form-control">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputZip">Zip</label>
                                <input type="text" class="form-control" id="inputZip">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-solid">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- edit profile modal start -->


    <!-- edit address modal start -->
    <div class="modal fade edit-profile-modal" id="edit-address" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">change email address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="old">old email</label>
                                <input type="email" class="form-control" id="old">
                            </div>
                            <div class="form-group col-12">
                                <label for="new">enter new email</label>
                                <input type="email" class="form-control" id="new">
                            </div>
                            <div class="form-group col-12">
                                <label for="comfirm">confirm your email</label>
                                <input type="email" class="form-control" id="comfirm">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-solid">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- edit address modal start -->


    <!-- edit phone no modal start -->
    <div class="modal fade edit-profile-modal" id="edit-phone" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">change phone no</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="ph-o">old phone no</label>
                                <input type="number" class="form-control" id="ph-o">
                            </div>
                            <div class="form-group col-12">
                                <label for="ph-n">enter new phone no</label>
                                <input type="number" class="form-control" id="ph-n">
                            </div>
                            <div class="form-group col-12">
                                <label for="ph-c">confirm your phone no</label>
                                <input type="number" class="form-control" id="ph-c">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-solid">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- edit phone no modal start -->


    <!-- edit password modal start -->
    <div class="modal fade edit-profile-modal" id="edit-password" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">change email address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="p-o">old password</label>
                                <input type="email" class="form-control" id="p-o">
                            </div>
                            <div class="form-group col-12">
                                <label for="p-n">enter new password</label>
                                <input type="email" class="form-control" id="p-n">
                            </div>
                            <div class="form-group col-12">
                                <label for="p-c">confirm your password</label>
                                <input type="email" class="form-control" id="p-c">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-solid">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- edit password modal start -->


    <!-- edit password modal start -->
    <div class="modal fade edit-profile-modal" id="edit-card" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">edit your card</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="name">name on card</label>
                            <input type="text" class="form-control" id="name" placeholder="Mark jecno">
                        </div>
                        <div class="form-group">
                            <label for="number">card number</label>
                            <input type="text" class="form-control" id="number" placeholder="7451 2154 2115 2510">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="expiry">expiry date</label>
                                <input type="text" class="form-control" id="expiry" placeholder="12/23">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cvv">cvv</label>
                                <input type="password" maxlength="3" class="form-control" id="cvv"
                                    placeholder="&#9679;&#9679;&#9679;">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-solid">update card</button>
                </div>
            </div>
        </div>
    </div>
    <!-- edit password modal start -->


    <!-- add card modal start -->
    <div class="modal fade edit-profile-modal" id="add-card" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">add new card</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="a-month">card type</label>
                            <select id="a-month" class="form-control">
                                <option selected>add new card...</option>
                                <option>credit card</option>
                                <option>debit card</option>
                                <option>debit card with ATM pin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="a-na">name on card</label>
                            <input type="text" class="form-control" id="a-na">
                        </div>
                        <div class="form-group">
                            <label for="a-n">card number</label>
                            <input type="text" class="form-control" id="a-n">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="a-e">expiry date</label>
                                <input type="text" class="form-control" id="a-e">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="a-c">cvv</label>
                                <input type="password" maxlength="3" class="form-control" id="a-c">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-solid">add card</button>
                </div>
            </div>
        </div>
    </div>
    <!-- edit password modal start -->


    <!-- add card modal start -->
    <div class="modal fade edit-profile-modal" id="delete-account" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Account deletion request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-dark">Before you leave, please tell us why you'd like to delete your Rica account.
                        This information will help us improve. (optional)</p>
                    <form>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-solid">delete my account</button>
                </div>
            </div>
        </div>
    </div>
    <!-- edit password modal start -->



    <!-- latest jquery-->
    <script src="/assets/js/jquery-3.5.1.min.js"></script>

    <!-- popper js-->
    <script src="/assets/js/popper.min.js"></script>

    <!-- slick js-->
    <script src="/assets/js/slick.js"></script>

    <!-- date-time picker js -->
    <script src="/assets/js/date-picker.js"></script>

    <!-- stick section js -->
    <script src='/assets/js/sticky-kit.js'></script>

    <!-- stick section js -->
    <script src='/assets/js/apexcharts.js'></script>

    <!-- Bootstrap js-->
    <script src="/assets/js/bootstrap.js"></script>

    <!-- lazyload js-->
    <script src="/assets/js/lazysizes.min.js"></script>

    <!-- Theme js-->
    <script src="/assets/js/script.js"></script>
    @stack('scripts')
    @stack('inline_script')
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd mmmm yy'
        });

        $(document).ready(function () {
            if ($(window).width() > 991) {
                $(".product_img_scroll, .pro_sticky_info").stick_in_parent();
            }
        });
    </script>
</body>
</html>

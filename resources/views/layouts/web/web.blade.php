<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')
    <meta name="keywords" content="" />
    <meta name="description" content="">

    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('web_assets/css/bootstrap.min.css') }}">
    <link href="{{ asset('web_assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('web_assets/css/home_1.css') }}" rel="stylesheet">

    <link href="{{ asset('web_assets/css/custom.css') }}" rel="stylesheet">
    <style>
        <?php

        use App\Models\Category;

        // echo store_data()['header_script']; 
        ?>
    </style>
    <style>
        /* =========================================
   PRINT NOW CTA
========================================= */

        .print-now-menu {
            margin-left: 8px;
        }

        .print-now-btn {
            position: relative;
            display: inline-flex !important;
            align-items: center;
            gap: 7px;

            padding: 9px 17px !important;

            background: #ff7a00 !important;
            color: #fff !important;

            border-radius: 5px;

            font-weight: 700 !important;

            box-shadow:
                0 3px 10px rgba(255, 122, 0, 0.30);

            transition:
                all 0.2s ease;
        }

        .print-now-btn:hover {
            background: #e96800 !important;
            color: #fff !important;

            transform: translateY(-1px);

            box-shadow:
                0 5px 14px rgba(255, 122, 0, 0.40);
        }


        /* Small blinking dot */

        .print-now-dot {
            width: 7px;
            height: 7px;

            background: #fff;

            border-radius: 50%;

            display: inline-block;

            animation: printNowBlink 1.2s infinite;
        }


        @keyframes printNowBlink {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.35;
                transform: scale(0.75);
            }
        }


        /* =========================================
   MOBILE
========================================= */

        @media (max-width: 991px) {

            .print-now-menu {
                margin-left: 0;
                margin-top: 8px;
            }

            .print-now-btn {
                display: inline-flex !important;

                padding: 10px 18px !important;

                width: auto;
            }

            .print-now-menu {
                display: none !important;
            }
        }
    </style>
    @yield('custom_header')
</head>

<body>

    <div id="page">
        <header class="version_1">
            <div class="layer"></div><!-- Mobile menu overlay mask -->
            <div class="main_header Sticky">
                <div class="container">
                    <div class="row small-gutters">
                        <div class="col-xl-2 col-lg-2 d-lg-flex align-items-center">
                            <div id="logo">
                                <a href="{{ route('home') }}"><img src="{{ asset('uploads/logo') . '/' . store_data()['logo'] }}" alt="" width="100" height="35"></a>
                            </div>
                        </div>
                        <nav class="col-xl-8 col-lg-8">
                            <a class="open_close" href="javascript:void(0);">
                                <div class="hamburger hamburger--spin">
                                    <div class="hamburger-box">
                                        <div class="hamburger-inner"></div>
                                    </div>
                                </div>
                            </a>


                            <div class="main-menu">

                                <div id="header_menu">

                                    <a href="{{ route('home') }}">
                                        <img
                                            src="{{ asset('uploads/logo') . '/' . store_data()['logo'] }}"
                                            alt=""
                                            width="100"
                                            height="35">
                                    </a>

                                    <a
                                        href="#"
                                        class="open_close"
                                        id="close_in">
                                        <i class="ti-close"></i>
                                    </a>

                                </div>


                                <ul>

                                    <li>
                                        <a href="{{ route('home') }}">
                                            Home
                                        </a>
                                    </li>


                                    <li>
                                        <a href="{{ route('calculator') }}">
                                            Pricing Calculator
                                        </a>
                                    </li>


                                    <li>
                                        <a href="{{ route('upload') }}">
                                            Print Now
                                        </a>
                                    </li>


                                    <li>
                                        <a href="<?php echo route('page', ['about_us']); ?>">
                                            About Us
                                        </a>
                                    </li>


                                    <li>
                                        <a href="<?php echo route('page', ['contact_us']); ?>">
                                            Contact Us
                                        </a>
                                    </li>


                                    {{-- LOGOUT --}}

                                    @if(request()->cookie('loggedin_number'))

                                    <li>
                                        <a
                                            href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="ti-power-off"></i>
                                            Logout
                                        </a>
                                    </li>

                                    @endif

                                </ul>

                            </div>

                        </nav>
                        <div class="col-xl-2 col-lg-2 d-lg-flex align-items-center">

                            <span class="print-now-menu">
                                <a href="{{ route('upload') }}" class="print-now-btn">
                                    <span class="print-now-dot"></span>
                                    Print Now
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>


        {{-- LOGOUT FORM --}}

        @if(request()->cookie('loggedin_number'))

        <form
            id="logout-form"
            action="{{ route('logout') }}"
            method="POST"
            style="display:none;">
            @csrf
        </form>

        @endif


        {{-- CLEAR LOCAL DATA AFTER LOGOUT --}}

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const logoutForm =
                    document.getElementById('logout-form');

                if (!logoutForm) {
                    return;
                }


                logoutForm.addEventListener('submit', function() {

                    try {

                        localStorage.clear();

                    } catch (e) {}


                    try {

                        sessionStorage.clear();

                    } catch (e) {}

                });

            });
        </script>
        <div class="top_panel">
            <div class="container header_panel">
                <a href="#0" class="btn_close_top_panel"><i class="ti-close"></i></a>
                <small>What are you looking for?</small>
            </div>

            <div class="container">
                <div class="search-input">
                    <input type="text" placeholder="Search products...">
                    <button type="submit"><i class="ti-search"></i></button>
                </div>
            </div>
        </div>
        <!-- /search_panel -->
        @yield('content')

        <footer class="">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <h3 data-bs-target="#collapse_1">Quick Links</h3>
                        <div class="collapse dont-collapse-sm links" id="collapse_1">
                            <ul>
                                <li><a href="<?php echo route('page', ['about_us']); ?>">About us</a></li>
                                <li><a href="<?php echo route('page', ['contact_us']); ?>">Contact Us</a></li>
                                <li><a href="<?php echo route('page', ['privacy_policy']); ?>">Privacy Policy</a></li>
                                <li><a href="<?php echo route('page', ['terms']); ?>">Terms</a></li>
                                <li><a href="<?php echo route('page', ['disclaimers']); ?>">Disclaimers</a></li>
                            </ul>
                        </div>
                    </div>
                    <?php
                    $category_data = Category::where('parent_category_id', null)->get();
                    ?>
                    <div class="col-lg-3 col-md-6">
                        <h3 data-bs-target="#collapse_2">Categories</h3>
                        <div class="collapse dont-collapse-sm links" id="collapse_2">
                            <ul>
                                <?php foreach ($category_data as $_id => $cat_item) { ?>
                                    <li><a href="{{ route('category', ['slug' => $cat_item['slug']]) }}"><?php echo $cat_item['name']; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3 data-bs-target="#collapse_3">Contacts</h3>
                        <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                            <ul>
                                <!-- <li><i class="ti-home"></i>97845 Baker st. 567<br>Los Angeles - US</li> -->
                                <li><i class="ti-headphone-alt"></i>+1-202-753-8003</li>
                                <li><i class="ti-email"></i><a href="#0">info@offerlity.shop</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3 data-bs-target="#collapse_4">Keep in touch</h3>
                        <div class="collapse dont-collapse-sm" id="collapse_4">
                            <div id="newsletter">
                                <div class="form-group">
                                    <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
                                    <button type="submit" id="submit-newsletter"><i class="ti-angle-double-right"></i></button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /row-->
                <!-- <hr> -->
            </div>
        </footer>
        <!--/footer-->
    </div>
    <!-- page -->

    <div id="toTop"></div><!-- Back to top button -->

    <script src="{{ asset('web_assets/js/common_scripts.min.js') }}"></script>
    <script src="{{ asset('web_assets/js/main.js') }}"></script>
    <script src="{{ asset('web_assets/js/carousel-home.min.js') }}"></script>


    @yield('custom_footer')
    <script>
        <?php
        // echo store_data()['footer_script']; 
        ?>
    </script>
    <!-- <br /> -->
</body>


</html>
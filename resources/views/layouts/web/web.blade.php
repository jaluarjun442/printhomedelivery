<?php

use App\Models\Store;

$store_data = Store::where('id', 1)->first();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')


    <link rel="shortcut icon" href="img/favicon.png" type="image/png">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/favicon.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/favicon.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/favicon.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/favicon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('web_assets/css/bootstrap.min.css') }}">
    <link href="{{ asset('web_assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('web_assets/css/home_1.css') }}" rel="stylesheet">

    <link href="{{ asset('web_assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('web_assets/css/common-pages.css') }}" rel="stylesheet">

    <link href="{{ asset('web_assets/css/listing.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "name": "Print Ki Dukan",
            "alternateName": "PrintKiDukan",
            "url": "https://printkidukan.com/"
        }
    </script>
    <?php echo $store_data['header_script']; ?>
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
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('uploads/logo') . '/' . $store_data['logo'] }}"
                                        alt="Home"
                                        class="desktop_logo">
                                </a>
                            </div>
                        </div>
                        <nav class="col-xl-8 col-lg-8">
                            <a class="open_close" href="javascript:void(0);" aria-label="Open menu">
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
                                            src="{{ asset('uploads/logo') . '/' . $store_data['logo'] }}"
                                            alt="Home"
                                            width="100"
                                            height="35">
                                    </a>

                                    <a
                                        href="#"
                                        class="open_close"
                                        id="close_in"
                                        aria-label="Close menu">
                                        <i class="ti-close" aria-hidden="true"></i>
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
                                        <a href="<?php echo route('page', ['contact_us']); ?>">
                                            Contact Us
                                        </a>
                                    </li>
                                    <li class="more-menu">

                                        <a href="javascript:void(0);" class="more-toggle">
                                            Pages <i class="fa fa-angle-down"></i>
                                        </a>

                                        <ul class="more-dropdown">

                                            <li>
                                                <a href="<?php echo route('page', ['about_us']); ?>">
                                                    About Us
                                                </a>
                                            </li>

                                            <li>
                                                <a href="<?php echo route('page', ['privacy_policy']); ?>">
                                                    Privacy Policy
                                                </a>
                                            </li>

                                            <li>
                                                <a href="<?php echo route('page', ['terms']); ?>">
                                                    Terms & Conditions
                                                </a>
                                            </li>

                                            <li>
                                                <a href="<?php echo route('page', ['disclaimers']); ?>">
                                                    Disclaimer
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('blogs') }}">
                                                    Blog
                                                </a>
                                            </li>

                                        </ul>

                                    </li>
                                    <li>
                                        <a href="{{ route('my-orders') }}">
                                            <i class="ti-package"></i>
                                            Track Order
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
                <a href="#0" class="btn_close_top_panel" aria-label="Close panel">
                    <i class="ti-close" aria-hidden="true"></i>
                </a>
                <small>What are you looking for?</small>
            </div>

            <div class="container">
                <div class="search-input">
                    <input type="text" placeholder="Search products...">
                    <button type="submit" aria-label="Search">
                        <i class="ti-search" aria-hidden="true"></i>
                    </button>
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

                    <div class="col-lg-3 col-md-6">
                        <h3 data-bs-target="#collapse_2">Tools</h3>
                        <div class="collapse dont-collapse-sm links" id="collapse_2">
                            <ul>
                                <li>
                                    <a href="{{ route('calculator') }}">
                                        Pricing Calculator
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('blogs') }}">
                                        Print Guide
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3 data-bs-target="#collapse_3">Contacts</h3>
                        <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                            <ul>
                                <!-- <li><i class="ti-home"></i>97845 Baker st. 567<br>Los Angeles - US</li> -->
                                <li><i class="ti-headphone-alt"></i>{{ $store_data['phone'] }}</li>
                                <li><i class="ti-email"></i><a href="#0">{{ $store_data['email'] }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3 data-bs-target="#collapse_4">Keep in touch</h3>
                        <div class="collapse dont-collapse-sm" id="collapse_4">
                            <div id="newsletter">
                                <div class="form-group">
                                    <input type="email"
                                        name="email_newsletter"
                                        id="email_newsletter"
                                        class="form-control"
                                        placeholder="Your email">

                                    <button type="submit"
                                        id="submit-newsletter"
                                        aria-label="Subscribe to newsletter">
                                        <i class="ti-angle-double-right" aria-hidden="true"></i>
                                    </button>
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

    <?php echo $store_data['footer_script']; ?>

    @yield('custom_footer')
    <script>
        $(document).on('click', '.more-toggle', function(e) {

            e.preventDefault();
            e.stopPropagation();

            var menu = $(this).closest('.more-menu');

            menu.toggleClass('open');

        });


        $(document).on('click', '.more-dropdown', function(e) {

            e.stopPropagation();

        });
    </script>
</body>


</html>
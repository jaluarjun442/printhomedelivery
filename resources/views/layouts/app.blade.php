<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Home') }}</title>

    <!-- Scripts -->
    <script src='{{ asset("admin_asset/jquery.min.js") }}'></script>
    <script src='{{ asset("admin_asset/jquery.dataTables.min.js") }}'></script>
    <script src='{{ asset("admin_asset/jquery.validate.min.js") }}'></script>
    <script src='{{ asset("admin_asset/bootstrap.min.js") }}'></script>
    <script src='{{ asset("admin_asset/dataTables.bootstrap4.min.js") }}'></script>
    <script src='{{ asset("admin_asset/ckeditor/ckeditor.js") }}'></script>
    <script src='{{ asset("admin_asset/ckfinder/ckfinder.js") }}'></script>
    <script src='{{ asset("admin_asset/select2.min.js") }}'></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href='{{ asset("admin_asset/bootstrap.min.css") }}' rel="stylesheet" />
    <link href='{{ asset("admin_asset/jquery.dataTables.min.css") }}' rel="stylesheet" />
    <link href='{{ asset("admin_asset/dataTables.bootstrap4.min.css") }}' rel="stylesheet" />
    <link href='{{ asset("admin_asset/select2.min.css") }}' rel="stylesheet" />
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <?php
  
    ?>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- <a class="navbar-brand" href="{{ route('admin_home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @guest
                    @else
                    <ul class="navbar-nav mr-auto">
                        <a class="nav-link" href="{{ route('admin_home') }}">Home</a>
                        <a class="nav-link" href="{{ route('admin.store') }}">Store</a>
                        <a class="nav-link" href="{{ route('admin.price') }}">Price</a>
                        <a class="nav-link" href="{{ route('admin.category') }}">Category</a>
                        <a class="nav-link" href="{{ route('admin.product') }}">Product</a>
                        <a class="nav-link" href="{{ route('admin_setting') }}">Settigns</a>
                         </ul>
                    @endguest

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item">

                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                ( {{ Auth::user()->name }} ){{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>


</html>
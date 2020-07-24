<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('theme/assets/css/page.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/assets/css/style.css') }}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('theme/assets/img/apple-touch-icon.png' )}}">
    <link rel="icon" href="{{ asset('theme/assets/img/favicon.png' )}}">

    @stack('custom-style')
</head>

<body>


    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-stick-dark" data-navbar="sticky">
        <div class="container">

            <div class="navbar-left">
                <button class="navbar-toggler" type="button">&#9776;</button>
                <a class="navbar-brand" href="/">
                    <img class="logo-dark" src="{{ asset('theme/assets/img/logo-dark.png') }}" alt="logo">
                    <img class="logo-light" src="{{ asset('theme/assets/img/logo-light.png') }}" alt="logo">
                </a>
            </div>


            <a class="btn btn-xs btn-round btn-success"
                href="{{ route('login') }}">Login</a>

        </div>
    </nav><!-- /.navbar -->


@yield('header')

@yield('content')

@include('includes.footer')


    <!-- Scripts -->
    <script src="{{ asset('theme/assets/js/page.min.js' )}}"></script>
    <script src="{{ asset('theme/assets/js/script.js' )}}"></script>
    @stack('custom-script')
</body>

</html>

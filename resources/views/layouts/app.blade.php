<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title', config('app.name'))</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/img/Favi/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/Favi/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/Favi/favicon-16x16.png">
    <link rel="manifest" href="/img/Favi/site.webmanifest">
    <link rel="mask-icon" href="/img/Favi/safari-pinned-tab.svg" color="#101430">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="theme-color" content="#101430">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="{{ mix('/css/app.css'), true }}" rel="stylesheet"> 
    {{-- <link href="{{ asset(mix('/css/app.css')), true }}" rel="stylesheet">  --}} {{-- Server Version --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/loading-bar.css') }}" />

    <!--Icons-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

    <!-- Animate -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @toastr_css

    @stack('styles')

</head>

<body data-aos="fade-up">

    <div class="container-fluid nav-container">
        <div class="overlay"></div>
        @include('partials.nav')
    </div>

    <div id="app">
        @yield('content')
    </div>

    @include('partials.footer')

    <!-- Scripts -->
    {{-- <script src="{{asset(mix('js/app.js'), true)}}"></script> --}} <!--Server Version -->
    <script src="{{ asset('js/app.js'), true }}"></script> 
    <script type="text/javascript" src="{{ asset('js/loading-bar.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    @stack('scripts')
    <script>
        AOS.init();

        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

@toastr_js
@toastr_render
</body>

</html>

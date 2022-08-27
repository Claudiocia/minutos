<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Canal Minutos - Newsletter</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('site/img/favicon.ico')}}" rel="icon">
    <link href="{{asset('site/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Serif:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.2/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Vendor CSS Files -->
    <link href="{{asset('site/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('site/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('site/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('site/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('site/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css') }}">
    @livewireStyles
    <!-- Template Main CSS File -->
    <link href="{{asset('site/css/style.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="javascript">
        $(function() {
            AOS.init();
        });

        $(window).on('load', function() {
            AOS.refresh();
        });
    </script>
</head>
<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between align-items-center">

        <div class="logo">
            <a href="{{route('/')}}">
                <x-marca-minutos height="30"/>
            </a>
        </div>

    </div>
</header><!-- End Header -->
<div class="col-4" style="margin-top: 80px;">
    @if (Session::has('msg'))
        <div class="my-alert">
            {!! Alert::success(Session::get('msg')) !!}
        </div>
    @endif
</div>
    @include('sections.section-hero')
<main id="main">
    @include('sections.section-step')

    @include('sections.section-causa')

    @include('sections.section-cta')

    @if($rates != null)
        @include('sections.section-testemonial')
    @endif


</main><!-- End #main -->
@include('layouts.includes.footer')

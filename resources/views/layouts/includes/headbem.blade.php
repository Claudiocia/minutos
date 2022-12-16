<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VQ8LQZ1ZY6"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-VQ8LQZ1ZY6');
    </script>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.includes.meta-tag')

    <!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '524891909661707');
        fbq('track', 'PageView');
        fbq('track', 'TYPcaptura');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=524891909661707&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Meta Pixel Code -->


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
    <link href="{{asset('site/vendor/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('site/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css') }}">
    @livewireStyles
    <!-- Template Main CSS File -->
    <link href="{{asset('site/css/style.css')}}" rel="stylesheet">

    @stack('styles')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

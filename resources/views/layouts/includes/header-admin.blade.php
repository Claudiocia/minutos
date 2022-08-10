<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Canal Minutos - Newsletter</title>

    <!-- Favicons -->
    <link href="{{asset('site/img/favicon.ico')}}" rel="icon">
    <link href="{{asset('site/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Serif:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.2/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Vendor CSS Files -->
    <link href="{{asset('site/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('site/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('site/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('site/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('site/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{mix('css/app.css') }}">
    @livewireStyles
    <!-- Template Main CSS File -->
    <link href="{{asset('site/css/style.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

</head>
<body class="font-sans antialiased bg-light">
<x-jet-banner />
@livewire('navigation-menu')

<!-- Page Heading -->
<header class="d-flex py-3 bg-white shadow-sm border-bottom">
    <div class="container">
        <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
             height="35.000000pt" viewBox="0 0 707.000000 136.000000"
             preserveAspectRatio="xMidYMid meet">
            <g transform="translate(0.000000,136.000000) scale(0.100000,-0.100000)"
               fill="#000000" stroke="none">
                <path d="M2164 1327 c-90 -82 -34 -227 88 -227 47 0 49 -1 43 -22 -13 -43 -47
-88 -102 -137 -49 -44 -54 -51 -44 -70 7 -12 15 -21 19 -21 18 0 129 99 164
145 68 91 88 206 49 292 -24 51 -63 73 -131 73 -43 0 -55 -5 -86 -33z"/>
            </g>
            <g transform="translate(0.000000,136.000000) scale(0.100000,-0.100000)"
               fill="#3fa7d8" stroke="none">
                <path d="M4803 1201 l-93 -24 0 -124 0 -123 -70 0 -70 0 0 -30 0 -30 70 0 70
0 0 -346 c0 -378 3 -405 55 -459 76 -81 283 -86 375 -8 38 32 74 101 89 171
15 72 15 72 -18 72 -26 0 -29 -4 -35 -42 -16 -103 -81 -163 -169 -155 -56 5
-83 26 -97 76 -6 21 -10 176 -10 364 l0 327 135 0 135 0 0 30 0 30 -135 0
-134 0 -3 148 -3 148 -92 -25z"/>
                <path d="M518 936 c-60 -16 -120 -58 -158 -110 l-30 -40 0 72 0 72 -165 0
-165 0 0 -30 0 -30 70 0 70 0 0 -395 0 -395 -70 0 -70 0 0 -30 0 -30 235 0
235 0 0 30 0 30 -70 0 -70 0 0 273 c0 305 6 343 63 419 61 82 184 121 258 82
60 -30 63 -53 67 -431 l4 -343 -76 0 -76 0 0 -30 0 -30 240 0 240 0 0 30 0 30
-71 0 -70 0 3 293 3 292 28 57 c59 120 193 182 288 132 60 -30 63 -53 67 -431
l4 -343 -76 0 -76 0 0 -30 0 -30 240 0 240 0 0 30 0 30 -69 0 -69 0 -4 333 -3
332 -32 66 c-52 105 -134 147 -271 137 -113 -8 -207 -64 -265 -157 l-21 -35
-14 43 c-20 61 -79 116 -143 135 -62 19 -156 20 -221 2z"/>
                <path d="M2879 936 c-64 -17 -131 -59 -173 -108 l-36 -42 0 72 0 72 -170 0
-170 0 0 -30 0 -30 75 0 75 0 0 -395 0 -395 -75 0 -75 0 0 -30 0 -30 240 0
240 0 0 30 0 30 -71 0 -70 0 3 293 3 292 27 51 c28 53 77 102 131 131 48 26
167 25 197 -2 54 -49 55 -54 58 -422 l3 -343 -70 0 -71 0 0 -30 0 -30 240 0
240 0 0 30 0 30 -74 0 -75 0 -3 338 c-3 330 -3 338 -27 390 -30 66 -76 107
-143 127 -61 18 -165 19 -229 1z"/>
                <path d="M5665 936 c-121 -30 -213 -106 -265 -219 -86 -184 -56 -456 64 -594
78 -90 241 -138 392 -116 182 26 301 137 344 322 28 120 9 334 -37 426 -46 91
-142 161 -251 184 -68 14 -183 13 -247 -3z m198 -57 c44 -23 88 -74 107 -127
45 -120 48 -398 5 -540 -19 -64 -73 -126 -122 -143 -49 -16 -138 -7 -171 18
-43 32 -80 93 -99 163 -26 94 -25 380 0 465 38 124 95 174 200 175 32 0 68 -5
80 -11z"/>
                <path d="M6592 931 c-113 -39 -181 -126 -190 -240 -6 -95 3 -136 44 -181 48
-53 102 -76 251 -105 153 -31 225 -61 247 -104 38 -72 6 -165 -69 -201 -61
-30 -177 -32 -255 -6 -93 32 -180 138 -180 220 0 11 -9 16 -30 16 l-30 0 0
-165 0 -165 25 0 c20 0 26 7 35 39 l10 40 64 -29 c165 -75 360 -61 473 34 17
14 43 50 57 78 22 44 26 65 26 137 0 187 -70 249 -339 300 -156 30 -213 69
-213 143 0 89 75 143 197 142 52 0 81 -6 111 -22 55 -28 109 -93 129 -153 15
-44 20 -49 46 -49 l29 0 0 145 0 145 -30 0 c-23 0 -30 -4 -30 -20 0 -33 -25
-34 -110 -6 -96 31 -190 34 -268 7z"/>
                <path d="M1740 900 l0 -30 75 0 75 0 0 -395 0 -395 -75 0 -75 0 0 -30 0 -30
240 0 240 0 0 30 0 30 -70 0 -70 0 0 425 0 425 -170 0 -170 0 0 -30z"/>
                <path d="M3430 900 l0 -30 75 0 75 0 0 -318 c0 -349 4 -384 59 -459 75 -104
283 -124 422 -40 29 18 67 51 85 74 l32 42 6 -31 c3 -17 6 -50 6 -74 l0 -44
160 0 160 0 0 30 0 30 -70 0 -70 0 0 425 0 425 -170 0 -170 0 0 -30 0 -30 76
0 76 0 -4 -277 c-5 -315 -9 -337 -81 -419 -76 -87 -189 -118 -258 -71 -64 43
-64 43 -67 455 l-3 372 -169 0 -170 0 0 -30z"/>
            </g>
        </svg>
    </div>
</header>
<div class="col-4">
    @if (Session::has('msg'))
        <div class="my-alert">
            {!! Alert::success(Session::get('msg')) !!}
        </div>
    @endif
</div>

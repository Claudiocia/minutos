@include('layouts.includes.head')
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

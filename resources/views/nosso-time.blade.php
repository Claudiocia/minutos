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
<main id="main">
    <!-- ======= Nosso TIME ======= -->
    <section id="nossotime" class="section border-top border-bottom">
        <div class="container">
            <div class="row justify-content-center text-center testemunho">
                <div class="section-title">
                    <span>NOSSO TIME</span>
                    <h2>Nosso Time</h2>
                    <p>Apresentamos todos que trabalham para que a informação chegue correta até você</p>
                </div>
            </div>
            @if($nossotimes != null)
                @foreach($nossotimes as $nossotime)
            <div class="row justify-content-center text-center">
                <div class="col-3 card card-my">
                    <div class="card-header">
                        <div class="card-topo">
                            <div class="title-card">
                                {{$nossotime->nome}}
                                <h6>{{$nossotime->funcao}}</h6>
                            </div>
                            <div class="circle-card">
                                <img class="img-fluid mb-3" src="{{asset($nossotime->foto->foto_path)}}" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! $nossotime->texto !!}
                    </div>
                    <div class="card-footer my-card-footer">
                        <p class="social-card">
                            <a href="{{$nossotime->twitter}}" target="_blank"><span class="fa-brands fa-twitter"></span></a>
                            <a href="{{$nossotime->face}}" target="_blank"><span class="fa-brands fa-facebook"></span></a>
                            <a href="{{$nossotime->insta}}" target="_blank"><span class="fa-brands fa-instagram"></span></a>
                            <a href="{{$nossotime->linked}}" target="_blank"><span class="fa-brands fa-linkedin"></span></a>
                        </p>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </section><!-- End Nosso TIME -->
</main><!-- End #main -->
@include('layouts.includes.footer')

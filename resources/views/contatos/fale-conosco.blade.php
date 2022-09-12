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
    @elseif(Session::has('err'))
        <div class="my-alert">
            {!! Alert::danger(Session::get('err')) !!}
        </div>
    @endif
</div>
<main id="main">
    <!-- ======= Nosso TIME ======= -->
    <section id="contact" class="section border-top border-bottom">
        <div class="container">
            <div class="row justify-content-center text-center testemunho">
                <div class="section-title">
                    <span>Fale com a gente</span>
                    <h2>Fale com a gente</h2>
                    <p>Ótimo que você quer falar com a gente.</p>
                    <p> Informe seu email, mande sua mensagem que a gente tá pronto para lhe responder!</p>
                </div>
            </div>

            <div class="row justify-content-center text-center">
                <div class="col-lg-4">
                    <div class="map mb-4 mb-lg-0">
                        <img src="{{asset('site/img/apost.png')}}" height="300px" class="img-fluid" />
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="contact-form">
                            <x-jet-validation-errors class="mb-4" />
                                <form method="POST" action="{{route('envia-mensagem')}}">
                                    @csrf

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Seu Nome" value="{{old('nome')}}" required="required" />
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-4">
                                            <input type="text" name="tele" class="form-control" id="tele" placeholder="Seu Telefone" value="{{old('tele')}}" required="required"/>
                                        </div>
                                        <div class="form-group col-lg-8" style="padding-left: 20px;">
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Seu Email" value="{{old('email')}}" required="required"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Assunto" value="{{old('subject')}}" required="required"/>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="mensagem" rows="5" placeholder="Mensagem" required="required">{{old('mensagem')}}</textarea>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <x-jet-button>
                                            {{ __('Enviar Mensagem') }}
                                        </x-jet-button>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Nosso TIME -->
</main><!-- End #main -->
@include('layouts.includes.footer')

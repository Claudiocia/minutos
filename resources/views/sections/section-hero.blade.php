<section class="hero-section" id="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 hero-text-image">
                <div class="row">
                    <div class="col-lg-6 text-center text-lg-start">
                        <h1>{{$site->title_site}}</h1>
                        {!! $site->text_abert !!}
                        @if($site->cancel_one != null)
                        <p>{{$site->cancel_one}}</p>
                        @endif
                        <div class="btn-hero">
                            <p><a href="{{route('clientes.index')}}" class="btn btn-assinar">{{$site->text_botton_site}}</a></p>
                        </div>
                        <p class="font-texto-cancel">{{$site->cancel_two}}</p>
                    </div>
                    <div class="col-6 d-flex justify-content-center">
                        <div class="col-lg-7 iphone-wrap">
                            <img src="{{asset('site/img/hero5.png')}}" alt="Image" class="phone-1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-cookie-consent-banner />
</section>

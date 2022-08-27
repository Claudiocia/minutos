<!-- /resources/views/components/cookie-consent-banner.blade.php -->

@if(!Cookie::get('cookie-consent'))

    <div id="my-cookie" class="fixed-bottom d-flex justify-content-center align-items-center">
        <div class="col-12 cookie-consent">
            <div class="col-8 d-flex align-items-center justify-content-center">
                <p class="texto-consent">Utilizamos cookies neste site para lhe proporcionar uma experiência personalizada.
                    Leia nossa <a href="#">Política de Privacidade</a> para mais informações.</p>
            </div>
            <div class="col-4">
                <div class="btn btn-cookie"><a href="{{ route('cookieConsent', ['kook' => 1]) }}">Aceito</a></div>
                <div class="btn btn-cookie"><a href="{{ route('cookieConsent', ['kook' => 0]) }}">Fechar</a></div>
            </div>
        </div>
    </div>

@endif

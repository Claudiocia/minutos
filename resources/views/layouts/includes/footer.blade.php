<?php
 $site = \App\Models\Site::first();
?>
<!-- ======= Footer ======= -->
<footer class="footer" role="contentinfo">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-5 mb-md-0">
                @if($site)
                <h3>{{$site->title_footer}}</h3>
                {!! $site->text_footer !!}
                @endif
                <p class="social">
                    <a href="https://twitter.com/canalminutos_" target="_blank"><span class="fa-brands fa-twitter"></span></a>
                    <a href="https://www.facebook.com/profile.php?id=100086184559229" target="_blank"><span class="fa-brands fa-facebook"></span></a>
                    <a href="https://instagram.com/canalminutos_?igshid=YmMyMTA2M2Y=" target="_blank"><span class="fa-brands fa-instagram"></span></a>
                    <a href="https://www.linkedin.com/company/canal-minutos/" target="_blank"><span class="fa-brands fa-linkedin"></span></a>
                </p>
            </div>
            <div class="col-md-7 ms-auto">
                <div class="row site-section pt-0">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h3>Menu</h3>
                        <ul class="list-unstyled">
                            <li><a href="{{route('clientes.create')}}">Reenviar E-mail</a></li>
                            <li><a href="{{route('oldnews')}}">Edições Anteriores</a></li>
                            <li><a href="{{route('rates.index')}}">Avaliar o serviço</a></li>
                            <!-- <li><a href="{{route('indicators.index')}}">Club Minuteria</a></li> -->
                            <li><a href="{{route('clientes.cancelar')}}">Cancelar Assinatura</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h3>Outros Links</h3>
                        <ul class="list-unstyled">
                            <li><a href="{{route('terms.show')}}">Nossos Termos</a></li>
                            <li><a href="{{route('policy.show')}}">Política de Privacidade</a></li>
                            <li><a href="{{route('faleconosco')}}">Fale com a gente</a></li>
                            <li><a href="{{route('nossotime')}}">Nosso time</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 mb-4 mb-md-0">
                        <img src="{{asset('site/img/apost.png')}}" alt="Image" class="img-fluid" height="120px;">
                        <!--
                        <h3>Baixe nosso APP</h3>
                        <div>
                            <ul class="list-unstyled">
                                <li><a href="#" class="btn btn-primary align-items-center"><i class="bx bxl-apple"></i><span> Apple Store</span></a></li>
                                <li><a href="#" class="btn btn-primary align-items-center"><i class="bx bxl-play-store"></i><span> Google Play</span></a></li>
                            </ul>
                        </div>
                        -->
                    </div>

                </div>
            </div>
        </div>

        <div class="row justify-content-center text-center">
            <div class="col-md-7">
                <p class="copyright">&copy; Copyright Canal Minutos. Todos os direitos reservados</p>
                <div class="credits">
                    Desenvolvido por Marketmix
                </div>
            </div>
        </div>

    </div>
</footer>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fa-solid fa-arrow-up"></i></a>

<!-- Vendor JS Files -->
<script src="{{asset('site/vendor/aos/aos.js')}}"></script>
<script src="{{asset('site/vendor/bootstrap/js/bootstrap.js')}}"></script>
<script src="{{asset('site/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('site/vendor/bootstrap/js/bootstrap.esm.js')}}"></script>
<script src="{{asset('site/vendor/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{asset('site/vendor/php-email-form/validate.js')}}"></script>

<!-- Template Main JS File -->
<script src="{{asset('site/js/main.js')}}"></script>

<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor',{
            plugins:[FontFace],
            toolbar:['Roboto Serif']
        }).ckeditor();
    });
</script>

</body>
</html>

<!-- ======= Testimonials Section ======= -->
<section class="section border-top border-bottom">
    <div class="container">
        <div class="row justify-content-center text-center testemunho">
            <div class="col-md-9">
                <h2 class="section-heading">Opinião dos assinantes</h2>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-md-7">
                <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        @foreach($rates as $rate)
                        <div class="swiper-slide">
                            <div class="review text-center">
                                <p class="stars">
                                    @if($rate->nota == 1)
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill muted"></span>
                                        <span class="bi bi-star-fill muted"></span>
                                        <span class="bi bi-star-fill muted"></span>
                                        <span class="bi bi-star-fill muted"></span>
                                    @elseif($rate->nota == 2)
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill muted"></span>
                                        <span class="bi bi-star-fill muted"></span>
                                        <span class="bi bi-star-fill muted"></span>
                                    @elseif($rate->nota == 3)
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill muted"></span>
                                        <span class="bi bi-star-fill muted"></span>
                                    @elseif($rate->nota == 4)
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill muted"></span>
                                    @else
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill"></span>
                                        <span class="bi bi-star-fill"></span>
                                    @endif
                                </p>
                                <h3>{{$rate->title}}</h3>
                                <blockquote>
                                    <p>{!! $rate->texto !!}</p>
                                </blockquote>

                                <p class="review-user">
                                    <span class="d-block"> <span class="text-black">{{$rate->cliente->nome}}</span>, &mdash; Assinante</span>
                                </p>
                            </div>
                        </div><!-- End testimonial item 1-->
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div><a href="#" class="link-primary">VEJA MAIS AVALIAÇÕES</a></div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Testimonials Section -->

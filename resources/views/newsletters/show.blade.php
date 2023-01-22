@extends('layouts.assina')

@section('conteudo')
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div id="admin-content">
            <div class="container-admin">
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-auto p-3">
                            <div class="panel-body-news">
                                <div class="row">
                                    <div id="news-show">
                                        <!-- Cabeçalho -->
                                        <div class="row desk">
                                            @if(setlocale(LC_TIME, 'pt_Br'))
                                                <?php $data = \Carbon\Carbon::parse($newsletter->data_edicao)->format('d-m-Y'); ?>
                                                <h6>{{strftime("%A, %e de %B de %Y", strtotime($data))}}</h6>
                                            @endif
                                        </div>
                                        <div class="row desk">
                                            <x-marca-minutos />
                                        </div>

                                        @if(count($newsletter->fotos) > 0)
                                            <div class="row desk">
                                                <div>
                                                    <div class="d-flex justify-content-center mt-5">
                                                        <p class="mb-0" style="color: black;">Em parceria com:</p>
                                                    </div>
                                                    @foreach($newsletter->fotos as $foto)
                                                        <div class="d-flex justify-content-center">
                                                            <img src="{{$foto->foto_path}}" height="45px"/>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        <!-- Abertura -->
                                        <div class="d-flex justify-content-center">
                                            <hr class="linha-news"/>
                                        </div>
                                        <div class="edit">
                                            <div class="row"><h4>Bom dia,</h4></div>
                                            <div class="edit-abert">
                                                <div>{!! $newsletter->abertura !!}</div>
                                                <div><x-icon-cafe class="icon-news"/></div>
                                            </div>
                                            <div class="row aviso-news" style="margin-top: 8px;">
                                                <h6>Tem algum feedback? Queremos muito saber. <a href="#">Conte-nos</a></h6>
                                            </div>
                                            <div class="row aviso-news">
                                                <h6>Gostou do conteúdo? <a href="#">Convide um amigo.</a> Isso é muito importante prá gente.</h6>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <hr class="linha-news"/>
                                        </div>
                                        <!-- História do Dia -->
                                        <div class="edit">
                                            @foreach($noti_hists as $noti)
                                                @if(count($noti->fotos) > 0)
                                                    <div class="row img-news img-fluid">
                                                        @foreach($noti->fotos as $foto)
                                                            <img src="{{asset($foto->foto_path)}}" alt="imagem principal" />
                                                            @break
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endforeach
                                            <div class="row">
                                                <div class="retranca">
                                                    <h3>História do dia</h3>
                                                    <x-icon-jornal class="icon-dia"/>
                                                </div>
                                                @foreach($noti_hists as $noti_hist)
                                                    <div class="row tit-princ">
                                                        <h2>{{$noti_hist->title}}</h2>
                                                    </div>
                                                    <div class="texto-news">
                                                        {!! $noti_hist->texto !!}
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="row" style="margin-bottom: -30px">
                                                <p class="social-news">
                                                    @foreach($noti_hists as $noti)
                                                        <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-twitter"></span></a>
                                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-facebook"></span></a>
                                                        <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-solid fa-envelope"></span></a>
                                                        <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-whatsapp"></span></a>
                                                        @break
                                                    @endforeach
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <hr class="linha-news"/>
                                        </div>
                                        <!-- E Ainda... -->
                                        <div class="edit">
                                            @foreach($noti_aindas as $ainda)
                                                @if(count($ainda->fotos) > 0)
                                                    <div class="row img-news img-fluid">
                                                        @foreach($ainda->fotos as $foto)
                                                            <img src="{{asset($foto->foto_path)}}" alt="imagem principal" />
                                                            @break
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endforeach
                                            <div class="row">
                                                <div class="retranca">
                                                    <h3>E ainda...</h3>
                                                    <x-icon-fast class="icon-dia"/>
                                                </div>
                                                @foreach($noti_aindas as $ainda)
                                                    <div class="row tit-princ">
                                                        <h3>{{$ainda->title}}</h3>
                                                    </div>
                                                    <div class="texto-news">
                                                        {!! $ainda->texto !!}
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="row" style="margin-bottom: -30px">
                                                <p class="social-news">
                                                    @foreach($noti_aindas as $noti)
                                                        <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-twitter"></span></a>
                                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-facebook"></span></a>
                                                        <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-solid fa-envelope"></span></a>
                                                        <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-whatsapp"></span></a>
                                                        @break
                                                    @endforeach
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <hr class="linha-news"/>
                                        </div>
                                        @if(count($noti_etcs) != 0)
                                        <!-- Etecetera -->
                                        <div class="edit">
                                            @foreach($noti_etcs as $etc)
                                                @if(count($etc->fotos) > 0)
                                                    <div class="row img-news img-fluid">
                                                        @foreach($etc->fotos as $foto)
                                                            <img src="{{asset($foto->foto_path)}}" alt="imagem principal" />
                                                            @break
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endforeach
                                            <div class="row">
                                                <div class="retranca">
                                                    <h3>Etecetera</h3>
                                                    <x-icon-tempo class="icon-dia"/>
                                                </div>
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        @foreach($noti_etcs as $etc)
                                                            <div class="col-6 nota-news">
                                                                {!! $etc->texto !!}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-bottom: -30px">
                                                <p class="social-news">
                                                    @foreach($noti_etcs as $noti)
                                                        <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-twitter"></span></a>
                                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-facebook"></span></a>
                                                        <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-solid fa-envelope"></span></a>
                                                        <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-whatsapp"></span></a>
                                                        @break
                                                    @endforeach
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <hr class="linha-news"/>
                                        </div>
                                        @endif
                                        <!-- Disse-se -->
                                        @if(count($noti_disses) != 0)
                                        <div class="edit">
                                            <div class="row">
                                                <div class="retranca">
                                                    <h3>Disse-se</h3>
                                                    <x-icon-internet class="icon-dia"/>
                                                </div>
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        @foreach($noti_disses as $disse)
                                                            <div class="disse">
                                                                <div class="row tit-disse">
                                                                    <h3>{{$disse->title}}</h3>
                                                                </div>
                                                                @if(count($disse->fotos) > 0)
                                                                    <div class="row d-flex">
                                                                        <div class="col-8 disse-news">
                                                                            {!! $disse->texto !!}
                                                                        </div>
                                                                        <div class="col-4 circle mt-3">
                                                                            @foreach($disse->fotos as $foto)
                                                                                <img src="{{asset($foto->foto_path)}}" width="120" alt="Image">
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <div class="col-12 disse-news">
                                                                        {!! $disse->texto !!}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-bottom: -30px">
                                                <p class="social-news">
                                                    @foreach($noti_disses as $noti)
                                                        <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-twitter"></span></a>
                                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-facebook"></span></a>
                                                        <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-solid fa-envelope"></span></a>
                                                        <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-whatsapp"></span></a>
                                                        @break
                                                    @endforeach
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <hr class="linha-news"/>
                                        </div>
                                        @endif
                                        <!-- Dinheiro -->
                                        @if(count($noti_dinhes) != 0)
                                        <div class="edit">
                                            @foreach($noti_dinhes as $dinhe)
                                                @if(count($dinhe->fotos) > 0)
                                                    <div class="row img-news img-fluid">
                                                        @foreach($dinhe->fotos as $foto)
                                                            <img src="{{asset($foto->foto_path)}}" alt="imagem principal" />
                                                            @break
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endforeach
                                            <div class="row">
                                                <div class="retranca">
                                                    <h3>Dinheiro</h3>
                                                    <x-icon-bolsa class="icon-dia"/>
                                                </div>
                                                @foreach($noti_dinhes as $dinhe)
                                                    @if($dinhe->title == 'Dolar')
                                                        <div class="col-10">
                                                            <div class="row tit-dolar">
                                                                <div class="retranca">
                                                                    <h3>{{$dinhe->title}}</h3>
                                                                </div>
                                                            </div>
                                                            <div class="cota-news">
                                                                {!! $dinhe->texto !!}
                                                            </div>
                                                            <hr class="cota"/>
                                                        </div>
                                                    @elseif($dinhe->title == 'Bovespa')
                                                        <div class="col-10">
                                                            <div class="row tit-dolar">
                                                                <div class="retranca">
                                                                    <h3>{{$dinhe->title}}</h3>
                                                                </div>
                                                            </div>
                                                            <div class="cota-news">
                                                                {!! $dinhe->texto !!}
                                                            </div>
                                                            <hr class="cota"/>
                                                        </div>
                                                    @else
                                                        <div class="row tit-princ">
                                                            <h3>{{$dinhe->title}}</h3>
                                                        </div>
                                                        <div class="texto-news">
                                                            {!! $dinhe->texto !!}
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="row" style="margin-bottom: -30px">
                                                <p class="social-news">
                                                    @foreach($noti_dinhes as $noti)
                                                        <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-twitter"></span></a>
                                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-facebook"></span></a>
                                                        <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-solid fa-envelope"></span></a>
                                                        <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-whatsapp"></span></a>
                                                        @break
                                                    @endforeach
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <hr class="linha-news"/>
                                        </div>
                                        @endif
                                        <!-- Planeta -->
                                        @if(count($noti_planes) != 0)
                                        <div class="edit">
                                            @foreach($noti_planes as $plane)
                                                @if(count($plane->fotos) > 0)
                                                    <div class="row img-news img-fluid">
                                                        @foreach($plane->fotos as $foto)
                                                            <img src="{{asset($foto->foto_path)}}" alt="imagem principal" />
                                                            @break
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endforeach
                                            <div class="row">
                                                <div class="retranca">
                                                    <h3>Planeta</h3>
                                                    <x-icon-globo class="icon-dia"/>
                                                </div>
                                                @foreach($noti_planes as $plane)
                                                    @if(strpos($plane->resumo, 'recuo'))
                                                        <div class="recuo-news">
                                                            <h6>{{$plane->title}}</h6>
                                                            {!! $plane->texto !!}
                                                        </div>
                                                    @else
                                                        <div class="row tit-princ">
                                                            <h3>{{$plane->title}}</h3>
                                                        </div>
                                                        <div class="texto-news">
                                                            {!! $plane->texto !!}
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="row" style="margin-bottom: -30px">
                                                <p class="social-news">
                                                    @foreach($noti_planes as $noti)
                                                        <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-twitter"></span></a>
                                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-facebook"></span></a>
                                                        <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-solid fa-envelope"></span></a>
                                                        <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-whatsapp"></span></a>
                                                        @break
                                                    @endforeach
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <hr class="linha-news"/>
                                        </div>
                                        @endif
                                        <!-- Cuidar -->
                                        @if(count($noti_cuidas) != 0)
                                        <div class="edit">
                                            @foreach($noti_cuidas as $cuida)
                                                @if(count($cuida->fotos) > 0)
                                                    <div class="row img-news img-fluid">
                                                        @foreach($cuida->fotos as $foto)
                                                            <img src="{{asset($foto->foto_path)}}" alt="imagem principal" />
                                                            @break
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endforeach
                                            <div class="row">
                                                <div class="retranca">
                                                    <h3>Cuidar</h3>
                                                    <x-icon-cuidar class="icon-cuida"/>
                                                </div>
                                                @foreach($noti_cuidas as $cuida)
                                                    @if(strpos($cuida->resumo, 'recuo'))
                                                        <div class="recuo-news">
                                                            <h6>{{$cuida->title}}</h6>
                                                            {!! $cuida->texto !!}
                                                        </div>
                                                    @else
                                                        <div class="row tit-princ">
                                                            <h3>{{$cuida->title}}</h3>
                                                        </div>
                                                        <div class="texto-news">
                                                            {!! $cuida->texto !!}
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="row" style="margin-bottom: -30px">
                                                <p class="social-news">
                                                    @foreach($noti_cuidas as $noti)
                                                        <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-twitter"></span></a>
                                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-facebook"></span></a>
                                                        <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-solid fa-envelope"></span></a>
                                                        <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-whatsapp"></span></a>
                                                        @break
                                                    @endforeach
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <hr class="linha-news"/>
                                        </div>
                                        @endif
                                        <!-- Cult e Tec -->
                                        @if(count($noti_cults) != 0)
                                        <div class="edit cult">
                                            @foreach($noti_cults as $cult)
                                                @if(count($cult->fotos) > 0)
                                                    <div class="row img-news img-fluid">
                                                        @foreach($cult->fotos as $foto)
                                                            <img src="{{asset($foto->foto_path)}}" alt="imagem principal" />
                                                            @break
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endforeach
                                            <div class="row">
                                                <div class="retranca">
                                                    <h3>Cult & Tec</h3>
                                                    <x-icon-culttec class="icon-cuida"/>
                                                </div>
                                                @foreach($noti_cults as $cult)
                                                    @if(strpos($cult->resumo, 'recuo'))
                                                        <div class="recuo-news">
                                                            <h6>{{$cult->title}}</h6>
                                                            {!! $cult->texto !!}
                                                        </div>
                                                    @else
                                                        <div class="row tit-princ">
                                                            <h3>{{$cult->title}}</h3>
                                                        </div>
                                                        <div class="texto-news">
                                                            {!! $cult->texto !!}
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="row" style="margin-bottom: -30px">
                                                <p class="social-news">
                                                    @foreach($noti_cults as $noti)
                                                        <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-twitter"></span></a>
                                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-facebook"></span></a>
                                                        <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-solid fa-envelope"></span></a>
                                                        <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><span class="fa-brands fa-whatsapp"></span></a>
                                                        @break
                                                    @endforeach
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <hr class="linha-news"/>
                                        </div>
                                        @endif
                                        <!-- rodapé -->
                                        <div class="edit rodape-news">
                                            <div class="rodape-tit">
                                                <h3>Obrigado por ler</h3>
                                                <x-icon-jornal class="icon-roda"/>
                                            </div>
                                            <div class="row roda-text">
                                                <p><a href="#">Conte pra gente</a> o que achou da newsletter de hoje.
                                                    Veja outras edições <a href="#">aqui.</a> Se gostou, que tal <a href="#">chamar um amigo</a> para assinar?</p>
                                            </div>
                                            <div class="row">
                                                <p class="fim">Acompanhe nossas redes sociais</p>
                                                <p class="social-news">
                                                    <a href="#"><span class="fa-brands fa-twitter"></span></a>
                                                    <a href="#"><span class="fa-brands fa-facebook"></span></a>
                                                    <a href="#"><span class="fa-brands fa-instagram"></span></a>
                                                    <a href="#"><span class="fa-brands fa-linkedin"></span></a>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- rodapé -->
                                        <div class="edit rodape-news-final">
                                            <div class="rodape-tit2">
                                                <h6 class="final">Você está recebendo esse email porque se inscreveu na newsletter
                                                    do Canal Minutos. Para se descadastrar a qualquer momento, <a href="#">clique aqui.</a></h6>
                                                <x-marca-minutos class="icon-final"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="btn-hero">
                        <p><a href="{{route('oldnews')}}" class="btn btn-assinar btn-voltar">Voltar</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


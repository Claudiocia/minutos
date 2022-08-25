@extends('layouts.guest')

@section('conteudo')
<div id="news-show" class="showPublic">
    <!-- Cabeçalho -->
    <div class="row desk">
        @if(setlocale(LC_TIME, 'pt_Br'))
        <?php $data = \Carbon\Carbon::parse($newsletter->data_edicao)->format('d-m-Y'); ?>
            <h6>{{strftime("%A, %e de %B de %Y", strtotime($data))}}</h6>
        @endif
    </div>
    <div class="row desk">
        <x-marca-minutos height="55"/>
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
    @foreach($noticias as $noti)
        @if($noti->noticia->retranca_id == 9)

    <!-- História do Dia -->
    <div class="edit">
        @foreach($noticias as $noti)
            @if(count($noti->noticia->fotos) > 0)
                <div class="row img-news img-fluid">
                    @foreach($noti->noticia->fotos as $foto)
                        <img src="{{asset($foto->foto_path)}}" alt="imagem principal" />
                        @break
                    @endforeach
                </div>
            @endif
        @endforeach
        <div class="row">
            <div class="retranca">
                <h3>História do dia</h3>
                <x-icon-fast class="icon-dia"/>
            </div>
            @foreach($noticias as $noti_hist)
                <div class="row tit-princ">
                    <h2>{{$noti_hist->noticia->title}}</h2>
                </div>
                <div class="texto-news">
                    {!! $noti_hist->noticia->texto !!}
                </div>
            @endforeach
        </div>
    </div>
        @endif
    @endforeach
    <!-- divisão de editorias -->
    @foreach($noticias as $noti)
        @if($noti->noticia->retranca_id == 10)
            <!-- E Ainda... -->
            <div class="edit">
                @foreach($noticias as $ainda)
                    @if(count($ainda->noticia->fotos) > 0)
                        <div class="row img-news img-fluid">
                            @foreach($ainda->noticia->fotos as $foto)
                                <img src="{{asset($foto->foto_path)}}" alt="imagem principal" />
                                @break
                            @endforeach
                        </div>
                    @endif
                @endforeach
                <div class="row">
                    <div class="retranca">
                        <h3>E ainda...</h3>
                        <x-icon-jornal class="icon-dia"/>
                    </div>
                    @foreach($noticias as $ainda)
                        <div class="row tit-princ">
                            <h3>{{$ainda->noticia->title}}</h3>
                        </div>
                        <div class="texto-news">
                            {!! $ainda->noticia->texto !!}
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @break
    @endforeach
    <!-- divisão de editorias -->
    @foreach($noticias as $noti)
        @if($noti->noticia->retranca_id == 11)
            <!-- Etecetera -->
            <div class="edit">
                @foreach($noticias as $etc)
                    @if(count($etc->noticia->fotos) > 0)
                        <div class="row img-news img-fluid">
                            @foreach($etc->noticia->fotos as $foto)
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
                            @foreach($noticias as $etc)
                                <div class="col-6 nota-news">
                                    {!! $etc->noticia->texto !!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @break
    @endforeach
    <!-- divisão de editorias -->
    @foreach($noticias as $noti)
        @if($noti->noticia->retranca_id == 12)
            <!-- Disse-se -->
            <div class="edit">
                <div class="row">
                    <div class="retranca">
                        <h3>Disse-se</h3>
                        <x-icon-internet class="icon-dia"/>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            @foreach($noticias as $disse)
                                <div class="disse">
                                    <div class="row tit-disse">
                                        <h3>{{$disse->noticia->title}}</h3>
                                    </div>
                                    @if(count($disse->noticia->fotos) > 0)
                                        <div class="row d-flex">
                                            <div class="col-8 disse-news">
                                                {!! $disse->noticia->texto !!}
                                            </div>
                                            <div class="col-4 circle mt-3">
                                                @foreach($disse->noticia->fotos as $foto)
                                                    <img src="{{asset($foto->foto_path)}}" width="120" alt="Image">
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-12 disse-news">
                                            {!! $disse->noticia->texto !!}
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @break
    @endforeach
    <!-- divisão de editorias -->
    @foreach($noticias as $noti)
        @if($noti->noticia->retranca_id == 13)
            <!-- Dinheiro -->
            <div class="edit">
                @foreach($noticias as $dinhe)
                    @if(count($dinhe->noticia->fotos) > 0)
                        <div class="row img-news img-fluid">
                            @foreach($dinhe->noticia->fotos as $foto)
                                <img src="{{asset($foto->foto_path)}}" alt="imagem principal" />
                                @break
                            @endforeach
                        </div>
                    @endif
                @endforeach
                <div class="row">
                    <div class="retranca">
                        <h3>Dinheiro</h3>
                        <x-icon-dolar class="icon-dia"/>
                    </div>
                    @foreach($noticias as $dinhe)
                        @if($dinhe->noticia->title == 'Dolar')
                            <div class="col-10">
                                <div class="row tit-dolar">
                                    <div class="retranca">
                                        <h3>{{$dinhe->noticia->title}}</h3>
                                        <x-icon-dolar class="icon-dia"/>
                                    </div>
                                </div>
                                <div class="cota-news">
                                    {!! $dinhe->noticia->texto !!}
                                </div>
                                <hr class="cota"/>
                            </div>
                        @elseif($dinhe->noticia->title == 'Bovespa')
                            <div class="col-10">
                                <div class="row tit-dolar">
                                    <div class="retranca">
                                        <h3>{{$dinhe->noticia->title}}</h3>
                                        <x-icon-bolsa class="icon-dia"/>
                                    </div>
                                </div>
                                <div class="cota-news">
                                    {!! $dinhe->noticia->texto !!}
                                </div>
                                <hr class="cota"/>
                            </div>
                        @else
                            <div class="row tit-princ">
                                <h3>{{$dinhe->noticia->title}}</h3>
                            </div>
                            <div class="texto-news">
                                {!! $dinhe->noticia->texto !!}
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
        @break
    @endforeach
    <!-- divisão de editorias -->
    @foreach($noticias as $noti)
        @if($noti->noticia->retranca_id == 14)
            <!-- Planeta -->
            <div class="edit">
                @foreach($noticias as $plane)
                    @if(count($plane->noticia->fotos) > 0)
                        <div class="row img-news img-fluid">
                            @foreach($plane->noticia->fotos as $foto)
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
                    @foreach($noticias as $plane)
                        @if(strpos($plane->noticia->resumo, 'recuo'))
                            <div class="recuo-news">
                                <h6>{{$plane->noticia->title}}</h6>
                                {!! $plane->noticia->texto !!}
                            </div>
                        @else
                            <div class="row tit-princ">
                                <h3>{{$plane->noticia->title}}</h3>
                            </div>
                            <div class="texto-news">
                                {!! $plane->noticia->texto !!}
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
        @break
    @endforeach
    <!-- divisão de editorias -->
    @foreach($noticias as $noti)
        @if($noti->noticia->retranca_id == 15)
            <!-- Cuidar -->
            <div class="edit">
                @foreach($noticias as $cuida)
                    @if(count($cuida->noticia->fotos) > 0)
                        <div class="row img-news img-fluid">
                            @foreach($cuida->noticia->fotos as $foto)
                                <img src="{{asset($foto->foto_path)}}" alt="imagem principal" />
                                @break
                            @endforeach
                        </div>
                    @endif
                @endforeach
                <div class="row">
                    <div class="retranca">
                        <h3>Cuidar</h3>
                        <x-icon-tempo class="icon-dia"/>
                    </div>
                    @foreach($noticias as $cuida)
                        @if(strpos($cuida->noticia->resumo, 'recuo'))
                            <div class="recuo-news">
                                <h6>{{$cuida->noticia->title}}</h6>
                                {!! $cuida->noticia->texto !!}
                            </div>
                        @else
                            <div class="row tit-princ">
                                <h3>{{$cuida->noticia->title}}</h3>
                            </div>
                            <div class="texto-news">
                                {!! $cuida->noticia->texto !!}
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
        @break
    @endforeach
    <!-- divisão de editorias -->
    @foreach($noticias as $noti)
        @if($noti->noticia->retranca_id == 16)
            <!-- Cult e Tec -->
            <div class="edit cult">
                @foreach($noticias as $cult)
                    @if(count($cult->noticia->fotos) > 0)
                        <div class="row img-news img-fluid">
                            @foreach($cult->noticia->fotos as $foto)
                                <img src="{{asset($foto->foto_path)}}" alt="imagem principal" />
                                @break
                            @endforeach
                        </div>
                    @endif
                @endforeach
                <div class="row">
                    <div class="retranca">
                        <h3>Cult & Tec</h3>
                        <x-icon-cientec class="icon-dia"/>
                    </div>
                    @foreach($noticias as $cult)
                        @if(strpos($cult->noticia->resumo, 'recuo'))
                            <div class="recuo-news">
                                <h6>{{$cult->noticia->title}}</h6>
                                {!! $cult->noticia->texto !!}
                            </div>
                        @else
                            <div class="row tit-princ">
                                <h3>{{$cult->noticia->title}}</h3>
                            </div>
                            <div class="texto-news">
                                {!! $cult->noticia->texto !!}
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
        @break
    @endforeach
    <div class="d-flex justify-content-center">
        <hr class="linha-news"/>
    </div>
    <!-- rodapé -->
    <div class="edit rodape-news">
        <div class="rodape-tit">
            <h3>Obrigado por ler</h3>
            <x-icon-jornal class="icon-roda"/>
        </div>
        <div class="row roda-text">
            <p><a href="#">Assine</a> e tenha acesso diário a nossa newsletter.
                Veja outras edições <a href="#">aqui.</a></p>
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
        <div class="rodape-tit">
            <h6 class="final">Você está recebendo esse conteúdo porque um amigo se inscreveu na newsletter
                do Canal Minutos. Para se assinar e também fazer parte desta elite, <a href="#">clique aqui.</a></h6>
            <x-marca-minutos class="icon-final"/>
        </div>
    </div>
</div>
@endsection

@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    {{-- Body --}}

    <div class="container-admin-news">
    <div class="row">
    <div class="col-md-12">
    <div class="row">
    <div id="news-show-email">
    <!-- Cabeçalho -->
    <div class="row desk-email">
    @if(setlocale(LC_TIME, 'pt_Br'))
    <h6>{{strftime("%A", strtotime($mailNews['dataNews']))}}</h6>
    <h6 class="data-news">{{strftime("%e de %B de %Y", strtotime($mailNews['dataNews']))}}</h6>
    @endif
    </div>
    <div class="row desk parceria">
    <x-marca-minutos class="img-fluid"/>
    </div>
    <div class="row desk-email">
    <div>
    @if($mailNews['foto_parca'] != null)
    <div class="row parceria">
    <p>Em parceria com:</p>
    </div>
    <div class="row parceria">
    <img src="{{asset($mailNews['foto_parca'])}}" class="img-fluid"/>
    </div>
    @endif
    </div>
    </div>
    <!-- Fim do Cabeçalho -->
    <div class="d-flex justify-content-center">
    <hr class="linha-news"/>
    </div>
    <!-- Inicio Abertura -->
    <div class="edit">
    <div class="row">
    <div class="edit-abert">
    <div>
    <h4 class="saud-h4">Bom dia, {{strtok($mailNews['saud'], " ")}}</h4>
    </div>
    <div>
    <img src="{{asset('icones/cafe_azul-300.png')}}" alt="Hora do cafezinho" class="img-fluid"/>
    </div>
    </div>
    </div>
    <div class="edit-abert">
    <div>{!! $mailNews['abertura'] !!}</div>
    </div>
    <div class="row">
    <h5 class="saud-h5">Boa leitura!</h5>
    </div>
    <div class="row aviso-news">
    <p class="aviso-n">Tem algum feedback? Queremos muito saber. <a href="#">Conte-nos</a></p>
    <p class="aviso-n pn">Gostou do conteúdo? <a href="#">Convide um amigo.</a> Isso é muito importante pra gente.</p>
    </div>
    </div>
    <!-- FIM Abertura -->
    <div class="d-flex justify-content-center">
    <hr class="linha-news"/>
    </div>
    <!-- Inicio Historia do dia -->
    <div class="edit">
    @foreach($mailNews['hist_dia'] as $hist)
    @if(count($hist->noticia->fotos) > 0)
    <div class="row img-news img-fluid">
    @foreach($hist->noticia->fotos as $foto)
    <img src="{{asset($foto->foto_path)}}" alt="imagem principal" />
    @break
    @endforeach
    </div>
    @endif
    @break
    @endforeach
    <div class="row">
    <div class="retranca">
    <div>
    <h3 class="retr-edit">História do dia</h3>
    </div>
    <div>
    <img src="{{asset('icones/rapidez_azul-300.png')}}" alt="icone Dia" class="img-fluid" />
    </div>
    </div>
    @foreach($mailNews['hist_dia'] as $hist)
    <div class="row">
    <h2 class="tit-princ">{{$hist->noticia->title}}</h2>
    </div>
    <div class="texto-news">
    {!! $hist->noticia->texto !!}
    </div>
    @endforeach
    </div>
    <div class="row" style="margin-bottom: -20px">
    <p class="social-news">
    @foreach($mailNews['hist_dia'] as $noti)
    <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/twitter.png')}}" alt="twitter" class="ico-soc-w img-fluid" /></a>
    <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/facebook.png')}}" alt="facebook" class="ico-soc-h img-fluid" /></a>
    <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/envelope.png')}}" alt="email" class="ico-soc-w img-fluid" /></a>
    <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/whatsapp.png')}}" alt="whatsapp" class="ico-soc-w img-fluid" /></a>
    @break
    @endforeach
    </p>
    </div>
    </div>
    <!-- FIM Historia do dia -->
    <div class="d-flex justify-content-center">
    <hr class="linha-news"/>
    </div>
    <!-- Inicio E ainda -->
    <div class="edit">
    @foreach($mailNews['noti_ainda'] as $ainda)
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
    <div>
    <h3 class="retr-edit">E ainda...</h3>
    </div>
    <div>
    <img src="{{asset('icones/jornalismo_azul-300.png')}}" alt="icone Dia" class="img-fluid" />
    </div>
    </div>
    @foreach($mailNews['noti_ainda'] as $ainda)
    <div class="row">
    <h3 class="tit-secund">{{$ainda->noticia->title}}</h3>
    </div>
    <div class="texto-news">
    {!! $ainda->noticia->texto !!}
    </div>
    @endforeach
    </div>
    <div class="row" style="margin-bottom: -20px">
    <p class="social-news">
    @foreach($mailNews['noti_ainda'] as $noti)
    <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/twitter.png')}}" alt="twitter"  class="ico-soc-w img-fluid" /></a>
    <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/facebook.png')}}" alt="facebook"  class="ico-soc-h img-fluid" /></a>
    <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/envelope.png')}}" alt="email"  class="ico-soc-w img-fluid" /></a>
    <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/whatsapp.png')}}" alt="whatsapp"  class="ico-soc-w img-fluid" /></a>
    @break
    @endforeach
    </p>
    </div>
    </div>
    <!-- FIM E Ainda -->
    <div class="d-flex justify-content-center">
    <hr class="linha-news"/>
    </div>
    <!-- Inicio Etcetera -->
    <div class="edit">
    <div class="row">
    <div class="retranca">
    <div>
    <h3 class="retr-edit">Etcetera</h3>
    </div>
    <div>
    <img src="{{asset('icones/tempo_azul-300.png')}}" alt="icone Dia" class="img-fluid" />
    </div>
    </div>
    <div class="container-fluid">
    <table class="tab-notas">
    <?php $col = 1; ?>
    @foreach($mailNews['noti_etcs'] as $etc)
    @if($mailNews['num_col'] > $col)
    <tr>
    <td>
    {!! $etc->noticia->texto !!}
    </td>
    <?php $col++; ?>
    @elseif($mailNews['num_col'] == $col)
    <td>
    {!! $etc->noticia->texto !!}
    </td>
    </tr>
    <?php $col = 1; ?>
    @endif
    @endforeach
    </table>
    </div>
    </div>
    <div class="row" style="margin: 10px 0 -20px 0;">
    <p class="social-news">
    @foreach($mailNews['noti_etcs'] as $noti)
    <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/twitter.png')}}" alt="twitter"  class="ico-soc-w img-fluid" /></a>
    <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/facebook.png')}}" alt="facebook"  class="ico-soc-h img-fluid" /></a>
    <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/envelope.png')}}" alt="email"  class="ico-soc-w img-fluid" /></a>
    <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/whatsapp.png')}}" alt="whatsapp"  class="ico-soc-w img-fluid" /></a>
    @break
    @endforeach
    </p>
    </div>
    </div>
    <!-- FIM Etcetera -->
    <div class="d-flex justify-content-center">
    <hr class="linha-news"/>
    </div>
    <!-- Inicio Disse -->
    <div class="edit">
    <div class="row">
    <div class="retranca">
    <div>
    <h3 class="retr-edit">Disse-se</h3>
    </div>
    <div>
    <img src="{{asset('icones/internet_azul-300.png')}}" alt="icone Dia" class="img-fluid" />
    </div>
    </div>
    <div class="row">
    @foreach($mailNews['noti_disses'] as $disse)
    <div class="disse">
    <div class="row tit-disse">
    <h3>{{$disse->noticia->title}}</h3>
    </div>
    <div class="container-disse">
    @if(count($disse->noticia->fotos) > 0)
    <div class="disse-news-i">
    {!! $disse->noticia->texto !!}
    </div>
    <div class="foto-disse">
    <div class="circle">
    @foreach($disse->noticia->fotos as $foto)
    <img src="{{asset($foto->foto_path)}}" alt="Image" >
    @endforeach
    </div>
    </div>
    @else
    <div class="col-12 disse-news">
    {!! $disse->noticia->texto !!}
    </div>
    @endif
    </div>
    </div>
    @endforeach
    </div>
    </div>
    <div class="row" style="margin-bottom: -20px">
    <p class="social-news">
    @foreach($mailNews['noti_disses'] as $noti)
    <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/twitter.png')}}" alt="twitter"  class="ico-soc-w img-fluid" /></a>
    <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/facebook.png')}}" alt="facebook"  class="ico-soc-h img-fluid" /></a>
    <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/envelope.png')}}" alt="email"  class="ico-soc-w img-fluid" /></a>
    <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/whatsapp.png')}}" alt="whatsapp"  class="ico-soc-w img-fluid" /></a>
    @break
    @endforeach
    </p>
    </div>
    </div>
    <!-- FIM Disse -->
    <div class="d-flex justify-content-center">
    <hr class="linha-news"/>
    </div>
    <!-- Inicio Dinheiro -->
    <div class="edit">
    <div class="row">
    <div class="retranca">
    <div>
    <h3 class="retr-edit">Dinheiro</h3>
    </div>
    <div>
    <img src="{{asset('icones/dolar_azul-300.png')}}" alt="icone Dia" class="img-fluid" />
    </div>
    </div>
    @foreach($mailNews['noti_dinhes'] as $dinhe)
    @if($dinhe->noticia->title == 'Dolar')
    <div>
    <div class="row tit-dolar">
    <div>
    <h3 class="retr-edit">{{$dinhe->noticia->title}}</h3>
    </div>
    </div>
    <div class="cota-news">
    {!! $dinhe->noticia->texto !!}
    </div>
    <hr class="linha-news"/>
    </div>
    @elseif($dinhe->noticia->title == 'Bovespa')
    <div class="col-10">
    <div class="row tit-dolar">
    <div>
    <h3 class="retr-edit">{{$dinhe->noticia->title}}</h3>
    </div>
    </div>
    <div class="cota-news">
    {!! $dinhe->noticia->texto !!}
    </div>
    <hr class="linha-news"/>
    </div>
    @else
    <div class="row">
    <h3 class="tit-secund">{{$dinhe->noticia->title}}</h3>
    </div>
    <div class="texto-news">
    {!! $dinhe->noticia->texto !!}
    </div>
    @endif
    @endforeach
    </div>
    <div class="row" style="margin-bottom: -20px">
    <p class="social-news">
    @foreach($mailNews['noti_dinhes'] as $noti)
    <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/twitter.png')}}" alt="twitter"  class="ico-soc-w img-fluid" /></a>
    <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/facebook.png')}}" alt="facebook"  class="ico-soc-h img-fluid" /></a>
    <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/envelope.png')}}" alt="email"  class="ico-soc-w img-fluid" /></a>
    <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/whatsapp.png')}}" alt="whatsapp"  class="ico-soc-w img-fluid" /></a>
    @break
    @endforeach
    </p>
    </div>
    </div>
    <!-- FIM Dinheiro -->
    <div class="d-flex justify-content-center">
    <hr class="linha-news"/>
    </div>
    <!-- Inicio Planeta -->
    <div class="edit">
    @foreach($mailNews['noti_planes'] as $plane)
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
    <div>
    <h3 class="retr-edit">Planeta</h3>
    </div>
    <div>
    <img src="{{asset('icones/globo_azul-300.png')}}" alt="icone Dia" class="img-fluid" />
    </div>
    </div>
    @foreach($mailNews['noti_planes'] as $plane)
    @if(strpos($plane->noticia->resumo, 'recuo'))
    <div class="recuo-news">
    <h6>{{$plane->noticia->title}}</h6>
    {!! $plane->noticia->texto !!}
    </div>
    @else
    <div class="row">
    <h3 class="tit-secund">{{$plane->noticia->title}}</h3>
    </div>
    <div class="texto-news">
    {!! $plane->noticia->texto !!}
    </div>
    @endif
    @endforeach
    </div>
    <div class="row" style="margin-bottom: -20px">
    <p class="social-news">
    @foreach($mailNews['noti_planes'] as $noti)
    <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/twitter.png')}}" alt="twitter"  class="ico-soc-w img-fluid" /></a>
    <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/facebook.png')}}" alt="facebook"  class="ico-soc-h img-fluid" /></a>
    <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/envelope.png')}}" alt="email"  class="ico-soc-w img-fluid" /></a>
    <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/whatsapp.png')}}" alt="whatsapp"  class="ico-soc-w img-fluid" /></a>
    @break
    @endforeach
    </p>
    </div>
    </div>
    <!-- FIM Planeta -->
    <div class="d-flex justify-content-center">
    <hr class="linha-news"/>
    </div>
    <!-- Inicio Cuidar -->
    <div class="edit">
    @foreach($mailNews['noti_cuidas'] as $cuida)
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
    <div>
    <h3 class="retr-edit">Cuidar</h3>
    </div>
    <div>
    <img src="{{asset('icones/tempo_azul-300.png')}}" alt="icone Dia" class="img-fluid" />
    </div>
    </div>
    @foreach($mailNews['noti_cuidas'] as $cuida)
    @if(strpos($cuida->noticia->resumo, 'recuo'))
    <div class="recuo-news">
    <h6>{{$cuida->noticia->title}}</h6>
    {!! $cuida->noticia->texto !!}
    </div>
    @else
    <div class="row">
    <h3 class="tit-secund">{{$cuida->noticia->title}}</h3>
    </div>
    <div class="texto-news">
    {!! $cuida->noticia->texto !!}
    </div>
    @endif
    @endforeach
    </div>
    <div class="row" style="margin-bottom: -20px">
    <p class="social-news">
    @foreach($mailNews['noti_cuidas'] as $noti)
    <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/twitter.png')}}" alt="twitter"  class="ico-soc-w img-fluid" /></a>
    <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/facebook.png')}}" alt="facebook"  class="ico-soc-h img-fluid" /></a>
    <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/envelope.png')}}" alt="email"  class="ico-soc-w img-fluid" /></a>
    <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/whatsapp.png')}}" alt="whatsapp"  class="ico-soc-w img-fluid" /></a>
    @break
    @endforeach
    </p>
    </div>
    </div>
    <!-- FIM Cuidar -->
    <div class="d-flex justify-content-center">
    <hr class="linha-news"/>
    </div>
    <!-- Inicio Cult & Tec -->
    <div class="edit cult">
    @foreach($mailNews['noti_cults'] as $cult)
    @if(count($cult->noticia->fotos) > 0)
    <div class="row img-news">
    @foreach($cult->noticia->fotos as $foto)
    <img src="{{asset($foto->foto_path)}}" alt="imagem principal" class="img-fluid"/>
    @break
    @endforeach
    </div>
    @endif
    @endforeach
    <div class="row">
    <div class="retranca">
    <div>
    <h3 class="retr-edit">Cult & Tec</h3>
    </div>
    <div>
    <img src="{{asset('icones/ct_azul-300.png')}}" alt="icone Dia" class="img-fluid" />
    </div>
    </div>
    @foreach($mailNews['noti_cults'] as $cult)
    @if(strpos($cult->noticia->resumo, 'recuo'))
    <div class="recuo-news">
    <h6>{{$cult->noticia->title}}</h6>
    {!! $cult->noticia->texto !!}
    </div>
    @else
    <div class="row">
    <h3 class="tit-secund">{{$cult->noticia->title}}</h3>
    </div>
    <div class="texto-news">
    {!! $cult->noticia->texto !!}
    </div>
    @endif
    @endforeach
    </div>
    <div class="row" style="margin-bottom: -20px">
    <p class="social-news">
    @foreach($mailNews['noti_cults'] as $noti)
    <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/twitter.png')}}" alt="twitter"  class="ico-soc-w img-fluid" /></a>
    <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/facebook.png')}}" alt="facebook"  class="ico-soc-h img-fluid" /></a>
    <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/envelope.png')}}" alt="email"  class="ico-soc-w img-fluid" /></a>
    <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->editoria])}}" target="_blank"><img src="{{asset('icones/sociais/whatsapp.png')}}" alt="whatsapp"  class="ico-soc-w img-fluid" /></a>
    @break
    @endforeach
    </p>
    </div>
    </div>
    <!-- FIM Cult e Tec -->
    <div class="d-flex justify-content-center">
    <hr class="linha-news"/>
    </div>
    <!-- Inicio Rodapé -->
    <div class="rodape-geral">
    <div class="rodape-news">
    <div class="rodape-tit">
    <h3>Obrigado por ler</h3>
    </div>
    </div>
    <div class="rodape-news">
    <div class="img-final">
    <img src="{{asset('icones/jornalismo_br-300.png')}}" alt="Icone newsletter" class="img-fluid"  />
    </div>
    </div>
    <div class="rodape-news">
    <div class="row roda-text">
    <p><a href="#">Conte pra gente</a> o que achou da newsletter de hoje. Veja outras edições <a href="#">aqui.</a> Se gostou, que tal <a href="#">chamar um amigo</a> para assinar?</p>
    </div>
    </div>
    <div class="rodape-news">
    <div class="row">
    <p class="fim">Acompanhe nossas redes sociais</p>
    <p class="social-news soc-fim">
    <a href="#" target="_blank"><img src="{{asset('icones/sociais/twitter.png')}}" alt="twitter"  class="ico-soc-w img-fluid" /></a>
    <a href="#" target="_blank"><img src="{{asset('icones/sociais/facebook.png')}}" alt="facebook"  class="ico-soc-h img-fluid" /></a>
    <a href="#" target="_blank"><img src="{{asset('icones/sociais/instagram.png')}}" alt="email"  class="ico-soc-w img-fluid" /></a>
    <a href="#" target="_blank"><img src="{{asset('icones/sociais/linkedin.png')}}" alt="whatsapp"  class="ico-soc-w img-fluid" /></a>
    </p>
    </div>
    </div>
    </div>
    <!-- FIM RODAPE ---- -->
    <!-- Assinatura Final -->
    <div class="rodape-news-final">
    <div class="rodape-tit2">
    <div class="row">
    <img src="{{asset('icones/minutos.png')}}" alt="Marca Minutos" class="img-fluid" />
    </div>
    <div class="row">
    <h6 class="final">Você está recebendo esse email porque se inscreveu na newsletter do Canal Minutos.</h6>
    <h6 class="final baixo">Para se descadastrar a qualquer momento, <a href="#">clique aqui.</a></h6>
    </div>
    </div>
    </div>
    <!-- Assinatura fim -->
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>




    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent

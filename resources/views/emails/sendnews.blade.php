@component('mail::layout')
    {{-- Header --}}

    {{-- Body --}}

    <div class="container-admin-news">
    <div class="row">
    <div class="col-md-12">
    <div class="row">
    <div id="news-show-email">
    <!-- Cabeçalho -->
    <div class="row desk-email">
    <table class="table-abert">
    <tr>
    <td style="text-align: center"><p style="font-size: 10px;">{!! $mailNews['diaNews']!!}</p></td>
    </tr>
    <tr>
    <td><img src="{{asset('icones/minutos.png')}}" height="45" class="img-fluid"/></td>
    </tr>
    @if($mailNews['foto_parca'] != null)
    <tr>
    <td style="text-align: center;"><p style="font-size: 10px;">Em parceria com</p></td>
    </tr>
    <tr>
    <td><img src="{{asset($mailNews['foto_parca'])}}" width="180" class="img-fluid"/></td>
    </tr>
    @endif
    </table>
    </div>
    <!-- Fim do Cabeçalho -->
    <div class="d-flex justify-content-center">
    <hr class="linha-news"/>
    </div>
    <!-- Inicio Abertura -->
    <div class="edit">
    <div class="row">
    <div class="edit-abert">
    <table class="table-icon">
    <tr>
    <td><h4 class="saud-h4" style="font-family: RobotoSerifRegular, Roboto-Serif, serif">Bom dia, {{strtok($mailNews['saud'], " ")}}</h4></td>
    <td><img src="{{asset('site/icones/azul/cafe-300.png')}}" alt="Hora do cafezinho" class="img-fluid"/></td>
    </tr>
    </table>
    </div>
    </div>
    <div class="edit-abert">
    <div><p class="saud-h4" style="font-family: RobotoSerifRegular, Roboto-Serif, serif">{!! $mailNews['abertura'] !!}</p></div>
    </div>
    <div class="row">
    <h4 class="saud-h4" style="font-family: RobotoSerifRegular, Roboto-Serif, serif">Boa leitura!</h4>
    </div>
    <div class="row aviso-news">
    <h4 class="saud-h4" style="font-family: RobotoSerifRegular, Roboto-Serif, serif;">Tem algum feedback? Queremos muito saber. <a href="#" style="font-family: RobotoSerifRegular, Roboto-Serif, serif">Conte-nos</a></h4>
    <h4 class="saud-h4" style="font-family: RobotoSerifRegular, Roboto-Serif, serif; margin-top: -10px;">Gostou do conteúdo? <a href="#" style="font-family: RobotoSerifRegular, Roboto-Serif, serif">Convide um amigo.</a> Isso é muito importante para a gente.</h4>
    </div>
    </div>
    <!-- FIM Abertura -->
    <div class="d-flex justify-content-center">
    <hr class="linha-news"/>
    </div>
    <!-- Inicio Historia do dia -->
    <div class="edit">
    @foreach($mailNews['hist_dia'] as $hist)
    @if(count($hist->fotos) > 0)
    <div class="row img-news img-fluid">
    @foreach($hist->fotos as $foto)
    <img src="{{asset($foto->foto_path)}}" alt="imagem principal" />
    @break
    @endforeach
    </div>
    @endif
    @break
    @endforeach
    <div class="row">
    <table class="table-icon">
    <tr>
    <td><h3 class="retr-edit">História do dia</h3></td>
    <td><img src="{{asset('site/icones/azul/jornal-300.png')}}" width="60" alt="icone Dia" class="img-fluid" /></td>
    </tr>
    </table>
    @foreach($mailNews['hist_dia'] as $hist)
    <div class="row">
    <h2 class="tit-princ">{{$hist->title}}</h2>
    </div>
    <div class="texto-news">
    {!! $hist->texto !!}
    </div>
    @endforeach
    </div>
    <div class="row">
    <p class="social-news">
    @foreach($mailNews['hist_dia'] as $noti)
    <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/twitter.png')}}" alt="twitter" width="16" class="ico-soc-w img-fluid" style="margin-top: 9px;" /></a>
    <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/facebook.png')}}" alt="facebook" height="16" class="ico-soc-h img-fluid" style="margin-top: 6px;" /></a>
    <a href="mailto:?subject=Canal-Minutos&body={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/envelope.png')}}" alt="email" width="16" class="ico-soc-w img-fluid" style="margin-top: 9px;" /></a>
    <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/whatsapp.png')}}" alt="whatsapp" width="16" class="ico-soc-w img-fluid" style="margin-top: 6px;" /></a>
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
    <table class="table-icon">
    <tr>
    <td><h3 class="retr-edit">E ainda...</h3></td>
    <td><img src="{{asset('site/icones/azul/fast-300.png')}}" width="60" alt="icone E ainda..." class="img-fluid" /></td>
    </tr>
    </table>
    @foreach($mailNews['noti_ainda'] as $ainda)
    <div class="row">
    <h3 class="tit-secund">{{$ainda->title}}</h3>
    </div>
    <div class="texto-news">
    {!! $ainda->texto !!}
    </div>
    @endforeach
    </div>
    <div class="row" style="margin-bottom: -20px">
    <p class="social-news">
    @foreach($mailNews['noti_ainda'] as $noti)
    <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/twitter.png')}}" alt="twitter"  class="ico-soc-w img-fluid" /></a>
    <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/facebook.png')}}" alt="facebook"  class="ico-soc-h img-fluid" /></a>
    <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/envelope.png')}}" alt="email"  class="ico-soc-w img-fluid" /></a>
    <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/whatsapp.png')}}" alt="whatsapp"  class="ico-soc-w img-fluid" /></a>
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
    <table class="table-icon">
    <tr>
    <td><h3 class="retr-edit">Etcetera</h3></td>
    <td><img src="{{asset('site/icones/azul/tempo-300.png')}}" width="60" alt="icone Etcetera" class="img-fluid" /></td>
    </tr>
    </table>
    <div class="container-fluid">
    <table class="tab-notas">
    <?php $col = 1; ?>
    @foreach($mailNews['noti_etcs'] as $etc)
    @if($mailNews['num_col'] > $col)
    <tr>
    <td>
    {!! $etc->texto !!}
    </td>
    <?php $col++; ?>
    @elseif($mailNews['num_col'] == $col)
    <td>
    {!! $etc->texto !!}
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
    <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/twitter.png')}}" alt="twitter"  class="ico-soc-w img-fluid" /></a>
    <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/facebook.png')}}" alt="facebook"  class="ico-soc-h img-fluid" /></a>
    <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/envelope.png')}}" alt="email"  class="ico-soc-w img-fluid" /></a>
    <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/whatsapp.png')}}" alt="whatsapp"  class="ico-soc-w img-fluid" /></a>
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
    <table class="table-icon">
    <tr>
    <td><h3 class="retr-edit">Disse-se</h3></td>
    <td><img src="{{asset('site/icones/azul/internet-300.png')}}" width="60" alt="icone Disse-se" class="img-fluid" /></td>
    </tr>
    </table>
    <div class="row">
    @foreach($mailNews['noti_disses'] as $disse)
    <div class="disse">
    <div class="row tit-disse">
    <h3 class="tit-disse" style="font-family: RobotoSerifRegular, Roboto-Serif, serif">{{$disse->title}}</h3>
    </div>
    <div class="container-disse">
    @if(count($disse->fotos) > 0)
    <div class="disse-news-i" style="font-family: RobotoSerifRegular, Roboto-Serif, serif">
    {!! $disse->texto !!}
    </div>
    <div class="foto-disse">
    <div class="circle">
    @foreach($disse->fotos as $foto)
    <img src="{{asset($foto->foto_path)}}" style="filter: grayscale(80)" alt="Image" >
    @endforeach
    </div>
    </div>
    @else
    <div class="col-12 disse-news" style="font-family: RobotoSerifRegular, Roboto-Serif, serif">
    {!! $disse->texto !!}
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
    <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/twitter.png')}}" alt="twitter"  class="ico-soc-w img-fluid" /></a>
    <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/facebook.png')}}" alt="facebook"  class="ico-soc-h img-fluid" /></a>
    <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/envelope.png')}}" alt="email"  class="ico-soc-w img-fluid" /></a>
    <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/whatsapp.png')}}" alt="whatsapp"  class="ico-soc-w img-fluid" /></a>
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
    <table class="table-icon">
    <tr>
    <td><h3 class="retr-edit">Dinheiro</h3></td>
    <td><img src="{{asset('site/icones/azul/bolsa-300.png')}}" width="60" alt="icone Dinheiro" class="img-fluid" /></td>
    </tr>
    </table>
    @foreach($mailNews['noti_dinhes'] as $dinhe)
    @if($dinhe->title == 'Dolar')
    <div>
    <div class="row tit-dolar">
    <div>
    <h3 class="retr-edit">{{$dinhe->title}}</h3>
    </div>
    </div>
    <div class="cota-news">
    {!! $dinhe->texto !!}
    </div>
    <hr class="linha-news"/>
    </div>
    @elseif($dinhe->title == 'Bovespa')
    <div class="col-10">
    <div class="row tit-dolar">
    <div>
    <h3 class="retr-edit">{{$dinhe->title}}</h3>
    </div>
    </div>
    <div class="cota-news">
    {!! $dinhe->texto !!}
    </div>
    <hr class="linha-news"/>
    </div>
    @else
    <div class="row">
    <h3 class="tit-secund">{{$dinhe->title}}</h3>
    </div>
    <div class="texto-news">
    {!! $dinhe->texto !!}
    </div>
    @endif
    @endforeach
    </div>
    <div class="row" style="margin-bottom: -20px">
    <p class="social-news">
    @foreach($mailNews['noti_dinhes'] as $noti)
    <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/twitter.png')}}" alt="twitter"  class="ico-soc-w img-fluid" /></a>
    <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/facebook.png')}}" alt="facebook"  class="ico-soc-h img-fluid" /></a>
    <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/envelope.png')}}" alt="email"  class="ico-soc-w img-fluid" /></a>
    <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/whatsapp.png')}}" alt="whatsapp"  class="ico-soc-w img-fluid" /></a>
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
    <table class="table-icon">
    <tr>
    <td><h3 class="retr-edit">Planeta</h3></td>
    <td><img src="{{asset('site/icones/azul/globo-300.png')}}" width="60" alt="icone Planeta" class="img-fluid" /></td>
    </tr>
    </table>
    @foreach($mailNews['noti_planes'] as $plane)
    @if(strpos($plane->resumo, 'recuo'))
    <div class="recuo-news">
    <h6>{{$plane->title}}</h6>
    {!! $plane->texto !!}
    </div>
    @else
    <div class="row">
    <h3 class="tit-secund">{{$plane->title}}</h3>
    </div>
    <div class="texto-news">
    {!! $plane->texto !!}
    </div>
    @endif
    @endforeach
    </div>
    <div class="row" style="margin-bottom: -20px">
    <p class="social-news">
    @foreach($mailNews['noti_planes'] as $noti)
    <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/twitter.png')}}" alt="twitter"  class="ico-soc-w img-fluid" /></a>
    <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/facebook.png')}}" alt="facebook"  class="ico-soc-h img-fluid" /></a>
    <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/envelope.png')}}" alt="email"  class="ico-soc-w img-fluid" /></a>
    <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/whatsapp.png')}}" alt="whatsapp"  class="ico-soc-w img-fluid" /></a>
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
    <table class="table-icon">
    <tr>
    <td><h3 class="retr-edit">Cuidar</h3></td>
    <td><img src="{{asset('site/icones/azul/cuidar-300.png')}}" width="60" alt="icone Cuidar" class="img-fluid" /></td>
    </tr>
    </table>
    @foreach($mailNews['noti_cuidas'] as $cuida)
    @if(strpos($cuida->resumo, 'recuo'))
    <div class="recuo-news">
    <h6>{{$cuida->title}}</h6>
    {!! $cuida->texto !!}
    </div>
    @else
    <div class="row">
    <h3 class="tit-secund">{{$cuida->title}}</h3>
    </div>
    <div class="texto-news">
    {!! $cuida->texto !!}
    </div>
    @endif
    @endforeach
    </div>
    <div class="row" style="margin-bottom: -20px">
    <p class="social-news">
    @foreach($mailNews['noti_cuidas'] as $noti)
    <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/twitter.png')}}" alt="twitter"  class="ico-soc-w img-fluid" /></a>
    <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/facebook.png')}}" alt="facebook"  class="ico-soc-h img-fluid" /></a>
    <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/envelope.png')}}" alt="email"  class="ico-soc-w img-fluid" /></a>
    <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/whatsapp.png')}}" alt="whatsapp"  class="ico-soc-w img-fluid" /></a>
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
    @if(count($cult->fotos) > 0)
    <div class="row img-news">
    @foreach($cult->fotos as $foto)
    <img src="{{asset($foto->foto_path)}}" alt="imagem principal" class="img-fluid"/>
    @break
    @endforeach
    </div>
    @endif
    @endforeach
    <div class="row">
    <table class="table-icon">
    <tr>
    <td><h3 class="retr-edit">Cult & Tec</h3></td>
    <td><img src="{{asset('site/icones/azul/culttec-300.png')}}" width="60" alt="icone Cultura e Tecnologias" class="img-fluid" /></td>
    </tr>
    </table
    @foreach($mailNews['noti_cults'] as $cult)
    @if(strpos($cult->resumo, 'recuo'))
    <div class="recuo-news">
    <h6>{{$cult->title}}</h6>
    {!! $cult->texto !!}
    </div>
    @else
    <div class="row">
    <h3 class="tit-secund">{{$cult->title}}</h3>
    </div>
    <div class="texto-news">
    {!! $cult->texto !!}
    </div>
    @endif
    @endforeach
    </div>
    <div class="row" style="margin-bottom: -20px">
    <p class="social-news">
    @foreach($mailNews['noti_cults'] as $noti)
    <a href="https://twitter.com/intent/tweet?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/twitter.png')}}" alt="twitter"  class="ico-soc-w img-fluid" /></a>
    <a href="https://www.facebook.com/sharer/sharer.php?u={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/facebook.png')}}" alt="facebook"  class="ico-soc-h img-fluid" /></a>
    <a href="mailto:?subject={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/envelope.png')}}" alt="email"  class="ico-soc-w img-fluid" /></a>
    <a href="https://api.whatsapp.com/send?text={{route('noticias.show', ['id' => $noti->retranca_id])}}" target="_blank"><img src="{{asset('icones/sociais/whatsapp.png')}}" alt="whatsapp"  class="ico-soc-w img-fluid" /></a>
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
    <table class="table-final">
    <tr>
    <td><h3 style="font-family: RobotoSerifRegular, Roboto-Serif, serif;">Obrigado por ler</h3></td>
    </tr>
    <tr>
    <td><img src="{{asset('site/icones/branco/jornal-300.png')}}" width="90" alt="Icone newsletter" class="img-fluid"  /></td>
    </tr>
    <tr>
    <td style="font-family: RobotoSerifRegular, Roboto-Serif, serif;">
    <a href="#" style="font-family: RobotoSerifRegular, Roboto-Serif, serif; text-decoration: #41a7d7 underline;">Conte pra gente</a> o que achou da newsletter de hoje. Veja outras edições <a href="#" style="font-family: RobotoSerifRegular, Roboto-Serif, serif;">aqui.</a> Se gostou, que tal <a href="#" style="font-family: RobotoSerifRegular, Roboto-Serif, serif;">chamar um amigo</a> para assinar?
    </td>
    </tr>
    <tr>
    <td>
    <div class="rodape-news">
    <div class="row">
    <p class="fim" style="font-family: RobotoSerifRegular, Roboto-Serif, serif;">Acompanhe nossas redes sociais</p>
    <p class="social-news soc-fim">
    <a href="#" target="_blank"><img src="{{asset('icones/sociais/twitter.png')}}" alt="twitter"  class="ico-soc-w img-fluid" /></a>
    <a href="#" target="_blank"><img src="{{asset('icones/sociais/facebook.png')}}" alt="facebook"  class="ico-soc-h img-fluid" /></a>
    <a href="#" target="_blank"><img src="{{asset('icones/sociais/instagram.png')}}" alt="email"  class="ico-soc-w img-fluid" /></a>
    <a href="#" target="_blank"><img src="{{asset('icones/sociais/linkedin.png')}}" alt="whatsapp"  class="ico-soc-w img-fluid" /></a>
    </p>
    </div>
    </div>
    </td>
    </tr>
    </table>
    </div>
    <!-- FIM RODAPE ---- -->
    <!-- Assinatura Final -->
    <table class="table-final-ass">
    <tr>
    <td><img src="{{asset('icones/minutos.png')}}" height="30" alt="Marca Minutos" class="img-fluid" /></td>
    </tr>
    <tr>
    <td>
    <h6 class="final">Você está recebendo esse email porque se inscreveu na newsletter do Canal Minutos.</h6>
    <h6 style="margin-top: -20px;">Para se descadastrar a qualquer momento, <a href="#" style="text-decoration: #41a7d7 underline;">clique aqui.</a></h6>
    </td>
    </tr>
    </table>
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

@component('mail::message')
# {{\Carbon\Carbon::parse($mailData['date'])->format('d/m/Y')}}
# {{$mailData['title']}}

<h4>{{$mailData['sub-title']}}</h4>

{!! $mailData['mensagem'] !!}

<br>

@component('mail::button', ['url' => $mailData['url']])
    {{$mailData['title-button']}}
@endcomponent
<br>
<p>Caso tenha problema com o botão copie e cole o link abaixo em qualquer navegador</p>
{!! $mailData['url_copia'] !!}

<br><br>

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent

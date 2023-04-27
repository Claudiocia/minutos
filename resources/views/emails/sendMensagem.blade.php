@component('mail::message')
<table style="width: 100%">
<tr>
<td style="text-align: center; font-weight: bold; font-size: 16px;"> {{\Carbon\Carbon::parse($mailData['date'])->format('d/m/Y')}}</td>
</tr>
<tr>
<td style="text-align: center"><img src="https://canalminutos.com.br/site/img/logo.png" height="35" class="img-fluid" alt="marca minutos"/></td>
</tr>
</table>
<br><br>

<h4>{{$mailData['title']}}</h4>


{!! $mailData['mensagem'] !!}

<br>

{{-- Footer --}}
@slot('footer')
    @component('mail::footer')
        © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
    @endcomponent
@endslot

@endcomponent

@extends('layouts.assina')

@section('conteudo')
    <div class="row align-items-center flex-column">
        <div id="assin-content">
            <div class="container-assin">
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-auto p-3">
                            <div class="panel-heading-assin">
                                <h5>Faça a sua assinatura 100% gratuita</h5>
                            </div>
                            <div class="panel-body">
                                <div name="logo">
                                    <a href="{{route('/')}}"><x-jet-authentication-card-logo /></a>
                                </div>
                                <div class="row">
                                        Mensagem de boas vindas
                                    @if (Session::has('msg'))
                                        <div class="my-alert">
                                            {!! Alert::success(Session::get('msg')) !!}
                                        </div>
                                    @elseif(Session::has('error'))
                                        <div>
                                            {!! Alert::danger(Session::get('error')) !!}
                                        </div>
                                        <div class="row">
                                            {!! Button::primary('Reenviar')->asLinkTo(route('clientes.create'))->addClass(['class'=>'estilo-btn']) !!}
                                        </div>
                                    @endif
                                    <div class="aviso">
                                        <p>Para solicitar o reenvio do email de validação <a href="{{route('clientes.create')}}"> clique aqui</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@extends('layouts.assina')

@section('conteudo')
    <div class="row align-items-center flex-column">
        <div id="assin-content">
            <div class="container-assin">
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-auto p-3">
                            <div class="panel-heading-assin">
                                <h5>Complementar assinatura</h5>
                            </div>
                            <div class="panel-body">
                                <div name="logo">
                                    <a href="{{route('/')}}"><x-jet-authentication-card-logo /></a>
                                </div>
                                <div class="row">
                                        <p class="negrito">{!! $mensagem !!}</p>
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
                                        <p>Para solicitar o reenvio do email de validação clique no botão abaixo</p>
                                        <form method="POST" action="{{route('clientes.sendemail')}}">
                                            @csrf
                                            <div class="mb-3">
                                                <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="hidden" name="email"
                                                                 value="{{$email}}"  />
                                            </div>
                                            <div class="mb-0">
                                                <div class="d-flex justify-content-end align-items-baseline">
                                                    <x-jet-button>
                                                        {{ __('Reenviar') }}
                                                    </x-jet-button>
                                                </div>
                                            </div>
                                        </form>
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


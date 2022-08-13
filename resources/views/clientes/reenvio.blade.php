@extends('layouts.assina')

@section('conteudo')
    <div class="row align-items-center flex-column">
        <div id="assin-content">
            <div class="container-assin">
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-auto p-3">
                            <div class="panel-heading-assin">
                                <h5>Reenviar email de verificação</h5>
                            </div>
                            <div class="panel-body">
                                <div name="logo">
                                    <a href="{{route('/')}}"><x-jet-authentication-card-logo /></a>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{route('clientes.sendemail')}}">
                                        @csrf
                                        <div class="mb-3">
                                            <x-jet-label value="{{ __('Email') }}" />
                                            @if($cliente->email ?? '' != null)
                                                <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                                             value="{{$cliente->email}}" required />
                                            @else
                                                <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                                             :value="old('email')" required />
                                            @endif
                                            <x-jet-input-error for="email"></x-jet-input-error>
                                        </div>
                                        <div class="mb-0">
                                            <div class="d-flex justify-content-end align-items-baseline">
                                                <a class="text-muted me-3 text-decoration-none" href="{{ route('/') }}">
                                                    {{ __('Já recebi o email') }}
                                                </a>

                                                <x-jet-button>
                                                    {{ __('Reenviar') }}
                                                </x-jet-button>
                                            </div>
                                        </div>
                                    </form>
                                    @if (Session::has('msg'))
                                        <div class="my-alert">
                                            {!! Alert::success(Session::get('msg')) !!}
                                        </div>
                                    @elseif(Session::has('error'))
                                        <div style="margin-top: 20px;">
                                            {!! Alert::danger(Session::get('error')) !!}
                                        </div>
                                        <div class="row" style="align-content: end">
                                            {!! Button::primary('Executar')->asLinkTo(route('clientes.index'))->addClass(['class'=>'estilo-btn']) !!}
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


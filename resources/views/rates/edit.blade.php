@extends('layouts.assina')

@section('conteudo')
    <div class="row align-items-center flex-column">
        <div id="assin-content">
            <div class="container-assin">
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-auto p-3">
                            <div class="panel-heading-assin">
                                <h5>Olá {{$cliente->nome}}</h5>
                            </div>
                            <div class="panel-body">
                                <div name="logo">
                                    <a href="{{route('/')}}"><x-jet-authentication-card-logo /></a>
                                </div>
                                <x-jet-validation-errors class="mb-3" />
                                <div class="card-body">
                                    <h3>Reavaliar</h3>
                                    <h6>Para nós a sua opinião é muito importante!</h6>
                                    <form method="POST" action="{{route('rates.update', ['rate' => $rate->id])}}">
                                        @method('PUT')
                                        @csrf
                                        <div class="mb-3">
                                            <x-jet-label value="{{ __('Assinante') }}" />
                                            <x-jet-input type="text" name="cliente" value="{{$cliente->nome}}" disabled="true" />
                                        </div>
                                        <input type="hidden" name="cliente_id" value="{{$cliente->id}}">
                                        <div class="mb-3">
                                            <x-jet-label value="{{ __('Sua nota: '.$rate->nota) }}" />
                                            <div class="estrelas">
                                                <label for="estrela_um"><i class="fa"></i></label>
                                                @if($rate->nota == 1)
                                                    <input type="radio" id="estrela_um_old" name="nota1" value="1" checked>
                                                @else
                                                    <input type="radio" id="estrela_um_old" name="nota1" value="1">
                                                @endif

                                                <label for="estrela_dois"><i class="fa"></i></label>
                                                @if($rate->nota == 2)
                                                    <input type="radio" id="estrela_dois_old" name="nota1" value="2" checked>
                                                @else
                                                    <input type="radio" id="estrela_dois_old" name="nota1" value="2">
                                                @endif

                                                <label for="estrela_tres"><i class="fa"></i></label>
                                                @if($rate->nota == 3)
                                                    <input type="radio" id="estrela_tres_old" name="nota1" value="3" checked>
                                                @else
                                                    <input type="radio" id="estrela_tres_old" name="nota1" value="3">
                                                @endif

                                                <label for="estrela_quatro"><i class="fa"></i></label>
                                                @if($rate->nota == 4)
                                                    <input type="radio" id="estrela_quatro_old" name="nota1" value="4" checked>
                                                @else
                                                    <input type="radio" id="estrela_quatro_old" name="nota1" value="4">
                                                @endif

                                                <label for="estrela_cinco"><i class="fa"></i></label>
                                                @if($rate->nota == 5)
                                                    <input type="radio" id="estrela_cinco_old" name="nota1" value="5" checked>
                                                @else
                                                    <input type="radio" id="estrela_cinco_old" name="nota1" value="5">
                                                @endif
                                            </div>
                                            <x-jet-label value="{{ __('Quer rever?') }}" />
                                            <div class="estrelas">
                                                <input type="radio" id="vazio" name="nota" value="" checked>
                                                <label for="estrela_um"><i class="fa"></i></label>
                                                <input type="radio" id="estrela_um" name="nota" value="1">
                                                <label for="estrela_dois"><i class="fa"></i></label>
                                                <input type="radio" id="estrela_dois" name="nota" value="2">
                                                <label for="estrela_tres"><i class="fa"></i></label>
                                                <input type="radio" id="estrela_tres" name="nota" value="3">
                                                <label for="estrela_quatro"><i class="fa"></i></label>
                                                <input type="radio" id="estrela_quatro" name="nota" value="4">
                                                <label for="estrela_cinco"><i class="fa"></i></label>
                                                <input type="radio" id="estrela_cinco" name="nota" value="5"><br>
                                            </div>
                                            <x-jet-input-error for="nota"></x-jet-input-error>
                                        </div>
                                        <div class="mb-3">
                                            <x-jet-label value="{{ __('Título') }}" />

                                            <x-jet-input class="{{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                                                         value="{{$rate->title}}" required />
                                            <x-jet-input-error for="title"></x-jet-input-error>
                                        </div>
                                        <div class="mb-3">
                                            <x-jet-label value="{{ __('Comentário') }}" />

                                            <textarea cols="40" rows="7" name="texto" required type="textarea" maxlength="255">{{$rate->texto}}</textarea>
                                            <x-jet-input-error for="texto"></x-jet-input-error>
                                        </div>
                                        <div class="mb-0">
                                            <x-jet-button>
                                                {{ __('Reavaliar') }}
                                            </x-jet-button>
                                        </div>
                                    </form>
                                    {!! Button::primary('Sair')->asLinkTo(route('/'))->addClass(['class'=>'estilo-btn']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

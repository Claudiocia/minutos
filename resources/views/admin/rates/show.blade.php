@extends('layouts.admin')

@section('conteudo')
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div id="admin-content">
        <div class="container-admin">
            <div class="row">
                <div class="col-md-12">
                    <div class="w-auto p-3">
                        <div class="panel-heading-admin">
                            <h5>Avaliação do assinante {{ $rate->cliente->nome }}</h5>
                        </div>
                        <div class="panel-body">
                            <div class="row btn-new-reset">
                                {!! Button::primary('Voltar')->asLinkTo(route('admin.rates.index'))->addClass(['class'=>'estilo-btn']) !!}
                                {!! Button::primary('Editar')->asLinkTo(route('admin.rates.edit', ['rate' => $rate->id]))->addClass(['class'=>'estilo-btn']) !!}
                            </div>
                            <div class="row">
                                <div id="register-show">
                                    <div class="row bloco-div-show desk">
                                        <div class="nome">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Nome</h6>
                                            <div class="texto-show">
                                                {{ $rate->cliente->nome }}
                                            </div>
                                        </div>
                                        <div class="nome">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Email</h6>
                                            <div class="texto-show">
                                                {{ $rate->cliente->email }}
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row bloco-div-show desk">
                                        <div>
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Titulo</h6>
                                            <div class="texto-show">
                                                {{ $rate->title }}
                                            </div>
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Comentário</h6>
                                            <div class="texto-comment">
                                                {{$rate->texto}}
                                            </div>
                                        </div>
                                    </div>
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

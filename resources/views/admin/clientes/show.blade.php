@extends('layouts.admin')

@section('conteudo')
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div id="admin-content">
        <div class="container-admin">
            <div class="row">
                <div class="col-md-12">
                    <div class="w-auto p-3">
                        <div class="panel-heading-admin">
                            <h5>Detalhes do cliente {{ $cliente->nome }}</h5>
                        </div>
                        <div class="panel-body">
                            <div class="row btn-new-reset">
                                {!! Button::primary('Voltar')->asLinkTo(route('admin.clientes.index').'#assinante')->addClass(['class'=>'estilo-btn']) !!}
                                {!! Button::primary('Editar')->asLinkTo(route('admin.clientes.edit', ['cliente' => $cliente->id]))->addClass(['class'=>'estilo-btn']) !!}
                                {!! Button::primary('Enviar email')->asLinkTo(route('admin.clientes.lembrete', ['cliente' => $cliente->id]))->addClass(['class'=>'estilo-btn']) !!}
                                {!! Button::danger('Delete')
                                        ->asLinkTo(route('admin.clientes.destroy', ['cliente' => $cliente->id]))->addClass(['class'=>'estilo-btn'])
                                        ->addAttributes(['onclick' => 'event.preventDefault();document.getElementById("form-delete").submit();'])
                             !!}

                                <?php $formDelete = FormBuilder::plain([
                                    'id' => 'form-delete',
                                    'route' => ['admin.clientes.destroy', 'cliente' => $cliente->id],
                                    'method' => 'DELETE',
                                    'style' => 'display:none',
                                ]); ?>
                                {!! form($formDelete) !!}
                            </div>
                            <div class="row" id="assinante">
                                <div id="register-show">
                                    <div class="row bloco-div-show desk">
                                        <div class="nome">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Nome</h6>
                                            <div class="texto-show">
                                                {{ $cliente->nome }}
                                            </div>
                                        </div>
                                        <div class="nome">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Email</h6>
                                            <div class="texto-show">
                                                {{ $cliente->email }}
                                            </div>
                                        </div>
                                        <div class="nome">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Situação</h6>
                                            <div class="texto-show">
                                                @if($cliente->signed == 2)
                                                Inativo
                                                @else
                                                Ativo
                                                @endif
                                                --
                                                @if($cliente->validado == null)
                                                        Falta validar email
                                                    @else
                                                        Assinante com email validado
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    @if($cliente->review != null)
                                    <div class="row bloco-div-show desk">
                                        <div>
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Titulo</h6>
                                            <div class="texto-show">
                                                {{ $cliente->rate->title }}
                                            </div>
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Comentário</h6>
                                            <div class="texto-comment">
                                                {{$cliente->rate->texto}}
                                            </div>
                                        </div>
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
</div>
@endsection

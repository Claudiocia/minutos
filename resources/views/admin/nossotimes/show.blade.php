@extends('layouts.admin')

@section('conteudo')
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div id="admin-content">
        <div class="container-admin">
            <div class="row">
                <div class="col-md-12">
                    <div class="w-auto p-3">
                        <div class="panel-heading-admin">
                            <h5>Detalhes do colaborador {{ $nossotime->nome }}</h5>
                        </div>
                        <div class="panel-body">
                            <div class="row btn-new-reset">
                                {!! Button::primary('Voltar')->asLinkTo(route('admin.nossotimes.index').'#nossotime')->addClass(['class'=>'estilo-btn']) !!}
                                {!! Button::primary('Editar')->asLinkTo(route('admin.nossotimes.edit', ['nossotime' => $nossotime->id]))->addClass(['class'=>'estilo-btn']) !!}
                                {!! Button::danger('Delete')
                                        ->asLinkTo(route('admin.nossotimes.destroy', ['nossotime' => $nossotime->id]))->addClass(['class'=>'estilo-btn'])
                                        ->addAttributes(['onclick' => 'event.preventDefault();document.getElementById("form-delete").submit();'])
                             !!}

                                <?php $formDelete = FormBuilder::plain([
                                    'id' => 'form-delete',
                                    'route' => ['admin.nossotimes.destroy', 'nossotime' => $nossotime->id],
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
                                                {{ $nossotime->nome }}
                                            </div>
                                        </div>
                                        <div class="nome">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Situação</h6>
                                            <div class="texto-show">
                                                @if($nossotime->ativo == 'n')
                                                Inativo
                                                @else
                                                Ativo
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div>
                                        <h6 class="block font-medium text-sm text-gray-700 label-show">Texto</h6>
                                        <div class="texto-comment" style="margin: 10px;">
                                            {!! $nossotime->texto !!}
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

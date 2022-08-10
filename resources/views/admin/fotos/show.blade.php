@extends('layouts.admin')

@section('conteudo')

    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div id="admin-content">
            <div class="container-admin">
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-auto p-3">
                            <div class="panel-heading-admin">
                                <h5>Detalhes da foto</h5>
                            </div>
                            <div class="panel-body">
                                <div class="row btn-new-reset">
                                    <?php $formDelete = FormBuilder::plain([
                                        'id' => 'form-delete',
                                        'route' => ['admin.fotos.destroy', 'foto' => $foto->id],
                                        'method' => 'DELETE',
                                        'style' => 'display:none',
                                    ]); ?>
                                    {!! form($formDelete) !!}
                                </div>
                                <div class="row">
                                    <div id="register-show">
                                        <div class="row image-show">
                                            <div class="col-4">
                                                <img src="{{asset($foto->foto_path)}}" >
                                            </div>
                                            <div class="col-8">
                                                <div class="nome-foto">
                                                    <h6 class="block font-medium text-sm text-gray-700 label-show">Nome</h6>
                                                    <div class="texto-show">
                                                        {{ $foto->origin_name }}
                                                    </div>
                                                </div>
                                                <div class="nome-foto">
                                                    <h6 class="block font-medium text-sm text-gray-700 label-show">Legenda</h6>
                                                    <div class="texto-show">
                                                        {{ $foto->legenda }}
                                                    </div>
                                                </div>
                                                <div class="nome-foto">
                                                    <h6 class="block font-medium text-sm text-gray-700 label-show">Crédito</h6>
                                                    <div class="texto-show">
                                                        {{$foto->credito}}
                                                    </div>
                                                </div>
                                                <div class="nome-foto">
                                                    <h6 class="block font-medium text-sm text-gray-700 label-show">Aplicação</h6>
                                                    <div class="texto-show">
                                                        {{$foto->using}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row button-show">
                                            <div class="col-4">
                                                {!! Button::primary('Voltar')->asLinkTo(route('admin.fotos.index'))->addClass(['class'=>'btn-show']) !!}
                                            </div>
                                            <div class="col-4">
                                                {!! Button::primary('Editar')->asLinkTo(route('admin.fotos.edit', ['foto' => $foto->id]))->addClass(['class'=>'btn-show']) !!}
                                            </div>
                                            <div class="col-4">
                                                {!! Button::danger('Delete')
                                                    ->asLinkTo(route('admin.fotos.destroy', ['foto' => $foto->id]))->addClass(['class'=>'btn-show'])
                                                    ->addAttributes(['onclick' => 'event.preventDefault();document.getElementById("form-delete").submit();'])
                                         !!}
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

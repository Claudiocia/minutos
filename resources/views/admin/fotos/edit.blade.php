@extends('layouts.admin')

@section('conteudo')

    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div id="admin-content">
            <div class="container-admin">
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-auto p-3">
                            <div class="panel-heading-admin">
                                <h5>Editar Informções da foto</h5>
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
                                        <div class="row button-show">
                                            <div class="col-4">
                                                {!! Button::primary('Sair')->asLinkTo(route('admin.fotos.index'))->addClass(['class'=>'btn-show']) !!}
                                            </div>
                                            <div class="col-4">
                                                {!! Button::primary('Voltar')->asLinkTo(route('admin.fotos.show', ['foto' => $foto->id]))->addClass(['class'=>'btn-show']) !!}
                                            </div>
                                            <div class="col-4">
                                                {!! Button::danger('Delete')
                                                    ->asLinkTo(route('admin.fotos.destroy', ['foto' => $foto->id]))->addClass(['class'=>'btn-show'])
                                                    ->addAttributes(['onclick' => 'event.preventDefault();document.getElementById("form-delete").submit();'])
                                         !!}
                                            </div>
                                        </div>
                                </div>
                                <div class="row">
                                    <div id="register-show">
                                        <div class="row image-show">
                                            <div class="col-4">
                                                <img src="{{asset($foto->foto_path)}}" >
                                            </div>
                                            <div class="col-8 form-edit-foto">
                                                <div class="nome-foto">
                                                    <h6 class="block label-form">Nome</h6>
                                                    <div class="texto-show">
                                                        {{ $foto->origin_name }}
                                                    </div>
                                                </div>
                                                <?php $icon = '<i class="fas fa-save"></i>'; ?>
                                                {!!
                                                    form($form->add('salvar', 'submit', [
                                                        'attr' => ['class' => 'btn btn-primary btn-block estilo-btn', 'style' => 'width:220px'],
                                                        'label' => $icon.' Salvar Alterações'
                                                        ]),['class' => 'teste'])
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

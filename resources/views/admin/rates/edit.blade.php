@extends('layouts.admin')

@section('conteudo')
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div id="admin-content">
        <div class="container-admin">
            <div class="row">
                <div class="col-md-12">
                    <div class="w-auto p-3">
                        <div class="panel-heading-admin">
                            <h5>Editar Avaliação</h5>
                        </div>
                        <div class="panel-body">
                            <div class="row btn-new-reset">
                                {!! Button::primary('Voltar')->asLinkTo(route('admin.users.index').'#rate') !!}
                            </div>
                            <div class="form-admin">
                                {!!
                                    form($form->add('salvar', 'submit', [
                                        'attr' => ['class' => 'btn btn-primary btn-block', 'style' => 'width:120px'],
                                        'label' => 'Atualizar'
                                        ]))
                                 !!}
                            </div>
                            <div class="row btn-new-reset">
                                {!! Button::primary('Voltar')->asLinkTo(route('admin.users.index').'#rate') !!}
                            </div>
                        </div>
                        </div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection

@extends('layouts.admin')

@section('conteudo')
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div id="admin-content">
        <div class="container-admin">
            <div class="row">
                <div class="col-md-12">
                    <div class="w-auto p-3">
                        <div class="panel-heading-admin">
                            <h5>Perfil do usuário {{ $user->name }}</h5>
                        </div>
                        <div class="panel-body">
                            <div class="row btn-new-reset">
                                {!! Button::primary('Voltar')->asLinkTo(route('admin.users.index'))->addClass(['class'=>'estilo-btn']) !!}
                                {!! Button::primary('Editar')->asLinkTo(route('admin.users.edit', ['user' => $user->id]))->addClass(['class'=>'estilo-btn']) !!}
                                {!! Button::danger('Delete')
                                        ->asLinkTo(route('admin.users.destroy', ['user' => $user->id]))->addClass(['class'=>'estilo-btn'])
                                        ->addAttributes(['onclick' => 'event.preventDefault();document.getElementById("form-delete").submit();'])
                             !!}

                                <?php $formDelete = FormBuilder::plain([
                                    'id' => 'form-delete',
                                    'route' => ['admin.users.destroy', 'user' => $user->id],
                                    'method' => 'DELETE',
                                    'style' => 'display:none',
                                ]); ?>
                                {!! form($formDelete) !!}
                            </div>
                            <div class="row">
                                <div id="register-show">
                                    <div class="row bloco-div-show desk">
                                        <div class="nome">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Nome</h6>
                                            <div class="texto-show">
                                                {{ $user->name }}
                                            </div>
                                        </div>
                                        <div class="nome">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Email</h6>
                                            <div class="texto-show">
                                                {{ $user->email }}
                                            </div>
                                        </div>
                                        <div class="nome">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Função</h6>
                                            <div class="texto-show">
                                                @if($user->role == 2)
                                                Administrador
                                                @else
                                                Não é Administrador
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
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

@extends('layouts.admin')
@section('conteudo')
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div id="admin-content">
            <div class="container-admin">
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-auto p-3">
                            <div class="panel-heading-admin">
                                <h5>Lista de Assinantes</h5>
                                <div class="form-search">
                                    <form action="{{ route('admin.clientes.index') }}" method="get">
                                        <label class="label-search">Pesquisar</label>
                                        <x-jet-input id="search" class="mt-1 w-full" type="search" name="search"/>
                                        <div class="nome" style="margin-top: 5px;">
                                            <x-jet-label for="inativos" value="{{ __('Buscar: ') }}" />
                                            <input type="radio" name="search" value="ativo"/> Ativo
                                            <input type="radio" name="search" value="inativo"/> Inativo
                                        </div>
                                        <div class="buton-search">
                                            <x-jet-button class="ml-4 buton-sch">
                                                {{ __('Pesquisar') }}
                                            </x-jet-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row btn-new-reset">
                                    {!! Button::primary('Novo')->asLinkTo(route('admin.clientes.create'))->addClass(['class'=>'estilo-btn']) !!}
                                    {!! Button::primary('Limpar')->asLinkTo(route('admin.clientes.index'))->addClass(['class'=>'estilo-btn']) !!}
                                </div>
                                <div class="row" style="margin-left: 10px; margin-right: 10px;">
                                    {!!
                                        Table::withContents($clientes)->striped()
                                        ->callback('Actions', function ($field, $cliente){
                                            $linkEdit = route('admin.clientes.edit', ['cliente' => $cliente->id]);
                                            $linkShow = route('admin.clientes.show', ['cliente' => $cliente->id]);
                                            return \Bootstrapper\Facades\Button::LINK('<i class="fas fa-pencil-alt"></i>')->asLinkTo($linkEdit)." | ".
                                            \Bootstrapper\Facades\Button::LINK('<i class="fas fa-eye"></i>')->asLinkTo($linkShow);
                                        })
                                    !!}
                                </div>
                            </div>
                        </div>
                        {{ $clientes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

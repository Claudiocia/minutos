@extends('layouts.admin')

@section('conteudo')
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div id="admin-content">
            <div class="container-admin">
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-auto p-3">
                            <div class="panel-heading-admin">
                                <h5>Editorias</h5>
                                <div class="form-search">
                                    <form action="{{ route('admin.retrancas.index') }}" method="get">
                                        <label class="label-search">Pesquisar</label>
                                        <x-jet-input id="search" class="mt-1 w-full" type="search" name="search"/>
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
                                    {!! Button::primary('Novo')->asLinkTo(route('admin.retrancas.create'))->addClass(['class'=>'estilo-btn']) !!}
                                    {!! Button::primary('Limpar')->asLinkTo(route('admin.retrancas.index'))->addClass(['class'=>'estilo-btn']) !!}
                                </div>
                                <div class="row" style="margin-left: 10px; margin-right: 10px;">
                                    {!!
                                        Table::withContents($retrancas)->striped()
                                        ->callback('Actions', function ($field, $retranca){
                                            $linkEdit = route('admin.retrancas.edit', ['retranca' => $retranca->id]);
                                            $linkDelete = route('admin.retrancas.apagar', ['id' => $retranca->id]);
                                            return \Bootstrapper\Facades\Button::LINK('<i class="fas fa-pencil-alt"></i>')->asLinkTo($linkEdit)." | ".
                                            \Bootstrapper\Facades\Button::LINK('<i class="fas fa-trash"></i>')->asLinkTo($linkDelete);
                                        })
                                    !!}

                                </div>
                            </div>
                        </div>
                        {{ $retrancas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style type="text/css">
        table > thead > tr > th:nth-child(2){
            width: 70%;
        }
    </style>
@endpush

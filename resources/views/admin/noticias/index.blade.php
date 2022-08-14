@extends('layouts.admin')


@section('conteudo')
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div id="admin-content">
            <div class="container-admin">
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-auto p-3">
                            <div class="panel-heading-admin">
                                <h5>Notícias</h5>
                                <div class="form-search">
                                    <form action="{{ route('admin.noticias.index') }}" method="get">
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
                                <div class="row btn-new-reset" id="noticia">
                                    {!! Button::primary('Nova')->asLinkTo(route('admin.noticias.create'))->addClass(['class'=>'estilo-btn']) !!}
                                    {!! Button::primary('Limpar')->asLinkTo(route('admin.noticias.index').'#noticia')->addClass(['class'=>'estilo-btn']) !!}
                                </div>
                                <div class="row" style="margin-left: 10px; margin-right: 10px;">
                                    {!!
                                        Table::withContents($noticias)->striped()
                                        ->callback('Actions', function ($field, $noticia){
                                            $linkEdit = route('admin.noticias.edit', ['noticia' => $noticia->id]);
                                            $linkShow = route('admin.noticias.show', ['noticia' => $noticia->id]);
                                            $linkFoto = route('admin.noticias.photorel', ['noticia' => $noticia->id]);
                                            return \Bootstrapper\Facades\Button::LINK('<i class="fas fa-pencil-alt"></i>')->asLinkTo($linkEdit)."|".
                                            \Bootstrapper\Facades\Button::LINK('<i class="fas fa-eye"></i>')->asLinkTo($linkShow)."|".
                                            \Bootstrapper\Facades\Button::LINK('<i class="fas fa-image"></i>')->asLinkTo($linkFoto);
                                        })
                                    !!}
                                </div>
                            </div>
                        </div>
                        {{ $noticias->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style type="text/css">
        table > thead > tr > th:nth-child(5){
            text-align: center;
        }
        table > thead > tr > th:nth-child(2){
            width: 40%;
        }
    </style>
@endpush

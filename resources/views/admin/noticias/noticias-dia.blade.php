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
                                    <form action="{{ route('admin.noticias.noticias-dia') }}" method="get">
                                        <label class="label-search">Pesquisar</label>
                                        <x-jet-input id="search" class="mt-1 w-full" type="search" name="search" placeholder="digite parte do titulo"/>
                                        <div class="nome" style="margin-top: 5px;">
                                            <x-jet-label for="noticias" value="{{ __('Buscar: ') }}" />
                                            <input type="radio" name="public" value="s"/> Publicada
                                            <input type="radio" name="public" value="n"/> Não Publicada
                                        </div>
                                        <div class="input-group mt-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="editoria">Editoria</label>
                                            </div>
                                            <select class="custom-select" id="editoria" name="editoria">
                                                <option selected value="">Escolher...</option>
                                                @foreach($editorias as $editoria)
                                                <option value="{{$editoria->id}}">{{$editoria->nome}}</option>
                                                @endforeach
                                            </select>
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
                                <div class="row btn-new-reset" id="noticia">
                                    {!! Button::primary('Nova')->asLinkTo(route('admin.noticias.create'))->addClass(['class'=>'estilo-btn']) !!}
                                    {!! Button::primary('Limpar')->asLinkTo(route('admin.noticias.noticias-dia').'#noticia')->addClass(['class'=>'estilo-btn']) !!}
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

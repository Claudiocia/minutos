@extends('layouts.admin')


@section('conteudo')
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div id="admin-content">
            <div class="container-admin">
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-auto p-3">
                            <div class="panel-heading-admin">
                                <h5>Newsletters</h5>
                                <div class="form-search">
                                    <form action="{{ route('admin.newsletters.index') }}" method="get">
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
                                    {!! Button::primary('Nova')->asLinkTo(route('admin.newsletters.create'))->addClass(['class'=>'estilo-btn']) !!}
                                    {!! Button::primary('Limpar')->asLinkTo(route('admin.newsletters.index').'#newsletter')->addClass(['class'=>'estilo-btn']) !!}
                                </div>
                                <div class="row" style="margin-left: 10px; margin-right: 10px;">
                                    {!!
                                        Table::withContents($newsletters)->striped()
                                        ->callback('Actions', function ($field, $newsletter){
                                            $linkEdit = route('admin.newsletters.edit', ['newsletter' => $newsletter->id]);
                                            $linkShow = route('admin.newsletters.show', ['newsletter' => $newsletter->id]);
                                            $linkFoto = route('admin.newsletters.photorel', ['newsletter' => $newsletter->id]);
                                            $linkEnvi = route('admin.newsletters.sendmail', ['newsletter' => $newsletter->id]);
                                            if ($newsletter->enviada == 'n'){
                                                return \Bootstrapper\Facades\Button::LINK('<i class="fas fa-pencil-alt"></i>')->asLinkTo($linkEdit)."|".
                                                    \Bootstrapper\Facades\Button::LINK('<i class="fas fa-eye"></i>')->asLinkTo($linkShow)."|".
                                                    \Bootstrapper\Facades\Button::LINK('<i class="fas fa-image"></i>')->asLinkTo($linkFoto)."|".
                                                    \Bootstrapper\Facades\Button::LINK('<i class="fa-solid fa-share"></i>')->asLinkTo($linkEnvi);
                                            }
                                            else {
                                                return \Bootstrapper\Facades\Button::LINK('<i class="fas fa-pencil-alt"></i>')->asLinkTo($linkEdit)."|".
                                                    \Bootstrapper\Facades\Button::LINK('<i class="fas fa-eye"></i>')->asLinkTo($linkShow)."|".
                                                    \Bootstrapper\Facades\Button::LINK('<i class="fas fa-image"></i>')->asLinkTo($linkFoto);
                                            }
                                        })
                                    !!}
                                </div>
                            </div>
                        </div>
                        {{ $newsletters->links() }}
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

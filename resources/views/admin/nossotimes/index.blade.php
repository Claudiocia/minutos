@extends('layouts.admin')
@section('conteudo')
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div id="admin-content">
            <div class="container-admin">
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-auto p-3">
                            <div class="panel-heading-admin">
                                <h5>Lista de Colaboradores</h5>
                                <div class="form-search">
                                    <form action="{{ route('admin.nossotimes.index') }}" method="get">
                                        <label class="label-search">Pesquisar</label>
                                        <x-jet-input id="search" class="mt-1 w-full" type="search" name="search"/>
                                        <div class="nome" style="margin-top: 5px;">
                                            <x-jet-label for="inativos" value="{{ __('Buscar: ') }}" />
                                            <input type="radio" name="search" value="ativo"/> Ativo
                                            <input type="radio" name="search" value="inativo"/> Inativo
                                            <input type="radio" name="search" value="cancelado"/> Cancelado
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
                                <div class="row btn-new-reset" id="assinante">
                                    {!! Button::primary('Novo')->asLinkTo(route('admin.nossotimes.create'))->addClass(['class'=>'estilo-btn']) !!}
                                    {!! Button::primary('Limpar')->asLinkTo(route('admin.nossotimes.index').'#nossotime')->addClass(['class'=>'estilo-btn']) !!}
                                </div>
                                <div class="row" style="margin-left: 10px; margin-right: 10px;">
                                    {!!
                                        Table::withContents($nossotimes)->striped()
                                        ->callback('Informações', function ($field, $nossotime){
                                            return MediaObject::withContents([
                                                'image' => asset($nossotime->foto->foto_path),
                                                'heading' => $nossotime->nome,
                                                'body' => $nossotime->funcao,
                                            ])->addClass(['mo-galeria']);
                                        })
                                        ->callback('Ações', function ($field, $nossotime){
                                            $linkEdit = route('admin.nossotimes.edit', ['nossotime' => $nossotime->id]);
                                            $linkShow = route('admin.nossotimes.show', ['nossotime' => $nossotime->id]);
                                            $linkFoto = route('admin.nossotimes.photorel', ['nossotime' => $nossotime->id]);
                                            return \Bootstrapper\Facades\Button::LINK('<i class="fas fa-pencil-alt"></i>')->asLinkTo($linkEdit)." | ".
                                            \Bootstrapper\Facades\Button::LINK('<i class="fas fa-eye"></i>')->asLinkTo($linkShow.'#nossotime')."|".
                                            \Bootstrapper\Facades\Button::LINK('<i class="fas fa-image"></i>')->asLinkTo($linkFoto);
                                        })
                                    !!}
                                </div>
                            </div>
                        </div>
                        {{ $nossotimes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

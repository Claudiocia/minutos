@extends('layouts.admin')

@section('conteudo')
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div id="admin-content">
        <div class="container-admin">
            <div class="row">
                <div class="col-md-12">
                    <div class="w-auto p-3">
                        <div class="panel-heading-admin">
                            <h5>Lista de fotos</h5>
                        </div>
                        <div class="panel-body">
                            <div class="row btn-new-reset">
                                {!! Button::primary('Novas Fotos')->asLinkTo(route('admin.fotos.create'))->addClass(['class'=>'estilo-btn']) !!}
                                {!! Button::primary('Limpar')->asLinkTo(route('admin.fotos.index'))->addClass(['class'=>'estilo-btn']) !!}
                            </div>
                            <div class="row" style="margin-left: 10px; margin-right: 10px;">
                                {!!
                                    Table::withContents($fotos->items())->striped()
                                    ->callback('Detalhes', function($field, $foto){
                                        return MediaObject::withContents([
                                            'image' => asset($foto->foto_thumb),
                                            'link' => asset($foto->foto_path),
                                            'heading' => $foto->using,
                                            'body' => $foto->origin_name.' - Crédito: '.$foto->credito,
                                            ])->addClass(['mo-galeria']);
                                    })
                                    ->callback('Actions', function ($field, $foto){
                                        $linkEdit = route('admin.fotos.edit', ['foto' => $foto->id]);
                                        $linkShow = route('admin.fotos.show', ['foto' => $foto->id]);
                                        return \Bootstrapper\Facades\Button::LINK('<i class="fas fa-eye"></i>')->asLinkTo($linkShow)." | ".
                                        \Bootstrapper\Facades\Button::LINK('<i class="fas fa-pencil-alt"></i>')->asLinkTo($linkEdit);
                                    })
                                !!}
                            </div>
                        </div>
                        </div>
                    {{ $fotos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

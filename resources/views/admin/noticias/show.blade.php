@extends('layouts.admin')

@section('conteudo')
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div id="admin-content">
        <div class="container-admin">
            <div class="row">
                <div class="col-md-12">
                    <div class="w-auto p-3">
                        <div class="panel-heading-admin">
                            <h5>{{ $noticia->title }}</h5>
                        </div>
                        <div class="panel-body">
                            <div class="row btn-new-reset">
                                {!! Button::primary('Voltar')->asLinkTo(route('admin.noticias.index'))->addClass(['class'=>'estilo-btn']) !!}
                                {!! Button::primary('Editar')->asLinkTo(route('admin.noticias.edit', ['noticia' => $noticia->id]))->addClass(['class'=>'estilo-btn']) !!}
                                {!! Button::danger('Delete')
                                        ->asLinkTo(route('admin.noticias.destroy', ['noticia' => $noticia->id]))->addClass(['class'=>'estilo-btn'])
                                        ->addAttributes(['onclick' => 'event.preventDefault();document.getElementById("form-delete").submit();'])
                             !!}

                                <?php $formDelete = FormBuilder::plain([
                                    'id' => 'form-delete',
                                    'route' => ['admin.noticias.destroy', 'noticia' => $noticia->id],
                                    'method' => 'DELETE',
                                    'style' => 'display:none',
                                ]); ?>
                                {!! form($formDelete) !!}
                            </div>
                            <div class="row">
                                <div id="register-show">
                                    <div class="row bloco-div-show desk">
                                        <div class="nome">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Editoria</h6>
                                            <div class="texto-show">
                                                {{ $noticia->retranca->nome }}
                                            </div>
                                        </div>
                                        <div class="nome">
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Fonte</h6>
                                            <div class="texto-comment">
                                                {{ $noticia->fonte }}
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Titulo</h6>
                                            <div class="texto-show">
                                                {{ $noticia->title }}
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Resumo</h6>
                                            <div class="texto-comment">
                                                {{ $noticia->resumo }}
                                            </div>
                                        </div>
                                        @if(count($noticia->fotos) != 0)
                                            <div>
                                                @foreach($noticia->fotos as $foto)
                                                    <img src="{{asset($foto->foto_path)}}" alt="" width="600px" />
                                            </div>
                                            <div class="label-form">
                                                Legenda: {{$foto->legenda}} - {{$foto->credito}}
                                            </div>
                                            @break
                                            @endforeach
                                        @endif
                                        <div>
                                            <h6 class="block font-medium text-sm text-gray-700 label-show">Texto</h6>
                                            <div class="texto-comment">
                                                {!! $noticia->texto !!}
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

@extends('layouts.admin')

@section('conteudo')
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div id="admin-content">
        <div class="container-admin">
            <div class="row">
                <div class="col-md-12">
                    <div class="w-auto p-3">
                        <div class="panel-heading-admin">
                            <div>
                                @if(count($newsletter->fotos) == 0)
                                <img src="{!! asset('site/img/sem_foto.png')!!}" width="220px">
                                @else

                                    @foreach($newsletter->fotos as $foto)
                                    <img src="{{$foto->foto_path}}" width="80px">
                                    @endforeach
                                @endif
                            </div>
                            <h5>Relacionar foto de Parceiro com Newsletter</h5>
                        </div>
                        <div class="panel-body">
                            <div class="row btn-new-reset">
                                {!! Button::primary('Voltar')->asLinkTo(route('admin.newsletters.index').'#newsletter') !!}
                            </div>
                            <div class="form-admin">
                                <div>
                                    @foreach($fotos as $foto)
                                        <img src="{{$foto->foto_path}}" width="120px">
                                    @endforeach
                                </div>
                                <?php $icon = '<i class="fas fa-save"></i>'; ?>
                                {!!
                                        form($form->add('salvar', 'submit', [
                                            'attr' => ['class' => 'btn btn-primary btn-block estilo-btn', 'style' => 'width:120px'],
                                            'label' => $icon.' Salvar'
                                         ]))
                                 !!}
                            </div>
                        </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

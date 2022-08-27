@extends('layouts.assina')


@section('conteudo')
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div id="admin-content">
            <div class="container-admin">
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-auto p-3">
                            <div class="panel-body">
                                <div class="row desk">
                                    <a href="{{route('/')}}"><x-marca-minutos class="icon-show"/></a>
                                </div>

                                <div class="row" style="margin-left: 10px; margin-right: 10px;">
                                    {!!Table::withContents($newsletters)->striped()
                                        ->callback('Abrir', function ($field, $newsletter){
                                            $linkShow = route('newsletters.show', ['newsletter' => $newsletter->id]);
                                            $linkVolt = route('/');
                                            return \Bootstrapper\Facades\Button::LINK('<i class="fas fa-eye"></i>')->asLinkTo($linkShow)." | ".
                                            \Bootstrapper\Facades\Button::LINK('<i class="fa-solid fa-arrow-rotate-left"></i>')->asLinkTo($linkVolt);
                                        })->ignore(['Enviada']) !!}
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


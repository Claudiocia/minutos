@extends('layouts.assina')

@section('conteudo')
    <div class="row align-items-center flex-column">
        <div id="assin-content">
            <div class="container-assin">
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-auto p-3">
                            <div class="panel-heading-assin">
                                <h5>Faça a sua assinatura 100% gratuita</h5>
                            </div>
                            <div class="panel-body">
                                <div name="logo">
                                    <a href="{{route('/')}}"><x-jet-authentication-card-logo /></a>
                                </div>
                                <div class="row">
                                        <?php $icon = '<i class="fas fa-pencil"></i>'; ?>
                                        {!!
                                             form($form->add('salvar', 'submit', [
                                                 'attr' => ['class' => 'btn btn-primary btn-block estilo-btn', 'style' => 'width:220px'],
                                                 'label' => $icon.' Assinar'
                                               ]),['class' => 'form-assin'])
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


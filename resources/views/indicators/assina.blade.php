@extends('layouts.assina')

@section('conteudo')
    <div class="row align-items-center flex-column">
        <div id="assin-content">
            <div class="container-assin">
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-auto p-3">
                            <div class="panel-heading-assin">
                                <h5><x-icon-minuteria class="icon-minuteria" /> Club Minuteria</h5>
                            </div>
                            <x-jet-validation-errors class="mb-3" />
                            <div class="panel-body">
                                <div name="logo">
                                    <a href="{{route('/')}}"><x-jet-authentication-card-logo /></a>
                                </div>
                                <div class="row">
                                    <h6>
                                        Para fazer parte do Club Minuteria, você precisa primeiro assinar a nossa
                                        newsletter.
                                    </h6>
                                    <h6>Preencha abaixo seu nome e seu melhor email. </h6>
                                    <h6>Tão logo você confirme o email já poderá fazer a inscrição no Club Minuteria e
                                        começar a acumular pontos.</h6>
                                </div>
                                <div class="row">
                                        <?php $icon = '<i class="fas fa-pencil"></i>'; ?>
                                        {!!
                                             form($form->add('salvar', 'submit', [
                                                 'attr' => ['class' => 'btn btn-primary btn-block estilo-btn', 'style' => 'width:220px'],
                                                 'label' => $icon.' Cadastrar'
                                               ]),['class' => 'form-assin'])
                                          !!}
                                    <div class="aviso">
                                        <p>Clique para conhecer a nossa <a href="{{route('policy.show')}}">Política de Privacidade</a>  e nosso <a href="{{route('terms.show')}}">Termos de Uso</a></p>
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


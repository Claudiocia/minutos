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
                                        Agora, que você já é um assinante do Canal Minutos, que tal trazer seus amigos para
                                        este seleto grupo.
                                    </h6>
                                    <h6>Crie um link personalizado e distribua. </h6>
                                    <h6>A cada 10 assinantes com o seu link, você ganha prêmios.</h6>
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
                                        <p><x-icon-relogio class="icon-minuteria" />Significado de Minuteria: (s.f.) Parte do mecanismo de um relógio que move os ponteiros</p>
                                        <h5>Como funciona o Club Minuteria:</h5>
                                        <ul>
                                            <li>Ao fazer a sua inscrição no Club Minuteria <x-icon-minuteria class="icon-minuteria" /> você ganha um <x-icon-link class="icon-minuteria" /> link exclusivo personalizado.</li>
                                            <li>Este link você pode compartilhar <x-icon-share class="icon-minuteria" /> via Whatsapp, Telegram, Facebook e ou qualquer rede social.</li>
                                            <li>Cada pessoa que se inscrever no Canal Minutos usando seu link, <x-icon-add class="icon-minuteria" /> credita 1 (um) ponto para seu saldo.</li>
                                            <li>Ao acumular pontos você se credencia a ganhar <x-icon-gift-box class="icon-minuteria" /> prêmios que variam de acordo com a quantidade de pontos.</li>
                                            <li>Quanto mais gente <x-icon-group-add class="icon-minuteria" /> se inscrever com o seu link, mais presentes você vai ganhar! <x-icon-gift-box-open class="icon-minuteria" /></li>

                                        </ul>

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


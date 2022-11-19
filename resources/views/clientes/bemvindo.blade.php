@extends('layouts.assina')

@section('conteudo')
    <div class="row align-items-center flex-column">
        <div id="assin-content">
            <div class="container-assin">
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-auto p-3">
                            <div class="panel-heading-assin">
                                <h5>Confirme o seu e-mail</h5>
                            </div>
                            <div class="panel-body">
                                <div name="logo">
                                    <a href="{{route('/')}}"><x-jet-authentication-card-logo /></a>
                                </div>
                                <div class="row">
                                        <div class="row cliente">
                                            <h5>Parabéns, {{$cliente->nome ?? ''}}</h5>
                                        </div>
                                    <div class="row cliente">
                                        <p class="cliente-textos-just">
                                            Você agora faz parte do grupo das pessoas mais bem informadas
                                            sobre os fatos essenciais do dia.
                                            Para concluir sua inscrição, enviamos uma mensagem para o seu endereço de e-mail.
                                            Caso não esteja na caixa de entrada verifique na lista de spam
                                            ou lixo eletrônico. Marque o <span class="font-bold">Canal Minutos</span> como confiável.
                                            Confirme o seu endereço, para começar a receber
                                            gratuitamente as nossas newsletters.
                                        </p>
                                        <p>Caso não receba o e-mail de validação nos próximos 10 minutos,
                                            solicite o reenvio</p>
                                        <p>Obrigado!</p>
                                    </div>
                                    <div class="row cliente">
                                        @if($newsletter != null)
                                        <h5>Leia agora a nossa edição mais recente. <a href="{{route('newsletters.show', ['newsletter' => $newsletter->id])}}">Clique aqui</a></h5>
                                        @endif
                                    </div>
                                    @if (Session::has('msg'))
                                        <div class="my-alert">
                                            {!! Alert::success(Session::get('msg')) !!}
                                        </div>
                                    @elseif(Session::has('error'))
                                        <div>
                                            {!! Alert::danger(Session::get('error')) !!}
                                        </div>
                                        <div class="row">
                                            {!! Button::primary('Reenviar')->asLinkTo(route('clientes.create'))->addClass(['class'=>'estilo-btn']) !!}
                                        </div>
                                    @endif
                                    <div class="aviso">
                                        <p>Para solicitar o reenvio do e-mail de validação <a href="{{route('clientes.create')}}"> clique aqui</a></p>
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


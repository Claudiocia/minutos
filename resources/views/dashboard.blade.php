<x-app-layout>
    <x-slot name="header">
        <x-marca-minutos height="30"></x-marca-minutos>
    </x-slot>
    <x-jet-welcome >
        <x-slot name="card1">
            <div class="d-flex flex-row bd-highlight mb-3">
                <div>
                    <x-icon-group height="30" fill="#41a7d7" />
                </div>
                <div class="ps-3">
                    <div class="mb-2">
                        <a href="#" class="h5 font-weight-bolder text-decoration-none text-dark">Assinantes</a>
                    </div>
                    <p class="text-muted">
                        Atualmente contamos com <strong>{{$numassin}}</strong> assinantes ativos. Nossa meta atual é chegar
                        aos <strong>1.000</strong> (mil assinantes ativos). Para isso vamos usar estratégias de marketing digital.
                    </p>
                    <a href="#" class="text-decoration-none">
                        <div class="mt-3 d-flex align-content-center font-weight-bold text-primary">
                            <div>Veja mais sobre nossos assinantes</div>

                            <div class="ms-1 text-primary">
                                <svg viewBox="0 0 20 20" fill="currentColor" width="16" class="arrow-right w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </x-slot>
        <x-slot name="card2">
            <div class="card-body border-bottom p-3 h-100">
                <div class="d-flex flex-row bd-highlight mb-3">
                    <div>
                        <x-icon-grafico height="30" fill="#41a7d7" />
                    </div>
                    <div class="ps-3">
                        <div class="mb-2">
                            <a href="#" class="h5 font-weight-bolder text-decoration-none text-dark">Estatísticas</a>
                        </div>
                        <p class="text-muted">
                            Nossa taxa de abertura de emails atualmente está em <strong>100%</strong>. Precisamos nos manter
                            desta forma, lembrando que quanto mais a gente cresce, mais duro teremos que trabalhar para manter esta taxa de abertura.
                        </p>
                        <a href="#" class="text-decoration-none">
                            <div class="mt-3 d-flex align-content-center font-weight-bold text-primary">
                                <div>Veja mais dados sobre o engajamento dos assinantes</div>

                                <div class="ms-1 text-primary">
                                    <svg viewBox="0 0 20 20" fill="currentColor" width="16" class="arrow-right w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="card3">
            <div class="card-body border-right p-3 h-100">
                <div class="d-flex flex-row bd-highlight mb-3">
                    <div>
                        <x-icon-newsletter height="30" fill="#41a7d7" />
                    </div>
                    <div class="ps-3">
                        <div class="mb-2">
                            <a href="#" class="h5 font-weight-bolder text-decoration-none text-dark">Newsletters</a>
                        </div>
                        <p class="text-muted">
                            Aqui vamos colocar dados estatísticos das Newsletters tipo: taxa de abertura, taxa de cliques em links, e outras medições realmente interessantes para o desenvolvimento do trabalho. Em breve teremos a implantação disto, assim que o envio da news passar a ser no mailchimp.
                        </p>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="card4">
            <div class="card-body p-3 h-100">
                <div class="d-flex flex-row bd-highlight mb-3">
                    <div>
                        <x-icon-satisfaction height="30" fill="#41a7d7" />
                    </div>
                    <div class="ps-3">
                        <div class="mb-2">
                            <span class="h5 font-weight-bolder text-decoration-none text-dark">Avaliações</span>
                        </div>
                        <p class="text-muted">
                            Authentication and registration views are included with Laravel Jetstream, as well as support for user email verification and resetting forgotten passwords. So, you're free to get started what matters most: building your application.
                        </p>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-jet-welcome>
</x-app-layout>

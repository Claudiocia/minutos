<x-app-layout>
    <x-slot name="header">
        <x-marca-minutos height="30"></x-marca-minutos>
    </x-slot>
    <x-jet-welcome >
        <x-slot name="card1">
            <div class="d-flex flex-row bd-highlight mb-3">
                <div>
                    <svg fill="none" stroke="#41a7d7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="text-muted" width="32"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
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
                        <svg fill="none" stroke="#41a7d7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="text-muted" width="32"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
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
                        <svg fill="none" stroke="#41a7d7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="text-muted" width="32"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="ps-3">
                        <div class="mb-2">
                            <a href="#" class="h5 font-weight-bolder text-decoration-none text-dark">Newsletters</a>
                        </div>
                        <p class="text-muted">
                            teste Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.
                        </p>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="card4">
            <div class="card-body p-3 h-100">
                <div class="d-flex flex-row bd-highlight mb-3">
                    <div>
                        <svg fill="none" stroke="#41a7d7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="text-muted" width="32"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
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

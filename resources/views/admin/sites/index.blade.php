@extends('layouts.admin')
@section('conteudo')
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <div id="admin-content">
            <div class="container-admin">
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-auto p-3">
                            <div class="panel-heading-admin">
                                <h5>Adm. conteúdo Landpage</h5>
                                <div class="form-search">
                                    <form action="{{ route('admin.nossotimes.index') }}" method="get">
                                        <label class="label-search">Pesquisar</label>
                                        <x-jet-input id="search" class="mt-1 w-full" type="search" name="search"/>
                                        <div class="nome" style="margin-top: 5px;">
                                            <x-jet-label for="inativos" value="{{ __('Buscar: ') }}" />
                                            <input type="radio" name="search" value="ativo"/> Ativo
                                            <input type="radio" name="search" value="inativo"/> Inativo
                                            <input type="radio" name="search" value="cancelado"/> Cancelado
                                        </div>
                                        <div class="buton-search">
                                            <x-jet-button class="ml-4 buton-sch">
                                                {{ __('Pesquisar') }}
                                            </x-jet-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row" style="margin-left: 10px; margin-right: 10px;">
                                    <x-jet-validation-errors class="mb-3" />
                                    <!-- Tabs -->
                                    <ul class="nav nav-pills mb-3">
                                        @foreach($tabs as $tab)
                                            <li>
                                                <a class="nav-link minha-tab" data-bs-toggle="pill" href="#{{$tab['link']}}">{!! $tab['title'] !!}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <!-- Tab Content -->
                                    <div class="tab-content">
                                        @foreach($tabs as $tab)
                                            @if($tab['link'] == 'site')
                                                <div class="tab-pane fade show minha-tab active" id="{!!$tab['link']!!}">
                                                    <h5>Formulário - Cadastro / Edição do {{$tab['title']}}</h5>
                                                    <div class="form-admin">
                                                        <?php $icon = '<i class="fas fa-save"></i>'; ?>
                                                        {!!
                                                                form($formSite->add('salvar', 'submit', [
                                                                    'attr' => ['class' => 'btn btn-primary btn-block estilo-btn', 'style' => 'width:120px'],
                                                                    'label' => $icon.' Salvar'
                                                                 ]))
                                                         !!}
                                                    </div>
                                                </div>
                                            @elseif($tab['link'] == 'abertura')
                                                <div class="tab-pane fade show" id="{!!$tab['link']!!}">
                                                    <h5>Formulário - Cadastro e Edição -- {{$tab['title']}}</h5>
                                                    <div class="form-admin">
                                                        <?php $icon = '<i class="fas fa-save"></i>'; ?>
                                                        {!!
                                                                form($formAbert->add('salvar', 'submit', [
                                                                    'attr' => ['class' => 'btn btn-primary btn-block estilo-btn', 'style' => 'width:120px'],
                                                                    'label' => $icon.' Salvar'
                                                                 ]))
                                                         !!}
                                                    </div>
                                                </div>
                                            @elseif($tab['link'] == 'razion')
                                                <div class="tab-pane fade show" id="{!!$tab['link']!!}">
                                                    <h5>Lista -- {{$tab['title']}}</h5>
                                                    <div class="row btn-new-reset" id="assinante">
                                                        {!! Button::primary('Novo')->asLinkTo(route('admin.razions.create'))->addClass(['class'=>'estilo-btn']) !!}
                                                        {!! Button::primary('Limpar')->asLinkTo(route('admin.sites.index').'#razion')->addClass(['class'=>'estilo-btn']) !!}
                                                    </div>
                                                    <div class="row" style="margin-left: 10px; margin-right: 10px;">
                                                        {!!
                                                            Table::withContents($razions)->striped()
                                                            ->callback('Informações', function ($field, $razion){
                                                                return MediaObject::withContents([
                                                                    'image' => asset('site/icones/'.$razion->color.$razion->icon),
                                                                    'heading' => $razion->title,
                                                                    'body' => $razion->texto,
                                                                ])->addClass(['mo-galeria']);
                                                            })
                                                            ->callback('Ações', function ($field, $razion){
                                                                $linkEdit = route('admin.razions.edit', ['razion' => $razion->id]);
                                                                $linkShow = route('admin.razions.show', ['razion' => $razion->id]);
                                                                return \Bootstrapper\Facades\Button::LINK('<i class="fas fa-pencil-alt"></i>')->asLinkTo($linkEdit)." | ".
                                                                \Bootstrapper\Facades\Button::LINK('<i class="fas fa-eye"></i>')->asLinkTo($linkShow.'#razion');
                                                            })
                                                        !!}
                                                    </div>
                                                </div>
                                            @elseif($tab['link'] == 'causa')
                                                <div class="tab-pane fade show" id="{!!$tab['link']!!}">
                                                    <h5>Formulário - Cadastro e Edição -- {{$tab['title']}}</h5>
                                                    <div class="form-admin">
                                                        <?php $icon = '<i class="fas fa-save"></i>'; ?>
                                                        {!!
                                                                form($formCausa->add('salvar', 'submit', [
                                                                    'attr' => ['class' => 'btn btn-primary btn-block estilo-btn', 'style' => 'width:120px'],
                                                                    'label' => $icon.' Salvar'
                                                                 ]))
                                                         !!}
                                                    </div>
                                                </div>
                                            @elseif($tab['link'] == 'avalia')
                                                <div class="tab-pane fade show" id="{!!$tab['link']!!}">
                                                    <h5>Formulário - Cadastro e Edição -- {{$tab['title']}}</h5>
                                                    <div class="form-admin">
                                                        <?php $icon = '<i class="fas fa-save"></i>'; ?>
                                                        {!!
                                                                form($formAvalia->add('salvar', 'submit', [
                                                                    'attr' => ['class' => 'btn btn-primary btn-block estilo-btn', 'style' => 'width:120px'],
                                                                    'label' => $icon.' Salvar'
                                                                 ]))
                                                         !!}
                                                    </div>
                                                </div>
                                            @elseif($tab['link'] == 'cta')
                                                <div class="tab-pane fade show" id="{!!$tab['link']!!}">
                                                    <h5>Formulário - Cadastro e Edição -- {{$tab['title']}}</h5>
                                                    <div class="form-admin">
                                                        <?php $icon = '<i class="fas fa-save"></i>'; ?>
                                                        {!!
                                                                form($formCta->add('salvar', 'submit', [
                                                                    'attr' => ['class' => 'btn btn-primary btn-block estilo-btn', 'style' => 'width:120px'],
                                                                    'label' => $icon.' Salvar'
                                                                 ]))
                                                         !!}
                                                    </div>
                                                </div>
                                            @elseif($tab['link'] == 'footer')
                                                <div class="tab-pane fade show" id="{!!$tab['link']!!}">
                                                    <h5>Formulário - Cadastro e Edição -- {{$tab['title']}}</h5>
                                                    <div class="form-admin">
                                                        <?php $icon = '<i class="fas fa-save"></i>'; ?>
                                                        {!!
                                                                form($formFooter->add('salvar', 'submit', [
                                                                    'attr' => ['class' => 'btn btn-primary btn-block estilo-btn', 'style' => 'width:120px'],
                                                                    'label' => $icon.' Salvar'
                                                                 ]))
                                                         !!}
                                                    </div>
                                                </div>
                                            @elseif($tab['link'] == 'imagens')
                                                <div class="tab-pane fade show" id="{!!$tab['link']!!}">
                                                    <h5>Formulário - Cadastro e Edição -- {{$tab['title']}}</h5>
                                                    <div class="form-admin">
                                                        <?php $icon = '<i class="fas fa-save"></i>'; ?>
                                                        {!!
                                                                form($formFoto->add('salvar', 'submit', [
                                                                    'attr' => ['class' => 'btn btn-primary btn-block estilo-btn', 'style' => 'width:120px'],
                                                                    'label' => $icon.' Salvar'
                                                                 ]))
                                                         !!}
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
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

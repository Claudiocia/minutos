<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand me-4" href="/">
            <x-jet-application-mark width="36" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            @auth
            <ul class="navbar-nav me-auto">
                <x-jet-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Inicial') }}
                </x-jet-nav-link>
                <x-jet-nav-link href="{{ route('admin.sites.index') }}" :active="request()->routeIs('admin.sites.index')">
                    {{ __('Site') }}
                </x-jet-nav-link>
                <x-jet-dropdown id="dropdown-colab">
                    <x-slot name="trigger">
                        Nosso Time
                        <svg class="ms-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </x-slot>
                    <x-slot name="content">
                        <h6 class="dropdown-header small text-muted">
                            {{ __('Gerencia de Colab.') }}
                        </h6>
                        <x-jet-dropdown-link href="{{ route('admin.users.index').'#user' }}" :active="request()->routeIs('admin.users.index')" >
                            {{ __('Usuários') }}
                        </x-jet-dropdown-link>
                        <hr class="dropdown-divider">
                        <x-jet-dropdown-link href="{{ route('admin.nossotimes.index').'#nossotime' }}" :active="request()->routeIs('admin.nossotime.index')">
                            {{ __('Nosso Time') }}
                        </x-jet-dropdown-link>
                        <hr class="dropdown-divider">
                    </x-slot>
                </x-jet-dropdown>
                <x-jet-nav-link href="{{ route('admin.fotos.index') }}" :active="request()->routeIs('admin.fotos.index')">
                    {{ __('Gerenc. Fotos') }}
                </x-jet-nav-link>
                <x-jet-nav-link href="{{ route('admin.clientes.index').'#assinante' }}" :active="request()->routeIs('admin.clientes.index')">
                    {{ __('Assinantes') }}
                </x-jet-nav-link>
                <x-jet-nav-link href="{{ route('admin.rates.index').'#rate' }}" :active="request()->routeIs('admin.rates.index')">
                    {{ __('Avaliações') }}
                </x-jet-nav-link>
                <x-jet-dropdown id="dropdown">
                    <x-slot name="trigger">
                        News
                        <svg class="ms-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </x-slot>
                    <x-slot name="content">
                        <h6 class="dropdown-header small text-muted">
                            {{ __('Gerencia Newsletters') }}
                        </h6>
                        <x-jet-dropdown-link href="{{ route('admin.retrancas.index').'#editoria' }}" :active="request()->routeIs('admin.retrancas.index')" >
                            {{ __('Editorias') }}
                        </x-jet-dropdown-link>
                        <hr class="dropdown-divider">
                        <x-jet-dropdown-link href="{{route('admin.noticias.index').'#noticia'}}" :active="request()->routeIs('admin.noticias.index')">
                            {{ __('Notícias') }}
                        </x-jet-dropdown-link>
                        <hr class="dropdown-divider">
                        <x-jet-dropdown-link href="{{route('admin.noticias.noticias-dia').'#noticia'}}" :active="request()->routeIs('admin.noticias.index-dia')">
                            {{ __('Notícias do dia') }}
                        </x-jet-dropdown-link>
                        <hr class="dropdown-divider">
                        <x-jet-dropdown-link href="{{route('admin.newsletters.index').'#newsletter'}}" :active="request()->routeIs('admin.newsletters.index')">
                            {{ __('Newsletters') }}
                        </x-jet-dropdown-link>
                        <hr class="dropdown-divider">
                    </x-slot>
                </x-jet-dropdown>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav align-items-baseline">
                <!-- Settings Dropdown -->

                    <x-jet-dropdown id="settingsDropdown">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <img class="rounded-circle" width="32" height="32" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            @else
                                {{ Auth::user()->name }}

                                <svg class="ms-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <h6 class="dropdown-header small text-muted">
                                {{ __('Manage Account') }}
                            </h6>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <hr class="dropdown-divider">

                            <!-- Authentication -->
                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                                 onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Log out') }}
                            </x-jet-dropdown-link>
                            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
            </ul>
            @endauth
        </div>
    </div>
</nav>

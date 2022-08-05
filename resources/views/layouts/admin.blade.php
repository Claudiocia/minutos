@include('layouts.includes.header-admin')

        <!-- Page Content -->
        <main class="container my-5">
            @yield('conteudo')
        </main>

        @stack('modals')

        @livewireScripts

        @stack('scripts')
@include('layouts.includes.footer')

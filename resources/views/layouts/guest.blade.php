@include('layouts.includes.head')
    <body class="bg-light font-sans antialiased">
    {{ $slot ? : '' }}
    <main class="container my-5">
        @yield('conteudo')
    </main>
    @include('layouts.includes.footer')

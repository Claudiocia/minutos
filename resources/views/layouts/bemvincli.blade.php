@include('layouts.includes.headbem')
    <body>
    <!-- Page Content -->
    <main class="container my-5">
        @yield('conteudo')
    </main>
    @if($assina ?? '')
    </body>
    </html>
    @else
    @include('layouts.includes.footer')
    @endif



@include('layouts.includes.head')
<body class="font-sans antialiased bg-light">
<x-jet-banner />
@livewire('navigation-menu')

<!-- Page Heading -->
<header class="d-flex py-3 bg-white shadow-sm border-bottom">
    <div class="container">
        <x-marca-minutos height="30"/>
    </div>
</header>
<div class="col-4">
    @if (Session::has('msg'))
        <div class="my-alert">
            {!! Alert::success(Session::get('msg')) !!}
        </div>
    @elseif(Session::has('error'))
        <div>
            {!! Alert::danger(Session::get('error')) !!}
        </div>
    @endif
</div>

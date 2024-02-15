<!DOCTYPE html>
<html>

<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield('titulo')</title>
</head>

<body>
    <header>
        @include('partials.nav')
    </header>
    <main>
        <div class="container">
            <div class="fecha-actual">
                {{ \Carbon\Carbon::now()->format('d/m/Y') }}
            </div>
            <ul>
                <li><a href="{{ route('posts.create') }}">Crear Post</a></li>
            </ul>

            {{-- Aquí es donde mostramos los mensajes de sesión --}}
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @yield('contenido')
        </div>
    </main>
</body>

</html>
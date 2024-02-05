<html>

<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield('titulo')</title>
</head>

<body>
    @include('partials.nav')
    <div class="fecha-actual">
        {{ fechaActual('d/m/Y') }}
    </div>
    @yield('contenido')
</body>

</html>
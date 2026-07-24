<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Centro Veterinario')</title>
    <link rel="stylesheet" href="/css/estilos.css">
</head>
<body>
    <header>
        <a href="{{ url('/') }}" class="logo">Centro <span>Veterinario</span></a>
        <nav>
            @guest
                <a href="{{ route('login') }}">Ingresar</a>
                <a href="{{ route('register') }}" class="btn">Registrarse</a>
            @endguest
            @auth
                <a href="{{ route('dashboard') }}">Mi panel</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Cerrar sesion</a>
                </form>
            @endauth
        </nav>
    </header>

    @yield('content')
</body>
</html>

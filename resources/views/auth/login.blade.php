@extends('layouts.base')

@section('titulo', 'Iniciar sesion')

@section('content')
<main class="form-box">
    <h1>Iniciar sesion</h1>
    <p>Ingresa tus credenciales para acceder al sistema.</p>

    @if ($errors->any())
        <div class="campo">
            <ul style="color: #c0392b;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="campo" style="color: #2e7d32;">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="campo">
            <label for="email">Correo electronico</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="usuario@email.com" required autofocus>
        </div>

        <div class="campo">
            <label for="password">Contrasena</label>
            <input type="password" id="password" name="password" placeholder="Ingresa tu contrasena" required>
        </div>

        <button class="btn" type="submit">Ingresar</button>
    </form>
</main>
@endsection

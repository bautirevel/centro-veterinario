@extends('layouts.base')

@section('titulo', 'Registro de cliente')

@section('content')
<main class="form-box">
    <h1>Registro de cliente</h1>
    <p>Completa tus datos para solicitar turnos y registrar tus mascotas.</p>

    @if ($errors->any())
        <div class="campo">
            <ul style="color: #c0392b;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="campo">
            <label>Nombre y apellido</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Ej: Juan Perez" required>
        </div>

        <div class="campo">
            <label>Correo electronico</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="cliente@email.com" required>
        </div>

        <div class="campo">
            <label>Telefono</label>
            <input type="text" name="telefono" value="{{ old('telefono') }}" placeholder="Ej: 11 1234-5678">
        </div>

        <div class="campo">
            <label>Contrasena</label>
            <input type="password" name="password" placeholder="Crear contrasena" required>
        </div>

        <div class="campo">
            <label>Confirmar contrasena</label>
            <input type="password" name="password_confirmation" placeholder="Repetir contrasena" required>
        </div>

        <button class="btn" type="submit">Crear cuenta</button>
    </form>
</main>
@endsection

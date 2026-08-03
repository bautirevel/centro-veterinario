@extends('layouts.base')

@section('titulo', 'Agregar empleado')

@section('content')
<main class="form-box">
    <h1>Agregar empleado</h1>
    <p>Cargar un nuevo veterinario o secretario.</p>

    @if ($errors->any())
        <div class="campo">
            <ul style="color: #c0392b;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('encargado.personal.store') }}">
        @csrf

        <div class="campo">
            <label>Nombre y apellido</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Ej: Dra. Perez" required>
        </div>

        <div class="campo">
            <label>Correo electronico</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="empleado@veterinaria.com" required>
        </div>

        <div class="campo">
            <label>Telefono</label>
            <input type="text" name="telefono" value="{{ old('telefono') }}" placeholder="Ej: 11 1234-5678">
        </div>

        <div class="campo">
            <label>Rol</label>
            <select name="rol" required>
                <option value="veterinario" {{ old('rol') == 'veterinario' ? 'selected' : '' }}>Veterinario</option>
                <option value="secretario" {{ old('rol') == 'secretario' ? 'selected' : '' }}>Secretario</option>
            </select>
        </div>

        <div class="campo">
            <label>Contrasena</label>
            <input type="password" name="password" placeholder="Crear contrasena" required>
        </div>

        <div class="campo">
            <label>Confirmar contrasena</label>
            <input type="password" name="password_confirmation" placeholder="Repetir contrasena" required>
        </div>

        <button class="btn" type="submit">Crear empleado</button>
        <a href="{{ route('encargado.personal.index') }}" class="btn" style="background:#777;">Cancelar</a>
    </form>
</main>
@endsection

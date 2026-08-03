@extends('layouts.base')

@section('titulo', 'Editar empleado')

@section('content')
<main class="form-box">
    <h1>Editar empleado</h1>
    <p>Modificar los datos de {{ $user->name }}.</p>

    @if ($errors->any())
        <div class="campo">
            <ul style="color: #c0392b;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('encargado.personal.update', $user) }}">
        @csrf
        @method('PATCH')

        <div class="campo">
            <label>Nombre y apellido</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="campo">
            <label>Correo electronico</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="campo">
            <label>Telefono</label>
            <input type="text" name="telefono" value="{{ old('telefono', $user->telefono) }}">
        </div>

        <div class="campo">
            <label>Rol</label>
            <select name="rol" required>
                <option value="veterinario" {{ old('rol', $user->rol) == 'veterinario' ? 'selected' : '' }}>Veterinario</option>
                <option value="secretario" {{ old('rol', $user->rol) == 'secretario' ? 'selected' : '' }}>Secretario</option>
            </select>
        </div>

        <div class="campo">
            <label>Nueva contrasena (opcional)</label>
            <input type="password" name="password" placeholder="Dejar en blanco para no cambiarla">
        </div>

        <div class="campo">
            <label>Confirmar nueva contrasena</label>
            <input type="password" name="password_confirmation" placeholder="Repetir si cambiaste la contrasena">
        </div>

        <button class="btn" type="submit">Guardar cambios</button>
        <a href="{{ route('encargado.personal.index') }}" class="btn" style="background:#777;">Cancelar</a>
    </form>
</main>
@endsection

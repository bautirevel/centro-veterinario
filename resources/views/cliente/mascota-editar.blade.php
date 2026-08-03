@extends('layouts.base')

@section('titulo', 'Editar mascota')

@section('content')
<main class="form-box">
    <h1>Editar mascota</h1>
    <p>Modificar los datos de {{ $mascota->nombre }}.</p>

    @if ($errors->any())
        <div class="campo">
            <ul style="color: #c0392b;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('cliente.mascotas.update', $mascota->id) }}">
        @csrf
        @method('PATCH')

        <div class="campo">
            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre', $mascota->nombre) }}" required>
        </div>

        <div class="campo">
            <label>Tipo</label>
            <select name="tipo" required>
                <option value="Perro" {{ old('tipo', $mascota->tipo) == 'Perro' ? 'selected' : '' }}>Perro</option>
                <option value="Gato" {{ old('tipo', $mascota->tipo) == 'Gato' ? 'selected' : '' }}>Gato</option>
                <option value="Otro" {{ old('tipo', $mascota->tipo) == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>

        <div class="campo">
            <label>Raza</label>
            <input type="text" name="raza" value="{{ old('raza', $mascota->raza) }}">
        </div>

        <div class="campo">
            <label>Edad</label>
            <input type="number" name="edad" value="{{ old('edad', $mascota->edad) }}" min="0" max="60">
        </div>

        <div class="campo">
            <label>Observaciones</label>
            <textarea name="observaciones" placeholder="Alergias, condiciones previas, etc.">{{ old('observaciones', $mascota->observaciones) }}</textarea>
        </div>

        <button class="btn" type="submit">Guardar cambios</button>
        <a href="{{ route('cliente.mascotas.index') }}" class="btn" style="background:#777;">Cancelar</a>
    </form>
</main>
@endsection

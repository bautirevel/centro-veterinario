@extends('layouts.base')

@section('titulo', 'Agregar mascota')

@section('content')
<main class="form-box">
    <h1>Agregar mascota</h1>
    <p>Cargar los datos de tu mascota.</p>

    @if ($errors->any())
        <div class="campo">
            <ul style="color: #c0392b;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('cliente.mascotas.store') }}">
        @csrf

        <div class="campo">
            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Ej: Firulais" required>
        </div>

        <div class="campo">
            <label>Tipo</label>
            <select name="tipo" required>
                <option value="Perro" {{ old('tipo') == 'Perro' ? 'selected' : '' }}>Perro</option>
                <option value="Gato" {{ old('tipo') == 'Gato' ? 'selected' : '' }}>Gato</option>
                <option value="Otro" {{ old('tipo') == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>

        <div class="campo">
            <label>Raza</label>
            <input type="text" name="raza" value="{{ old('raza') }}" placeholder="Ej: Labrador">
        </div>

        <div class="campo">
            <label>Edad</label>
            <input type="number" name="edad" value="{{ old('edad') }}" min="0" max="60" placeholder="Anos">
        </div>

        <div class="campo">
            <label>Observaciones</label>
            <textarea name="observaciones" placeholder="Alergias, condiciones previas, etc.">{{ old('observaciones') }}</textarea>
        </div>

        <button class="btn" type="submit">Guardar mascota</button>
        <a href="{{ route('cliente.mascotas.index') }}" class="btn" style="background:#777;">Cancelar</a>
    </form>
</main>
@endsection

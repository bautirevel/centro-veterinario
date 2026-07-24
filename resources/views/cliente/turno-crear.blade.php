@extends('layouts.base')

@section('titulo', 'Solicitar turno')

@section('content')
<main class="form-box">
    <h1>Solicitar turno</h1>
    <p>Completa los datos para coordinar la atencion de tu mascota.</p>

    @if ($errors->any())
        <div class="campo">
            <ul style="color: #c0392b;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('cliente.turno.store') }}">
        @csrf

        @if ($mascotas->count() > 0)
            <div class="campo">
                <label>Mascota</label>
                <select name="mascota_id" id="mascota_id" onchange="document.getElementById('bloque-nueva-mascota').style.display = this.value ? 'none' : 'block';">
                    <option value="">-- Cargar una mascota nueva --</option>
                    @foreach ($mascotas as $mascota)
                        <option value="{{ $mascota->id }}" {{ old('mascota_id') == $mascota->id ? 'selected' : '' }}>{{ $mascota->nombre }} ({{ $mascota->tipo }})</option>
                    @endforeach
                </select>
            </div>
        @endif

        <div id="bloque-nueva-mascota">
            <div class="campo">
                <label>Nombre de la mascota</label>
                <input type="text" name="mascota_nueva_nombre" value="{{ old('mascota_nueva_nombre') }}" placeholder="Ej: Rocky">
            </div>

            <div class="campo">
                <label>Tipo de mascota</label>
                <select name="mascota_nueva_tipo">
                    <option value="Perro" {{ old('mascota_nueva_tipo') == 'Perro' ? 'selected' : '' }}>Perro</option>
                    <option value="Gato" {{ old('mascota_nueva_tipo') == 'Gato' ? 'selected' : '' }}>Gato</option>
                    <option value="Otro" {{ old('mascota_nueva_tipo') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
        </div>

        <div class="campo">
            <label>Motivo de consulta</label>
            <textarea name="motivo" placeholder="Describe brevemente el motivo">{{ old('motivo') }}</textarea>
        </div>

        <div class="campo">
            <label>Fecha preferida</label>
            <input type="date" name="fecha" value="{{ old('fecha') }}" min="{{ date('Y-m-d') }}">
        </div>

        <div class="campo">
            <label>Horario preferido</label>
            <input type="time" name="hora" value="{{ old('hora') }}">
        </div>

        <button class="btn" type="submit">Enviar solicitud</button>
    </form>
</main>
@endsection

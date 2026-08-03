@extends('layouts.base')

@section('titulo', 'Ficha de ' . $mascota->nombre)

@section('content')
<main class="contenedor">
    <h1 class="titulo-seccion">{{ $mascota->nombre }}</h1>
    <p class="subtitulo">Ficha completa de la mascota.</p>

    <div class="grid">
        <article class="card">
            <h3>Datos generales</h3>
            <p><strong>Tipo:</strong> {{ $mascota->tipo }}</p>
            <p><strong>Raza:</strong> {{ $mascota->raza ?? 'No especificada' }}</p>
            <p><strong>Edad:</strong> {{ $mascota->edad ?? 'No especificada' }}</p>
        </article>
        <article class="card">
            <h3>Duenio</h3>
            <p><strong>Nombre:</strong> {{ $mascota->dueno->name }}</p>
            <p><strong>Email:</strong> {{ $mascota->dueno->email }}</p>
            <p><strong>Telefono:</strong> {{ $mascota->dueno->telefono ?? 'No especificado' }}</p>
        </article>
        <article class="card">
            <h3>Observaciones</h3>
            <p>{{ $mascota->observaciones ?? 'Sin observaciones cargadas.' }}</p>
        </article>
    </div>

    <h2 class="titulo-seccion" style="margin-top: 40px;">Historial de turnos</h2>

    @if ($mascota->turnos->count() > 0)
        <table class="tabla">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Horario</th>
                    <th>Motivo</th>
                    <th>Veterinario</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mascota->turnos as $turno)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($turno->fecha)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($turno->hora)->format('H:i') }}</td>
                        <td>{{ $turno->motivo }}</td>
                        <td>{{ $turno->veterinario->name ?? 'Sin asignar' }}</td>
                        <td><span class="estado {{ $turno->estado }}">{{ ucfirst($turno->estado) }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Todavia no hay turnos registrados para esta mascota.</p>
    @endif
</main>
@endsection

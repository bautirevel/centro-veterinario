@extends('layouts.base')

@section('titulo', 'Panel Cliente')

@section('content')
<main class="contenedor">
    <h1 class="titulo-seccion">Bienvenido, {{ auth()->user()->name }}</h1>
    <p class="subtitulo">Desde esta seccion podes consultar tus mascotas y solicitar turnos.</p>

    @if (session('status'))
        <p style="color: #2e7d32;">{{ session('status') }}</p>
    @endif

    <div class="grid">
        <article class="card">
            <h3>Mis mascotas</h3>
            <p>Tenes {{ $mascotas->count() }} mascota(s) registrada(s).</p>
            @foreach ($mascotas as $mascota)
                <p>- <a href="{{ route('mascota.show', $mascota) }}">{{ $mascota->nombre }}</a> ({{ $mascota->tipo }})</p>
            @endforeach
            <a href="{{ route('cliente.mascotas.index') }}" class="btn">Gestionar mascotas</a>
        </article>
        <article class="card">
            <h3>Solicitar turno</h3>
            <p>Pedi atencion veterinaria para tu mascota.</p>
            <a href="{{ route('cliente.turno.crear') }}" class="btn">Solicitar turno</a>
        </article>
        <article class="card">
            <h3>Ubicacion</h3>
            <p>Av. de los Incas y Tronador, Villa Ortuzar, CABA.</p>
        </article>
    </div>

    @if ($turnos->count() > 0)
        <h2 class="titulo-seccion" style="margin-top: 40px;">Mis turnos</h2>
        <table class="tabla">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Horario</th>
                    <th>Mascota</th>
                    <th>Veterinario</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($turnos as $turno)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($turno->fecha)->format('d/m') }}</td>
                        <td>{{ \Carbon\Carbon::parse($turno->hora)->format('H:i') }}</td>
                        <td>{{ $turno->mascota->nombre }}</td>
                        <td>{{ $turno->veterinario->name ?? 'Sin asignar' }}</td>
                        <td><span class="estado {{ $turno->estado }}">{{ ucfirst($turno->estado) }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</main>
@endsection

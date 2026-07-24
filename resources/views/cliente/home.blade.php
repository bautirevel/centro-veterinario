@extends('layouts.base')

@section('titulo', 'Panel Cliente')

@section('content')
<main class="contenedor">
    <h1 class="titulo-seccion">Bienvenido, {{ auth()->user()->name }}</h1>
    <p class="subtitulo">Desde esta seccion podes consultar tus mascotas y solicitar turnos.</p>

    <div class="grid">
        <article class="card">
            <h3>Mis mascotas</h3>
            <p>Tenes {{ $mascotas->count() }} mascota(s) registrada(s).</p>
            @foreach ($mascotas as $mascota)
                <p>- {{ $mascota->nombre }} ({{ $mascota->tipo }})</p>
            @endforeach
        </article>
        <article class="card">
            <h3>Solicitar turno</h3>
            <p>Formulario para pedir atencion veterinaria segun disponibilidad.</p>
        </article>
        <article class="card">
            <h3>Ubicacion</h3>
            <p>Av. de los Incas y Tronador, Villa Ortuzar, CABA.</p>
        </article>
    </div>
</main>
@endsection

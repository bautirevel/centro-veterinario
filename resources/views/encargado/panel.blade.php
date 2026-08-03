@extends('layouts.base')

@section('titulo', 'Panel de Sucursal')

@section('content')
<main class="panel">
    <aside class="sidebar">
        <h2>Encargado</h2>
        <a class="activo" href="{{ route('encargado.panel') }}">Panel general</a>
        <a href="{{ route('encargado.personal.index') }}">Personal</a>
    </aside>

    <section class="contenido-panel">
        <h1 class="titulo-seccion">Panel de sucursal</h1>
        <p class="subtitulo">Resumen del funcionamiento diario de la veterinaria.</p>

        <div class="grid">
            <article class="card">
                <h3>Turnos del dia</h3>
                <p>{{ $turnosHoy }} turnos cargados para la jornada actual.</p>
            </article>
            <article class="card">
                <h3>Veterinarios activos</h3>
                <p>{{ $veterinariosActivos }} profesionales disponibles para atencion.</p>
            </article>
            <article class="card">
                <h3>Secretaria</h3>
                <p>{{ $secretariosActivos }} usuarios administrativos asignados.</p>
            </article>
        </div>
    </section>
</main>
@endsection

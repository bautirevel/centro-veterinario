@extends('layouts.base')

@section('titulo', 'Secretario - Turnos')

@section('content')
<main class="panel">
    <aside class="sidebar">
        <h2>Secretario</h2>
        <a class="activo" href="{{ route('secretario.turnos') }}">Administrar turnos</a>
    </aside>

    <section class="contenido-panel">
        <h1 class="titulo-seccion">Administracion de turnos</h1>
        <p class="subtitulo">Vista administrativa para organizar la agenda de la veterinaria.</p>

        <table class="tabla">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Horario</th>
                    <th>Cliente</th>
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
                        <td>{{ $turno->mascota->dueno->name }}</td>
                        <td>{{ $turno->mascota->nombre }}</td>
                        <td>{{ $turno->veterinario->name ?? 'Sin asignar' }}</td>
                        <td><span class="estado {{ $turno->estado }}">{{ ucfirst($turno->estado) }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $turnos->links() }}
        </div>
    </section>
</main>
@endsection

@extends('layouts.base')

@section('titulo', 'Veterinario - Turnos')

@section('content')
<main class="panel">
    <aside class="sidebar">
        <h2>Veterinario</h2>
        <a class="activo" href="{{ route('veterinario.turnos') }}">Lista de turnos</a>
    </aside>

    <section class="contenido-panel">
        <h1 class="titulo-seccion">Turnos asignados</h1>
        <p class="subtitulo">Listado de pacientes que debes atender.</p>

        <table class="tabla">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Horario</th>
                    <th>Mascota</th>
                    <th>Cliente</th>
                    <th>Motivo</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($turnos as $turno)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($turno->fecha)->format('d/m') }}</td>
                        <td>{{ \Carbon\Carbon::parse($turno->hora)->format('H:i') }}</td>
                        <td>{{ $turno->mascota->nombre }}</td>
                        <td>{{ $turno->mascota->dueno->name }}</td>
                        <td>{{ $turno->motivo }}</td>
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

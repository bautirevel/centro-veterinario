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

        @if (session('status'))
            <p style="color: #2e7d32;">{{ session('status') }}</p>
        @endif

        <table class="tabla">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Horario</th>
                    <th>Cliente</th>
                    <th>Mascota</th>
                    <th>Motivo</th>
                    <th>Veterinario</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($turnos as $turno)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($turno->fecha)->format('d/m') }}</td>
                        <td>{{ \Carbon\Carbon::parse($turno->hora)->format('H:i') }}</td>
                        <td>{{ $turno->mascota->dueno->name }}</td>
                        <td><a href="{{ route('mascota.show', $turno->mascota) }}">{{ $turno->mascota->nombre }}</a></td>
                        <td>{{ $turno->motivo }}</td>
                        <td>{{ $turno->veterinario->name ?? 'Sin asignar' }}</td>
                        <td><span class="estado {{ $turno->estado }}">{{ ucfirst($turno->estado) }}</span></td>
                        <td>
                            <form method="POST" action="{{ route('secretario.turnos.update', $turno) }}" style="display:flex; gap:6px; align-items:center;">
                                @csrf
                                @method('PATCH')
                                <select name="veterinario_id">
                                    <option value="">Sin asignar</option>
                                    @foreach ($veterinarios as $vet)
                                        <option value="{{ $vet->id }}" {{ $turno->veterinario_id == $vet->id ? 'selected' : '' }}>{{ $vet->name }}</option>
                                    @endforeach
                                </select>
                                <select name="estado">
                                    <option value="pendiente" {{ $turno->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="confirmado" {{ $turno->estado == 'confirmado' ? 'selected' : '' }}>Confirmado</option>
                                    <option value="cancelado" {{ $turno->estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                                </select>
                                <button class="btn" type="submit">Guardar</button>
                            </form>
                        </td>
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

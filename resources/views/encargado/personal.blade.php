@extends('layouts.base')

@section('titulo', 'Encargado - Personal')

@section('content')
<main class="panel">
    <aside class="sidebar">
        <h2>Encargado</h2>
        <a href="{{ route('encargado.panel') }}">Panel general</a>
        <a class="activo" href="{{ route('encargado.personal.index') }}">Personal</a>
    </aside>

    <section class="contenido-panel">
        <h1 class="titulo-seccion">Gestion de personal</h1>
        <p class="subtitulo">Alta, edicion y baja de veterinarios y secretarios.</p>

        @if (session('status'))
            <p style="color: #2e7d32;">{{ session('status') }}</p>
        @endif

        <a href="{{ route('encargado.personal.crear') }}" class="btn">Agregar empleado</a>

        <table class="tabla" style="margin-top: 20px;">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($personal as $empleado)
                    <tr>
                        <td>{{ $empleado->name }}</td>
                        <td>{{ $empleado->email }}</td>
                        <td>{{ $empleado->telefono ?? '-' }}</td>
                        <td>{{ ucfirst($empleado->rol) }}</td>
                        <td style="display:flex; gap:8px;">
                            <a href="{{ route('encargado.personal.editar', $empleado) }}" class="btn">Editar</a>
                            <form method="POST" action="{{ route('encargado.personal.eliminar', $empleado) }}" onsubmit="return confirm('Seguro que queres eliminar a {{ $empleado->name }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" style="background:#c0392b;">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $personal->links() }}
        </div>
    </section>
</main>
@endsection

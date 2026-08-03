@extends('layouts.base')

@section('titulo', 'Mis mascotas')

@section('content')
<main class="contenedor">
    <h1 class="titulo-seccion">Mis mascotas</h1>
    <p class="subtitulo">Gestiona la informacion de tus mascotas registradas.</p>

    @if (session('status'))
        <p style="color: #2e7d32;">{{ session('status') }}</p>
    @endif

    <a href="{{ route('cliente.mascotas.crear') }}" class="btn">Agregar mascota</a>

    <table class="tabla" style="margin-top: 20px;">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Raza</th>
                <th>Edad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mascotas as $mascota)
                <tr>
                    <td><a href="{{ route('mascota.show', $mascota) }}">{{ $mascota->nombre }}</a></td>
                    <td>{{ $mascota->tipo }}</td>
                    <td>{{ $mascota->raza ?? '-' }}</td>
                    <td>{{ $mascota->edad ?? '-' }}</td>
                    <td style="display:flex; gap:8px;">
                        <a href="{{ route('cliente.mascotas.editar', $mascota->id) }}" class="btn">Editar</a>
                        <form method="POST" action="{{ route('cliente.mascotas.eliminar', $mascota->id) }}" onsubmit="return confirm('Seguro que queres eliminar a {{ $mascota->nombre }}?');">
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
        {{ $mascotas->links() }}
    </div>
</main>
@endsection

@extends('layouts.base')

@section('titulo', 'Contacto')

@section('content')
<main class="contenedor">
    <h1 class="titulo-seccion">Contacto y ubicacion</h1>

    <div class="grid-2">
        <section class="card">
            <h3>Datos de la veterinaria</h3>
            <p><strong>Direccion:</strong> Av. de los Incas y Tronador</p>
            <p><strong>Barrio:</strong> Villa Ortuzar, CABA</p>
            <p><strong>Telefono:</strong> 11 4567-8900</p>
            <p><strong>Email:</strong> contacto@centroveterinario.com</p>
            <p><strong>Horario:</strong> Lunes a viernes de 9:00 a 18:00 hs</p>
        </section>

        <section class="card">
            <h3>Ubicacion</h3>
            <img class="mapa" src="/img/mapa.png" alt="Mapa de ubicacion de la veterinaria">
        </section>
    </div>
</main>
@endsection

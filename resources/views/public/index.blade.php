@extends('layouts.base')

@section('titulo', 'Centro Veterinario')

@section('content')
<section class="hero">
    <div class="hero-texto">
        <h1>Cuidamos a tu mascota como parte de la familia</h1>
        <p>Centro Veterinario es una plataforma pensada para gestionar turnos, pacientes, mascotas y atencion veterinaria de forma simple y organizada.</p>
        <a href="{{ auth()->check() && auth()->user()->rol === 'cliente' ? route('cliente.turno.crear') : route('login') }}" class="btn">Solicitar turno</a>
        <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="btn btn-secundario">Ingresar al sistema</a>
    </div>

    <div class="carrusel">
        <input type="radio" name="slide" id="slide1" checked>
        <input type="radio" name="slide" id="slide2">
        <input type="radio" name="slide" id="slide3">

        <div class="imagenes-carrusel">
            <img src="/img/perro1.jpg" alt="Perro de la veterinaria">
            <img src="/img/perro2.jpg" alt="Cachorro de la veterinaria">
            <img src="/img/perro3.jpg" alt="Mascota en consulta">
        </div>

        <div class="flechas flechas1">
            <label for="slide3">&#10094;</label>
            <label for="slide2">&#10095;</label>
        </div>

        <div class="flechas flechas2">
            <label for="slide1">&#10094;</label>
            <label for="slide3">&#10095;</label>
        </div>

        <div class="flechas flechas3">
            <label for="slide2">&#10094;</label>
            <label for="slide1">&#10095;</label>
        </div>
    </div>
</section>

<section class="contenedor">
    <h2 class="titulo-seccion">Servicios principales</h2>

    <div class="grid">
        <article class="card">
            <h3>Consulta veterinaria</h3>
            <p>Atencion medica para mascotas, revision general y seguimiento de tratamientos.</p>
        </article>
        <article class="card">
            <h3>Vacunacion</h3>
            <p>Control de vacunas y prevencion para perros, gatos y otras mascotas.</p>
        </article>
        <article class="card">
            <h3>Turnos online</h3>
            <p>Solicitud y organizacion de turnos para mejorar la atencion de los pacientes.</p>
        </article>
    </div>
</section>
@endsection

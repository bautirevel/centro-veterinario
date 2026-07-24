<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use Illuminate\View\View;

class ClienteController extends Controller
{
    public function home(): View
    {
        $mascotas = auth()->user()->mascotas;

        $turnos = Turno::whereIn('mascota_id', $mascotas->pluck('id'))
            ->with('veterinario')
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();

        return view('cliente.home', compact('mascotas', 'turnos'));
    }
}

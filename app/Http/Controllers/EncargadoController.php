<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use App\Models\User;
use Illuminate\View\View;

class EncargadoController extends Controller
{
    public function panel(): View
    {
        $turnosHoy = Turno::whereDate('fecha', now()->toDateString())->count();
        $veterinariosActivos = User::where('rol', 'veterinario')->count();
        $secretariosActivos = User::where('rol', 'secretario')->count();

        return view('encargado.panel', compact('turnosHoy', 'veterinariosActivos', 'secretariosActivos'));
    }
}

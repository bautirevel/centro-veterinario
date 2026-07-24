<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use Illuminate\View\View;

class VeterinarioController extends Controller
{
    public function turnos(): View
    {
        $turnos = Turno::with(['mascota.dueno'])
            ->where('veterinario_id', auth()->id())
            ->orderBy('fecha')
            ->orderBy('hora')
            ->paginate(10);

        return view('veterinario.turnos', compact('turnos'));
    }
}

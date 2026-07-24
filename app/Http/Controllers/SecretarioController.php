<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use App\Models\User;
use Illuminate\View\View;

class SecretarioController extends Controller
{
    public function turnos(): View
    {
        $turnos = Turno::with(['mascota.dueno', 'veterinario'])
            ->orderBy('fecha')
            ->orderBy('hora')
            ->paginate(10);

        $veterinarios = User::where('rol', 'veterinario')->get();

        return view('secretario.turnos', compact('turnos', 'veterinarios'));
    }
}

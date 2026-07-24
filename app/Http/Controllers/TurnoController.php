<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TurnoController extends Controller
{
    public function create(): View
    {
        $mascotas = auth()->user()->mascotas;

        return view('cliente.turno-crear', compact('mascotas'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'mascota_id' => 'nullable|exists:mascotas,id',
            'mascota_nueva_nombre' => 'required_without:mascota_id|nullable|string|max:255',
            'mascota_nueva_tipo' => 'required_without:mascota_id|nullable|string|max:100',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'motivo' => 'required|string|max:255',
        ]);

        if ($request->filled('mascota_id')) {
            // findOrFail sobre la relacion: si la mascota no es del usuario logueado, tira 404.
            $mascota = auth()->user()->mascotas()->findOrFail($request->mascota_id);
        } else {
            $mascota = auth()->user()->mascotas()->create([
                'nombre' => $data['mascota_nueva_nombre'],
                'tipo' => $data['mascota_nueva_tipo'],
            ]);
        }

        Turno::create([
            'mascota_id' => $mascota->id,
            'fecha' => $data['fecha'],
            'hora' => $data['hora'],
            'motivo' => $data['motivo'],
            'estado' => 'pendiente',
        ]);

        return redirect()->route('cliente.home')
            ->with('status', 'Turno solicitado correctamente. Te vamos a confirmar la fecha a la brevedad.');
    }

    public function updateEstado(Request $request, Turno $turno): RedirectResponse
    {
        $data = $request->validate([
            'estado' => 'required|in:pendiente,confirmado,cancelado',
            'veterinario_id' => 'nullable|exists:users,id',
        ]);

        if (! empty($data['veterinario_id'])) {
            // Confirmamos que el id elegido sea realmente un veterinario, no cualquier usuario.
            User::where('id', $data['veterinario_id'])->where('rol', 'veterinario')->firstOrFail();
        }

        $turno->update([
            'estado' => $data['estado'],
            'veterinario_id' => $data['veterinario_id'] ?? $turno->veterinario_id,
        ]);

        return back()->with('status', 'Turno actualizado correctamente.');
    }
}

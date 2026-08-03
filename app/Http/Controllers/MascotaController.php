<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MascotaController extends Controller
{
    public function index(): View
    {
        $mascotas = auth()->user()->mascotas()->paginate(10);

        return view('cliente.mascotas', compact('mascotas'));
    }

    public function create(): View
    {
        return view('cliente.mascota-crear');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:100',
            'raza' => 'nullable|string|max:100',
            'edad' => 'nullable|integer|min:0|max:60',
            'observaciones' => 'nullable|string|max:1000',
        ]);

        auth()->user()->mascotas()->create($data);

        return redirect()->route('cliente.mascotas.index')->with('status', 'Mascota agregada correctamente.');
    }

    public function edit(int $id): View
    {
        // findOrFail sobre la relacion del usuario logueado: si la mascota no es suya, tira 404.
        $mascota = auth()->user()->mascotas()->findOrFail($id);

        return view('cliente.mascota-editar', compact('mascota'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $mascota = auth()->user()->mascotas()->findOrFail($id);

        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:100',
            'raza' => 'nullable|string|max:100',
            'edad' => 'nullable|integer|min:0|max:60',
            'observaciones' => 'nullable|string|max:1000',
        ]);

        $mascota->update($data);

        return redirect()->route('cliente.mascotas.index')->with('status', 'Mascota actualizada correctamente.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $mascota = auth()->user()->mascotas()->findOrFail($id);
        $mascota->delete();

        return redirect()->route('cliente.mascotas.index')->with('status', 'Mascota eliminada correctamente.');
    }

    public function show(Mascota $mascota): View
    {
        $user = auth()->user();

        // El cliente solo puede ver la ficha de sus propias mascotas.
        // Encargado, secretario y veterinario pueden ver cualquiera.
        if ($user->rol === 'cliente' && $mascota->user_id !== $user->id) {
            abort(403, 'No tenes permiso para ver esta mascota.');
        }

        $mascota->load('dueno');
        $mascota->load(['turnos' => function ($query) {
            $query->orderBy('fecha', 'desc')->orderBy('hora', 'desc');
        }, 'turnos.veterinario']);

        return view('mascota.show', compact('mascota'));
    }
}

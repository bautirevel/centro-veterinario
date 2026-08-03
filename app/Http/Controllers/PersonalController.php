<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class PersonalController extends Controller
{
    public function index(): View
    {
        $personal = User::whereIn('rol', ['veterinario', 'secretario'])
            ->orderBy('rol')
            ->orderBy('name')
            ->paginate(10);

        return view('encargado.personal', compact('personal'));
    }

    public function create(): View
    {
        return view('encargado.personal-crear');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email',
            'telefono' => 'nullable|string|max:30',
            'rol' => ['required', Rule::in(['veterinario', 'secretario'])],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'telefono' => $data['telefono'] ?? null,
            'rol' => $data['rol'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('encargado.personal.index')->with('status', 'Empleado creado correctamente.');
    }

    public function edit(User $user): View
    {
        // Solo se puede editar personal (veterinario/secretario), no clientes ni al propio encargado.
        abort_unless(in_array($user->rol, ['veterinario', 'secretario'], true), 404);

        return view('encargado.personal-editar', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        abort_unless(in_array($user->rol, ['veterinario', 'secretario'], true), 404);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'telefono' => 'nullable|string|max:30',
            'rol' => ['required', Rule::in(['veterinario', 'secretario'])],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->telefono = $data['telefono'] ?? null;
        $user->rol = $data['rol'];

        if (! empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()->route('encargado.personal.index')->with('status', 'Empleado actualizado correctamente.');
    }

    public function destroy(User $user): RedirectResponse
    {
        abort_unless(in_array($user->rol, ['veterinario', 'secretario'], true), 404);

        $user->delete();

        return redirect()->route('encargado.personal.index')->with('status', 'Empleado eliminado correctamente.');
    }
}

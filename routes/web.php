<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EncargadoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SecretarioController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\VeterinarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return match (auth()->user()->rol) {
        'cliente' => redirect()->route('cliente.home'),
        'encargado' => redirect()->route('encargado.panel'),
        'secretario' => redirect()->route('secretario.turnos'),
        'veterinario' => redirect()->route('veterinario.turnos'),
        default => redirect()->route('login'),
    };
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:cliente'])->prefix('cliente')->name('cliente.')->group(function () {
    Route::get('/', [ClienteController::class, 'home'])->name('home');
    Route::get('/turno/crear', [TurnoController::class, 'create'])->name('turno.crear');
    Route::post('/turno', [TurnoController::class, 'store'])->name('turno.store');
});

Route::middleware(['auth', 'role:encargado'])->prefix('encargado')->name('encargado.')->group(function () {
    Route::get('/panel', [EncargadoController::class, 'panel'])->name('panel');
});

Route::middleware(['auth', 'role:secretario'])->prefix('secretario')->name('secretario.')->group(function () {
    Route::get('/turnos', [SecretarioController::class, 'turnos'])->name('turnos');
    Route::patch('/turnos/{turno}', [TurnoController::class, 'updateEstado'])->name('turnos.update');
});

Route::middleware(['auth', 'role:veterinario'])->prefix('veterinario')->name('veterinario.')->group(function () {
    Route::get('/turnos', [VeterinarioController::class, 'turnos'])->name('turnos');
});

require __DIR__.'/auth.php';

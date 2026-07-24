<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ClienteController extends Controller
{
    public function home(): View
    {
        $mascotas = auth()->user()->mascotas;

        return view('cliente.home', compact('mascotas'));
    }
}

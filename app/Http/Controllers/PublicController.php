<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PublicController extends Controller
{
    public function index(): View
    {
        return view('public.index');
    }

    public function contacto(): View
    {
        return view('public.contacto');
    }
}

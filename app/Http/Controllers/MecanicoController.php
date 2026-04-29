<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MecanicoController extends Controller
{
    public function index()
    {
        return view('mecanico.Mecanico_Dashboard');
    }
}

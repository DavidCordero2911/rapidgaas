<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Vehiculo;
use App\Models\OrdenTrabajo;

use Illuminate\Http\Request;

class AdminTallerController extends Controller
{
    public function index()
    {
        $totalClientes     = Cliente::count();
        $totalVehiculos    = Vehiculo::count();
        $ordenesActivas    = OrdenTrabajo::whereNotIn('estado', ['finalizado', 'entregado'])->count();
        $ordenesPendientes = OrdenTrabajo::where('estado', 'en_espera')->count();

        return view('admin.Admin_Dashboard', compact(
            'totalClientes',
            'totalVehiculos',
            'ordenesActivas',
            'ordenesPendientes'
        ));
    }
}

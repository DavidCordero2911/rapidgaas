<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehiculo;
use App\Models\OrdenTrabajo;
use Spatie\Permission\Models\Role;

class SuperAdminController extends Controller
{
    public function index()
    {
        $totalUsuarios   = User::count();
        $totalVehiculos  = Vehiculo::count();
        $ordenesActivas  = OrdenTrabajo::whereNotIn('estado', ['finalizado', 'entregado'])->count();
        $totalClientes   = User::role('cliente')->count();

        return view('superadmin.SuperAdmin_dashboard', compact(
            'totalUsuarios',
            'totalVehiculos',
            'ordenesActivas',
            'totalClientes'
        ));
    }

    public function usuarios()
    {
        $usuarios = User::with('roles')->get();
        $roles    = Role::all();
        return view('superadmin.usuarios', compact('usuarios', 'roles'));
    }

    public function cambiarRol($id)
    {
        $usuario = User::with('roles')->findOrFail($id);
        $roles   = Role::all();
        return view('superadmin.cambiar_rol', compact('usuario', 'roles'));
    }

    public function actualizarRol(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->syncRoles([$request->rol]);
        return redirect()->route('superadmin.usuarios')->with('success', 'Rol actualizado correctamente.');
    }

    public function toggleActivo($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->activo = !$usuario->activo;
        $usuario->save();
        return redirect()->route('superadmin.usuarios')->with('success', 'Estado del usuario actualizado.');
    }

    public function vehiculos()
    {
        $vehiculos = Vehiculo::with('cliente')->get();
        return view('superadmin.vehiculos', compact('vehiculos'));
    }

    public function ordenes()
    {
        $ordenes = OrdenTrabajo::with(['vehiculo.cliente', 'mecanico'])->get();
        return view('superadmin.ordenes', compact('ordenes'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehiculo;
use App\Models\OrdenTrabajo;
use App\Models\Cliente;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsuarios  = User::count();
        $totalVehiculos = Vehiculo::count();
        $ordenesActivas = OrdenTrabajo::whereNotIn('estado', ['finalizado', 'entregado'])->count();
        $totalClientes  = User::role('cliente')->count();

        return view('admin.Admin_Dashboard', compact(
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
        return view('admin.usuarios', compact('usuarios', 'roles'));
    }

    public function cambiarRol($id)
    {
        $usuario = User::with('roles')->findOrFail($id);
        $roles   = Role::all();
        return view('admin.cambiar_rol', compact('usuario', 'roles'));
    }

    public function actualizarRol(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->syncRoles([$request->rol]);
        return redirect()->route('admin.usuarios')
            ->with('success', 'Rol actualizado correctamente.');
    }

    public function toggleActivo($id)
    {
        $usuario         = User::findOrFail($id);
        $usuario->activo = !$usuario->activo;
        $usuario->save();
        return redirect()->route('admin.usuarios')
            ->with('success', 'Estado del usuario actualizado.');
    }

    public function vehiculos()
    {
        $vehiculos = Vehiculo::with('cliente')->get();
        return view('admin.vehiculos', compact('vehiculos'));
    }

    public function ordenes()
    {
        $ordenes = OrdenTrabajo::with(['vehiculo.cliente', 'mecanico'])->get();
        return view('admin.ordenes', compact('ordenes'));
    }
}

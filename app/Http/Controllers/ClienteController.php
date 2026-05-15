<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\User;

class ClienteController extends Controller
{
    // Panel del cliente
    public function index()
    {
        $user    = auth()->user();
        $cliente = Cliente::where('user_id', $user->id)
            ->with(['vehiculos.ordenes.actualizaciones'])
            ->first();

        $orden = null;
        $vehiculo = null;

        if ($cliente && $cliente->vehiculos->isNotEmpty()) {
            $vehiculo = $cliente->vehiculos->first();
            $orden    = $vehiculo->ordenes->sortByDesc('created_at')->first();
        }

        return view('cliente.Cliente_Dashboard', compact('cliente', 'vehiculo', 'orden'));
    }

    // Listado de clientes (admin)
    public function listar()
    {
        $clientes = Cliente::with('user')->get();
        return view('admin.clientes.index', compact('clientes'));
    }

    // Formulario crear cliente
    public function crear()
    {
        $usuarios = User::role('cliente')->whereDoesntHave('cliente')->get();
        return view('admin.clientes.create', compact('usuarios'));
    }

    // Guardar cliente
    public function guardar(Request $request)
    {
        $request->validate([
            'user_id'   => ['required', 'exists:users,id'],
            'nombre'    => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'unique:clientes,email'],
            'telefono'  => ['nullable', 'string', 'max:20'],
            'direccion' => ['nullable', 'string', 'max:255'],
        ]);

        Cliente::create($request->all());

        return redirect()->route('admin.clientes.index')
            ->with('success', 'Cliente creado correctamente.');
    }

    // Formulario editar cliente
    public function editar($id)
    {
        $cliente  = Cliente::findOrFail($id);
        $usuarios = User::role('cliente')->get();
        return view('admin.clientes.edit', compact('cliente', 'usuarios'));
    }

    // Actualizar cliente
    public function actualizar(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'nombre'    => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'unique:clientes,email,' . $id],
            'telefono'  => ['nullable', 'string', 'max:20'],
            'direccion' => ['nullable', 'string', 'max:255'],
        ]);

        $cliente->update($request->all());

        return redirect()->route('admin.clientes.index')
            ->with('success', 'Cliente actualizado correctamente.');
    }

    // Eliminar cliente
    public function eliminar($id)
    {
        Cliente::findOrFail($id)->delete();
        return redirect()->route('admin.clientes.index')
            ->with('success', 'Cliente eliminado correctamente.');
    }
}

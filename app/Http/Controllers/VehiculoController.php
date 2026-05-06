<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Cliente;

class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::with('cliente')->get();
        return view('admin.vehiculos.index', compact('vehiculos'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        return view('admin.vehiculos.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id'          => ['required', 'exists:clientes,id'],
            'matricula'           => ['required', 'string', 'unique:vehiculos,matricula'],
            'marca'               => ['required', 'string', 'max:100'],
            'modelo'              => ['required', 'string', 'max:100'],
            'anio'                => ['nullable', 'integer', 'min:1900', 'max:' . date('Y')],
            'color'               => ['nullable', 'string', 'max:50'],
            'numero_bastidor'     => ['nullable', 'string', 'max:100'],
            'descripcion_inicial' => ['nullable', 'string'],
        ]);

        Vehiculo::create($request->all());

        return redirect()->route('admin.vehiculos.index')
            ->with('success', 'Vehículo creado correctamente.');
    }

    public function edit($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $clientes = Cliente::all();
        return view('admin.vehiculos.edit', compact('vehiculo', 'clientes'));
    }

    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        $request->validate([
            'matricula'           => ['required', 'string', 'unique:vehiculos,matricula,' . $id],
            'marca'               => ['required', 'string', 'max:100'],
            'modelo'              => ['required', 'string', 'max:100'],
            'anio'                => ['nullable', 'integer', 'min:1900', 'max:' . date('Y')],
            'color'               => ['nullable', 'string', 'max:50'],
            'numero_bastidor'     => ['nullable', 'string', 'max:100'],
            'descripcion_inicial' => ['nullable', 'string'],
        ]);

        $vehiculo->update($request->all());

        return redirect()->route('admin.vehiculos.index')
            ->with('success', 'Vehículo actualizado correctamente.');
    }

    public function destroy($id)
    {
        Vehiculo::findOrFail($id)->delete();
        return redirect()->route('admin.vehiculos.index')
            ->with('success', 'Vehículo eliminado correctamente.');
    }
}

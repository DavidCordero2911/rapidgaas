<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdenTrabajo;
use App\Models\ActualizacionEstado;
use App\Models\RegistroReparacion;

class MecanicoController extends Controller
{
    public function index()
    {
        $ordenes = OrdenTrabajo::with(['vehiculo.cliente'])
            ->where('mecanico_id', auth()->id())
            ->whereNotIn('estado', ['finalizado', 'entregado'])
            ->get();

        $ordenesFinalizadas = OrdenTrabajo::with(['vehiculo.cliente'])
            ->where('mecanico_id', auth()->id())
            ->whereIn('estado', ['finalizado', 'entregado'])
            ->count();

        return view('mecanico.Mecanico_Dashboard', compact('ordenes', 'ordenesFinalizadas'));
    }

    public function actualizarEstado(Request $request, $id)
    {
        $orden = OrdenTrabajo::findOrFail($id);

        $request->validate([
            'estado'     => ['required', 'in:en_espera,en_diagnostico,en_reparacion,finalizado,entregado'],
            'comentario' => ['nullable', 'string'],
        ]);

        $estadoAnterior = $orden->estado;
        $orden->estado  = $request->estado;
        $orden->save();

        ActualizacionEstado::create([
            'orden_id'        => $orden->id,
            'user_id'         => auth()->id(),
            'estado_anterior' => $estadoAnterior,
            'estado_nuevo'    => $request->estado,
            'comentario'      => $request->comentario ?? 'Estado actualizado por el mecánico.',
        ]);

        return redirect()->route('mecanico.dashboard')
            ->with('success', 'Estado actualizado correctamente.');
    }

    public function ordenesActivas()
    {
        $ordenes = OrdenTrabajo::with(['vehiculo.cliente'])
            ->where('mecanico_id', auth()->id())
            ->whereNotIn('estado', ['finalizado', 'entregado'])
            ->get();

        return view('mecanico.ordenes_activas', compact('ordenes'));
    }

    public function ordenesFinalizadas()
    {
        $ordenes = OrdenTrabajo::with(['vehiculo.cliente'])
            ->where('mecanico_id', auth()->id())
            ->whereIn('estado', ['finalizado', 'entregado'])
            ->get();

        return view('mecanico.ordenes_finalizadas', compact('ordenes'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdenTrabajo;
use App\Models\Vehiculo;
use App\Models\User;
use App\Models\ActualizacionEstado;

class OrdenTrabajoController extends Controller
{
    public function index()
    {
        $ordenes = OrdenTrabajo::with(['vehiculo.cliente', 'mecanico'])->get();
        return view('admin.ordenes.index', compact('ordenes'));
    }

    public function create()
    {
        $vehiculos = Vehiculo::with('cliente')->get();
        $mecanicos = User::role('mecanico')->get();
        return view('admin.ordenes.create', compact('vehiculos', 'mecanicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehiculo_id'          => ['required', 'exists:vehiculos,id'],
            'mecanico_id'          => ['nullable', 'exists:users,id'],
            'diagnostico_inicial'  => ['nullable', 'string'],
            'observaciones'        => ['nullable', 'string'],
            'presupuesto_estimado' => ['nullable', 'numeric', 'min:0'],
            'fecha_estimada'       => ['nullable', 'date'],
        ]);

        $orden = OrdenTrabajo::create([
            'vehiculo_id'          => $request->vehiculo_id,
            'mecanico_id'          => $request->mecanico_id,
            'admin_id'             => auth()->id(),
            'estado'               => 'en_espera',
            'diagnostico_inicial'  => $request->diagnostico_inicial,
            'observaciones'        => $request->observaciones,
            'presupuesto_estimado' => $request->presupuesto_estimado,
            'fecha_entrada'        => now(),
            'fecha_estimada'       => $request->fecha_estimada,
        ]);

        ActualizacionEstado::create([
            'orden_id'        => $orden->id,
            'user_id'         => auth()->id(),
            'estado_anterior' => null,
            'estado_nuevo'    => 'en_espera',
            'comentario'      => 'Orden de trabajo creada.',
        ]);

        return redirect()->route('admin.ordenes.index')
            ->with('success', 'Orden de trabajo creada correctamente.');
    }

    public function show($id)
    {
        $orden = OrdenTrabajo::with([
            'vehiculo.cliente',
            'mecanico',
            'actualizaciones.user',
            'fotos'
        ])->findOrFail($id);

        return view('admin.ordenes.show', compact('orden'));
    }

    public function edit($id)
    {
        $orden     = OrdenTrabajo::findOrFail($id);
        $vehiculos = Vehiculo::with('cliente')->get();
        $mecanicos = User::role('mecanico')->get();
        return view('admin.ordenes.edit', compact('orden', 'vehiculos', 'mecanicos'));
    }

    public function update(Request $request, $id)
    {
        $orden = OrdenTrabajo::findOrFail($id);

        $request->validate([
            'mecanico_id'          => ['nullable', 'exists:users,id'],
            'estado'               => ['required', 'in:en_espera,en_diagnostico,en_reparacion,finalizado,entregado'],
            'diagnostico_inicial'  => ['nullable', 'string'],
            'observaciones'        => ['nullable', 'string'],
            'presupuesto_estimado' => ['nullable', 'numeric', 'min:0'],
            'coste_final'          => ['nullable', 'numeric', 'min:0'],
            'fecha_estimada'       => ['nullable', 'date'],
            'fecha_entrega'        => ['nullable', 'date'],
        ]);

        $estadoAnterior = $orden->estado;

        $orden->update($request->all());

        if ($estadoAnterior !== $request->estado) {
            ActualizacionEstado::create([
                'orden_id'        => $orden->id,
                'user_id'         => auth()->id(),
                'estado_anterior' => $estadoAnterior,
                'estado_nuevo'    => $request->estado,
                'comentario'      => $request->observaciones ?? 'Estado actualizado.',
            ]);
        }

        return redirect()->route('admin.ordenes.index')
            ->with('success', 'Orden actualizada correctamente.');
    }

    public function destroy($id)
    {
        OrdenTrabajo::findOrFail($id)->delete();
        return redirect()->route('admin.ordenes.index')
            ->with('success', 'Orden eliminada correctamente.');
    }

    public function cerrar($id)
    {
        $orden = OrdenTrabajo::with(['vehiculo.cliente.user'])->findOrFail($id);
        $estadoAnterior = $orden->estado;

        $orden->estado       = 'entregado';
        $orden->fecha_entrega = now();
        $orden->save();

        ActualizacionEstado::create([
            'orden_id'        => $orden->id,
            'user_id'         => auth()->id(),
            'estado_anterior' => $estadoAnterior,
            'estado_nuevo'    => 'entregado',
            'comentario'      => 'Vehículo entregado al cliente.',
        ]);

        // Notificar al cliente
        if ($orden->vehiculo->cliente && $orden->vehiculo->cliente->user) {
            $orden->vehiculo->cliente->user->notify(
                new \App\Notifications\CambioEstadoOrden($orden)
            );
        }

        return redirect()->route('admin.ordenes.index')
            ->with('success', 'Orden cerrada. Vehículo marcado como entregado.');
    }
}

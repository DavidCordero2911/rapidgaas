<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdenTrabajo;
use App\Models\RegistroReparacion;

class RegistroReparacionController extends Controller
{
    public function show($ordenId)
    {
        $orden    = OrdenTrabajo::with(['vehiculo.cliente', 'registroReparacion'])->findOrFail($ordenId);
        $registro = $orden->registroReparacion;
        return view('mecanico.reparacion', compact('orden', 'registro'));
    }

    public function store(Request $request, $ordenId)
    {
        $orden = OrdenTrabajo::findOrFail($ordenId);

        $datos = [
            'orden_id'                 => $orden->id,
            'mecanico_id'              => auth()->id(),
            'diagnostico_inicial'      => $request->boolean('diagnostico_inicial'),
            'revision_neumaticos'      => $request->boolean('revision_neumaticos'),
            'revision_motor'           => $request->boolean('revision_motor'),
            'revision_frenos'          => $request->boolean('revision_frenos'),
            'revision_presion'         => $request->boolean('revision_presion'),
            'revision_aceite'          => $request->boolean('revision_aceite'),
            'revision_cadena'          => $request->boolean('revision_cadena'),
            'revision_electrica'       => $request->boolean('revision_electrica'),
            'revision_suspension'      => $request->boolean('revision_suspension'),
            'revision_filtros'         => $request->boolean('revision_filtros'),
            'observaciones_reparacion' => $request->observaciones_reparacion,
            'piezas_sustituidas'       => $request->piezas_sustituidas,
        ];

        RegistroReparacion::updateOrCreate(
            ['orden_id' => $orden->id],
            $datos
        );

        return redirect()->route('mecanico.dashboard')
            ->with('success', 'Registro de reparación guardado correctamente.');
    }
}

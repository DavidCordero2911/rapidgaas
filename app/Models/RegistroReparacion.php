<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroReparacion extends Model
{
    protected $table = 'registros_reparacion';

    protected $fillable = [
        'orden_id',
        'mecanico_id',
        'diagnostico_inicial',
        'revision_neumaticos',
        'revision_motor',
        'revision_frenos',
        'revision_presion',
        'revision_aceite',
        'revision_cadena',
        'revision_electrica',
        'revision_suspension',
        'revision_filtros',
        'observaciones_reparacion',
        'piezas_sustituidas',
    ];

    protected $casts = [
        'diagnostico_inicial' => 'boolean',
        'revision_neumaticos' => 'boolean',
        'revision_motor'      => 'boolean',
        'revision_frenos'     => 'boolean',
        'revision_presion'    => 'boolean',
        'revision_aceite'     => 'boolean',
        'revision_cadena'     => 'boolean',
        'revision_electrica'  => 'boolean',
        'revision_suspension' => 'boolean',
        'revision_filtros'    => 'boolean',
    ];

    public function orden()
    {
        return $this->belongsTo(OrdenTrabajo::class);
    }

    public function mecanico()
    {
        return $this->belongsTo(User::class, 'mecanico_id');
    }
}

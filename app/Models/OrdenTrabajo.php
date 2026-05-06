<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenTrabajo extends Model
{
    protected $table = 'ordenes_trabajo';

    protected $fillable = [
        'vehiculo_id',
        'mecanico_id',
        'admin_id',
        'estado',
        'diagnostico_inicial',
        'observaciones',
        'presupuesto_estimado',
        'coste_final',
        'fecha_entrada',
        'fecha_estimada',
        'fecha_entrega',
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function mecanico()
    {
        return $this->belongsTo(User::class, 'mecanico_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function actualizaciones()
    {
        return $this->hasMany(ActualizacionEstado::class, 'orden_id');
    }

    public function fotos()
    {
        return $this->hasMany(FotoVehiculo::class, 'orden_id');
    }

    public function registroReparacion()
    {
        return $this->hasOne(RegistroReparacion::class, 'orden_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $fillable = [
        'cliente_id',
        'matricula',
        'marca',
        'modelo',
        'anio',
        'color',
        'numero_bastidor',
        'descripcion_inicial',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function ordenes()
    {
        return $this->hasMany(OrdenTrabajo::class);
    }
}

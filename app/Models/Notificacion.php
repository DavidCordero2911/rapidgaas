<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $fillable = [
        'cliente_id',
        'orden_id',
        'tipo',
        'mensaje',
        'leida',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function orden()
    {
        return $this->belongsTo(OrdenTrabajo::class);
    }
}

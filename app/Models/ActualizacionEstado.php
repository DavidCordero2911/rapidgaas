<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ActualizacionEstado extends Model
{
    protected $table = 'actualizaciones_estado';

    protected $fillable = [
        'orden_id',
        'user_id',
        'estado_anterior',
        'estado_nuevo',
        'comentario',
    ];

    public function orden()
    {
        return $this->belongsTo(OrdenTrabajo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

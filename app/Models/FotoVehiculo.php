<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class FotoVehiculo extends Model
{
    protected $table = 'fotos_vehiculo';

    protected $fillable = [
        'orden_id',
        'user_id',
        'ruta_archivo',
        'descripcion',
        'tipo',
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

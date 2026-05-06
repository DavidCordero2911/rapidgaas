<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MensajeChat extends Model
{
    protected $table = 'mensajes_chat';

    protected $fillable = [
        'emisor_id',
        'receptor_id',
        'orden_id',
        'contenido',
        'leido',
    ];

    public function emisor()
    {
        return $this->belongsTo(User::class, 'emisor_id');
    }

    public function receptor()
    {
        return $this->belongsTo(User::class, 'receptor_id');
    }

    public function orden()
    {
        return $this->belongsTo(OrdenTrabajo::class);
    }
}

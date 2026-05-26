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
        'cliente_id',
        'es_bot',
        'es_admin',
        'leido_admin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'emisor_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}

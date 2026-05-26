<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NuevoMensajeChat extends Notification
{
    public function __construct(public $user, public $cliente) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'mensaje'    => 'Nuevo mensaje de ' . ($this->cliente?->nombre ?? $this->user->nombre),
            'user_id'    => $this->user->id,
        ];
    }
}

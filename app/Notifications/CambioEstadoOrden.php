<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\OrdenTrabajo;

class CambioEstadoOrden extends Notification
{
    public function __construct(public OrdenTrabajo $orden) {}

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Actualización de tu moto — RapidGaas')
            ->view('emails.cambio_estado', [
                'orden'    => $this->orden,
                'cliente'  => $notifiable,
            ]);
    }

    public function toDatabase($notifiable): array
    {
        return [
            'orden_id'     => $this->orden->id,
            'estado_nuevo' => $this->orden->estado,
            'matricula'    => $this->orden->vehiculo->matricula,
            'mensaje'      => 'Tu moto ' . $this->orden->vehiculo->matricula . ' ha cambiado al estado: ' . ucfirst(str_replace('_', ' ', $this->orden->estado)),
        ];
    }

    public function toArray($notifiable): array
    {
        return $this->toDatabase($notifiable);
    }
}

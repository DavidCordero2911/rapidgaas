<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\User;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $userCliente = User::where('email', 'cliente@taller.com')->first();

        Cliente::create([
            'user_id'   => $userCliente->id,
            'nombre'    => 'Cliente David',
            'email'     => 'cliente@taller.com',
            'telefono'  => '600000003',
            'direccion' => 'Calle Ejemplo 1, Cádiz',
        ]);
    }
}

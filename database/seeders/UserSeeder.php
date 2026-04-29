<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superadmin = User::create([
            'nombre'   => 'Admin Principal',
            'email'    => 'admin@rapidgaas.com',
            'password' => Hash::make('RapidGaas123'),
            'telefono' => '655645302',
            'activo'   => true,
        ]);

        $superadmin->assignRole('superadmin');

        $admin = User::create([
            'nombre'   => 'Admin Taller',
            'email'    => 'admin@taller.com',
            'password' => Hash::make('Admin123'),
            'telefono' => '600000001',
            'activo'   => true,
        ]);
        $admin->assignRole('admin_taller');

        $mecanico = User::create([
            'nombre'   => 'Mecánico 1',
            'email'    => 'mecanico@taller.com',
            'password' => Hash::make('Mecanico123'),
            'telefono' => '600000002',
            'activo'   => true,
        ]);
        $mecanico->assignRole('mecanico');

        $cliente = User::create([
            'nombre'   => 'Cliente 1',
            'email'    => 'cliente@taller.com',
            'password' => Hash::make('Cliente123'),
            'telefono' => '600000003',
            'activo'   => true,
        ]);
        $cliente->assignRole('cliente');
    }
}

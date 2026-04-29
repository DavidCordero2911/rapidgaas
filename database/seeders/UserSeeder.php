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
    }
}

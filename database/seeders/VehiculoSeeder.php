<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehiculo;
use App\Models\Cliente;

class VehiculoSeeder extends Seeder
{
    public function run(): void
    {
        $cliente = Cliente::where('email', 'cliente@taller.com')->first();

        Vehiculo::create([
            'cliente_id'          => $cliente->id,
            'matricula'           => '1234ABC',
            'marca'               => 'Honda',
            'modelo'              => 'CBR 600',
            'anio'                => 2019,
            'color'               => 'Rojo',
            'numero_bastidor'     => 'JH2PC40J6KM000001',
            'descripcion_inicial' => 'Revisión general y cambio de aceite',
        ]);

        Vehiculo::create([
            'cliente_id'          => $cliente->id,
            'matricula'           => '5678DEF',
            'marca'               => 'Yamaha',
            'modelo'              => 'MT-07',
            'anio'                => 2021,
            'color'               => 'Negro',
            'numero_bastidor'     => 'JYA1TKE12MA000002',
            'descripcion_inicial' => 'Fallo en sistema de frenos',
        ]);

        Vehiculo::create([
            'cliente_id'          => $cliente->id,
            'matricula'           => '9012GHI',
            'marca'               => 'Kawasaki',
            'modelo'              => 'Z650',
            'anio'                => 2020,
            'color'               => 'Verde',
            'numero_bastidor'     => 'JKAZX4R16LA000003',
            'descripcion_inicial' => 'Revisión de cadena y neumáticos',
        ]);
    }
}

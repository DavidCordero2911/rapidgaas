<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrdenTrabajo;
use App\Models\Vehiculo;
use App\Models\User;

class OrdenTrabajoSeeder extends Seeder
{
    public function run(): void
    {
        $mecanico  = User::where('email', 'mecanico@taller.com')->first();
        $admin     = User::where('email', 'admin@taller.com')->first();
        $vehiculo1 = Vehiculo::where('matricula', '1234ABC')->first();
        $vehiculo2 = Vehiculo::where('matricula', '5678DEF')->first();
        $vehiculo3 = Vehiculo::where('matricula', '9012GHI')->first();

        OrdenTrabajo::create([
            'vehiculo_id'          => $vehiculo1->id,
            'mecanico_id'          => $mecanico->id,
            'admin_id'             => $admin->id,
            'estado'               => 'en_reparacion',
            'diagnostico_inicial'  => 'Desgaste en frenos delanteros y filtro de aire sucio.',
            'observaciones'        => 'Cliente solicita revisión completa.',
            'presupuesto_estimado' => 185.50,
            'fecha_entrada'        => now(),
            'fecha_estimada'       => now()->addDays(3),
        ]);

        OrdenTrabajo::create([
            'vehiculo_id'          => $vehiculo2->id,
            'mecanico_id'          => $mecanico->id,
            'admin_id'             => $admin->id,
            'estado'               => 'en_diagnostico',
            'diagnostico_inicial'  => 'Fallo en pinza de freno trasero.',
            'observaciones'        => 'Revisar líquido de frenos también.',
            'presupuesto_estimado' => 220.00,
            'fecha_entrada'        => now()->subDays(1),
            'fecha_estimada'       => now()->addDays(2),
        ]);

        OrdenTrabajo::create([
            'vehiculo_id'          => $vehiculo3->id,
            'mecanico_id'          => $mecanico->id,
            'admin_id'             => $admin->id,
            'estado'               => 'finalizado',
            'diagnostico_inicial'  => 'Cadena desgastada y neumático trasero en límite.',
            'observaciones'        => 'Se sustituyó cadena y neumático trasero.',
            'presupuesto_estimado' => 310.00,
            'coste_final'          => 295.00,
            'fecha_entrada'        => now()->subDays(5),
            'fecha_estimada'       => now()->subDays(2),
            'fecha_entrega'        => now()->subDays(1),
        ]);
    }
}

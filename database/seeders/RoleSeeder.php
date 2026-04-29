<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'superadmin']);
        Role::create(['name' => 'admin_taller']);
        Role::create(['name' => 'mecanico']);
        Role::create(['name' => 'cliente']);
    }
}

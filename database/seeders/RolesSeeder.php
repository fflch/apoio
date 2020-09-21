<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cargo1 = [
            'cargo' => 'Diretor',
        ];

        $cargo2 = [
            'cargo' => 'Chefe de Departamento',
        ];

        Role::create($cargo1);
        Role::create($cargo2);
        Role::factory()->count(20)->create();
    }
}

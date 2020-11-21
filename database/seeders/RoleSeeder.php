<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cargo1 = [
            'nome' => 'Diretor',
        ];

        $cargo2 = [
            'nome' => 'Chefe de Departamento',
        ];

        Role::create($cargo1);
        Role::create($cargo2);
        Role::factory()->count(20)->create();
    }
}

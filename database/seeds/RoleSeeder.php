<?php

use Illuminate\Database\Seeder;
use App\Role;

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
            'cargo' => 'Diretor',
        ];

        $cargo2 = [
            'cargo' => 'Chefe de Departamento',
        ];

        Role::create($cargo1);
        Role::create($cargo2);
        factory(Role::class, 20)->create();
    }
}

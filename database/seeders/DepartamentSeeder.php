<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departament;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departamento1 = [
            'sigla'   => 'SVG',
            'nome'    => 'Serviços Gerais',
        ];

        $departamento2 = [
            'sigla'   => 'STI',
            'nome'    => 'Seção Técnica de Informática',
        ];

        Departament::create($departamento1);
        Departament::create($departamento2);
        Departament::factory()->count(10)->create();
    }
}

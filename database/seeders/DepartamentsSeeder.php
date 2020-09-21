<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departament;

class DepartamentsSeeder extends Seeder
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
            'departamento'    => 'Serviços Gerais',
        ];

        $departamento2 = [
            'sigla'   => 'STI',
            'departamento'    => 'Seção Técnica de Informática',
        ];

        Departament::create($departamento1);
        Departament::create($departamento2);
        Departament::factory()->count(20)->create();
    }
}

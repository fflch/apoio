<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Institution;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $institution1 = [
            'sigla'   => 'FFLCH',
            'nome'    => 'Faculdade de Filosofia, Letras e Ciências Humanas',
            'unidade' => 'São Paulo',
            'local'   => 'Campus Capital',
        ];

        $institution2 = [
            'sigla'   => 'ECA',
            'nome'    => 'Escola de Comunicação e Arte',
            'unidade' => 'São Paulo',
            'local'   => 'Campus Capital',
        ];

        Institution::create($institution1);
        Institution::create($institution2);
        Institution::factory()->count(40)->create();
    }
}

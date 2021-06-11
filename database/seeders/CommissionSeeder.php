<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Commission;

class CommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titulo = array('TITULAR','ASSOCIADO','DOUTOR');
        $commissions = [
            [
                'contest_id' => 1,
                'people_id' => 1,
                'origem' => 'FFLCH',
                'titulo' => $titulo[array_rand($titulo)],
            ],
            [
                'contest_id' => 1,
                'people_id' => 2,
                'origem' => 'FFLCH',
                'titulo' => $titulo[array_rand($titulo)],
            ],
            [
                'contest_id' => 1,
                'people_id' => 3,
                'origem' => 'FFLCH',
                'titulo' => $titulo[array_rand($titulo)],
            ],
            [
                'contest_id' => 1,
                'people_id' => 4,
                'origem' => 'FFLCH',
                'titulo' => $titulo[array_rand($titulo)],
            ],
            [
                'contest_id' => 1,
                'people_id' => 5,
                'origem' => 'FFLCH',
                'titulo' => $titulo[array_rand($titulo)],
            ],
            [
                'contest_id' => 1,
                'people_id' => 6,
                'origem' => 'EXTERNO',
                'titulo' => $titulo[array_rand($titulo)],
            ],
            [
                'contest_id' => 1,
                'people_id' => 7,
                'origem' => 'EXTERNO',
                'titulo' => $titulo[array_rand($titulo)],
            ],
            [
                'contest_id' => 1,
                'people_id' => 8,
                'origem' => 'EXTERNO',
                'titulo' => $titulo[array_rand($titulo)],
            ],
            [
                'contest_id' => 1,
                'people_id' => 9,
                'origem' => 'EXTERNO',
                'titulo' => $titulo[array_rand($titulo)],
            ],
            [
                'contest_id' => 1,
                'people_id' => 10,
                'origem' => 'EXTERNO',
                'titulo' => $titulo[array_rand($titulo)],
            ]
        ];

        Commission::insert($commissions);
    }
}

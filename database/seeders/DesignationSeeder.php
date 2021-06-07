<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Designation;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $designations = [
            [
                'nome' => 'Assistente',
            ],
            [
                'nome' => 'Associado',
            ],
            [
                'nome' => 'Associado Aposentado',
            ],
            [
                'nome' => 'Associado com Agregação',
            ],
            [
                'nome' => 'Catedrático',
            ],
            [
                'nome' => 'Doutor',
            ],
            [
                'nome' => 'Doutor Aposentado',
            ],
            [
                'nome' => 'Emérito',
            ],
            [
                'nome' => 'Especialista Reconhecido Saber',
            ],
            [
                'nome' => 'Funcionário',
            ],
            [
                'nome' => 'Representante Discente',
            ],
            [
                'nome' => 'Técnico e Administrativo',
            ],
            [
                'nome' => 'Titular',
            ],
            [
                'nome' => 'Titular Aposentado',
            ]
        ];

        Designation::insert($designations);
    }
}

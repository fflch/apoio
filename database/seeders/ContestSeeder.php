<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contest;

class ContestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contest1 = [
            'departament_id' => 1,
            'titularidade' => 'LIVRE-DOCÊNCIA',
            'descricao' => 'Concurso Professor Livre-docente',
            'area' => 'ÉTICA E FILOSOFIA POLÍTICA',
            'disciplina' => '',
            'edital' => 'FFLCH Nº 07/14',
            'inicio' => '15/08/2014',
            'termino' => '29/08/2014',
            'data_publicacao' => '04/07/2014',
            'processo' => 'Processo 14.5',
            'livro' => 'Livro 1',
            'qtde_fflch' => 2,
            'qtde_externo' => 3,
            'observacao' => 'Sem observação',
        ];

        $contest2 = [
            'departament_id' => 4,
            'titularidade' => 'Professor Contratado Nível III',
            'descricao' => 'Processo Seletivo',
            'area' => 'língua espanhola',
            'disciplina' => '',
            'edital' => 'FLM Nº 007/2017',
            'inicio' => '15/08/2014',
            'termino' => '29/08/2014',
            'inicio_prova' => '13/03/2017',
            'termino_prova' => '15/03/2017',
            'data_publicacao' => '23/02/2017',
            'processo' => '17.1.598.8.7',
            'livro' => 'Livro 4',
            'status' => 'C',
            'qtde_fflch' => 2,
            'qtde_externo' => 3,
            'observacao' => 'Sem observação',
        ];

        Contest::create($contest1);
        Contest::create($contest2);
        Contest::factory()->count(30)->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Holder;

class HolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $holder1 = [
            'people_id' => 1,
            'designation_id' => 1,
            'departament_id' => 1,
            'pertence' => 'CTA',
            'inicio' => '2021-01-01',
            'termino' => '2022-01-01',
            'observacao' => 'Observação teste',
            'ativo' => 'S',
        ];

        $holder2 = [
            'people_id' => 2,
            'designation_id' => 2,
            'departament_id' => 2,
            'pertence' => 'CTA',
            'inicio' => '2021-03-01',
            'termino' => '2022-03-01',
            'observacao' => 'Observação teste',
            'ativo' => 'S',
        ];
        Holder::create($holder1);
        Holder::create($holder2);
        Holder::factory()->count(30)->create();
    }
}

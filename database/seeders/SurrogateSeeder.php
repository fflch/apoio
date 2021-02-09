<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Surrogate;

class SurrogateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $surrogate1 = [
            'people_id' => 3,
            'holder_id' => 1,
            'departament_id' => 1,
            'pertence' => 'CTA',
            'inicio' => '2021-01-01',
            'termino' => '2022-01-01',
            'observacao' => 'Observação teste',
            'status' => 'S',
        ];

        $surrogate2 = [
            'people_id' => 4,
            'holder_id' => 2,
            'departament_id' => 2,
            'pertence' => 'CTA',
            'inicio' => '2021-03-01',
            'termino' => '2022-03-01',
            'observacao' => 'Observação teste',
            'status' => 'S',
        ];
        Surrogate::create($surrogate1);
        Surrogate::create($surrogate2);
        Surrogate::factory()->count(30)->create();
    }
}

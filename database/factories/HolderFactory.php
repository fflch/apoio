<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Holder;
use App\Models\People;
use App\Models\Designation;
use App\Models\Departament;

class HolderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Holder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = array('S','N');
        $pertence = array('CTA','CON');
        $inicio = date("Y-m-d", mktime(0, 0, 0, date("m")-rand(6,12),
                                   date("d")+rand(1,31), date("Y")));
        return [
            'people_id' => People::inRandomOrder()->pluck('id')->first(),
            'designation_id' => Designation::inRandomOrder()->pluck('id')->first(),
            'departament_id' => Departament::inRandomOrder()->pluck('id')->first(),
            'pertence' => $pertence[array_rand($pertence)],
            'inicio' => $inicio,
            'termino' => date("Y-m-d", strtotime($inicio. '+ 1 year')),
            'observacao' => $this->faker->text($maxNbChars = 100),
            'ativo' => $status[array_rand($status)],
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Surrogate;
use App\Models\Holder;
use App\Models\People;
use App\Models\Departament;
use Illuminate\Database\Eloquent\Factories\Factory;

class SurrogateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Surrogate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = array('A','I');
        $status_key = array_rand($status);
        $pertence = array('CTA','CON');
        $pertence_key = array_rand($pertence);
        $holder_id = Holder::where('pertence', $pertence[$pertence_key])
                             ->inRandomOrder()->pluck('id')->first();
        return [
            'people_id' => People::inRandomOrder()->pluck('id')->first(),
            'holder_id' => $holder_id,
            'departament_id' => Departament::inRandomOrder()->pluck('id')->first(),
            'pertence' => $pertence[$pertence_key],
            'inicio' => Holder::where('id', $holder_id)->pluck('inicio')->first(),
            'termino' => Holder::where('id', $holder_id)->pluck('termino')->first(),
            'observacao' => $this->faker->text($maxNbChars = 100),
            'status' => $status[$status_key]
        ];
    }
}

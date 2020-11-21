<?php

namespace Database\Factories;

use App\Models\Institution;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InstitutionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Institution::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sigla' => $this->faker->unique()->text($maxNbChars = 10),
            'nome' => $this->faker->sentence($nbWords = 3,
                $variableNbWords = true),
            'unidade' => $this->faker->sentence($nbWords = 2,
                $variableNbWords = true),
            'local' => $this->faker->sentence,
        ];
    }
}

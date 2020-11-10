<?php

namespace Database\Factories;

use App\Models\Departament;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DepartamentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Departament::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sigla'        => $this->faker->unique()->text($maxNbChars = 10),
            'departamento' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
        ];
    }
}

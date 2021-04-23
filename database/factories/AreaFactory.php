<?php

namespace Database\Factories;

use App\Models\Departament;
use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Area::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'departament_id' => Departament::factory(),
            'nome'      => $this->faker->unique()->word,
        ];
    }
}

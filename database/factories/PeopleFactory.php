<?php

namespace Database\Factories;

use App\Models\People;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Institution;
use App\Models\Designation;

class PeopleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = People::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nusp' => $this->faker->randomNumber($nbDigits = NULL, $strict = false),
            'nome' => $this->faker->name,
            'institution_id' => Institution::inRandomOrder()->pluck('id')->first(),
            'designation_id' => Designation::inRandomOrder()->pluck('id')->first(),
            'endereco' => $this->faker->address,
            'complemento' => $this->faker->text($maxNbChars = 20),
            'cidade' => $this->faker->city,
            'estado' => array_rand(People::estadoOptions()),
            'cep' => $this->faker->postcode,
            'identidade' => $this->faker->rg,
            'pispasep' => $this->faker->randomNumber($nbDigits = NULL, $strict = false),
            'cpf' => $this->faker->cpf,
            'passaport' => $this->faker->randomNumber($nbDigits = NULL, $strict = false),
            'observacao' => $this->faker->text($maxNbChars = 50),
        ];
    }
}

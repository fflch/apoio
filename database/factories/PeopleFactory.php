<?php

namespace Database\Factories;

use App\Models\People;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'unidade' => $this->faker->text($maxNbChars = 30),
            'endereco' => $this->faker->address,
            'complemento' => $this->faker->text($maxNbChars = 20),
            'cidade' => $this->faker->city,
            'estado' => $this->faker->state,
            'cep' => $this->faker->postcode,
            'instituicao' => $this->faker->text($maxNbChars = 30),
            'identidade' => $this->faker->rg,
            'pispasep' => $this->faker->randomNumber($nbDigits = NULL, $strict = false),
            'cpf' => $this->faker->cpf,
            'passaport' => $this->faker->randomNumber($nbDigits = NULL, $strict = false),
            'observacao' => $this->faker->text($maxNbChars = 50),
        ];
    }
}

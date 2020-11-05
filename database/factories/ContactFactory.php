<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\People;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'people_id' => People::factory()->create()->id,
            'contact_type_id' => 1,
            'contato' => $this->faker->email,
        ];
    }
}

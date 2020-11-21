<?php

namespace Database\Factories;

use App\Models\ContactPeople;
use App\Models\People;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactPeopleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactPeople::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'people_id' => People::factory()->create()->id,
            'contact_id' => 1,
            'contato' => $this->faker->email,
        ];
    }
}

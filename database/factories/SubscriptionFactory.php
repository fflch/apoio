<?php

namespace Database\Factories;

use App\Models\Subscription;
use App\Models\Contest;
use App\Models\People;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subscription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'contest_id' => Contest::inRandomOrder()->pluck('id')->first(),
            'people_id' => People::inRandomOrder()->pluck('id')->first(),
            'processo' => $this->faker->numerify('Processo #####'),
        ];
    }
}

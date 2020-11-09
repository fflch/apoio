<?php

namespace Database\Factories;

use App\Models\DesignationPeople;
use App\Models\Designation;
use App\Models\People;
use Illuminate\Database\Eloquent\Factories\Factory;

class DesignationPeopleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DesignationPeople::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'designation_id' => Designation::factory(),
            'people_id'     => People::factory(),
        ];
    }
}

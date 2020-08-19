<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Designation;
use Faker\Generator as Faker;

$factory->define(Designation::class, function (Faker $faker) {
    return [
        'titulo' => $faker->unique()->text($maxNbChars = 20),
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Departament;
use Faker\Generator as Faker;

$factory->define(Departament::class, function (Faker $faker) {
    return [
        'sigla'        => $faker->unique()->text($maxNbChars = 10),
        'departamento' => $faker->sentence($nbWords = 3, $variableNbWords = true),
    ];
});

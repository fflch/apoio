<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Institution;
use Faker\Generator as Faker;

$factory->define(Institution::class, function (Faker $faker) {
    $institution = new Institution;
    return [
        'sigla'    => $faker->text($maxNbChars = 10),
        'nome'     => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'unidade'  => $faker->sentence($nbWords = 2, $variableNbWords = true),
        'local'    => $faker->sentence,
    ];
});

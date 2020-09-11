<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Departament;
use App\Area;
use Faker\Generator as Faker;

$factory->define(Area::class, function (Faker $faker) {
    return [
        'departament_id' => factory(Departament::class)->create()->id,
        'area'      => $faker->name,
    ];
});

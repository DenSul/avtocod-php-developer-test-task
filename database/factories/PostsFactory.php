<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Posts::class, function (Faker $faker) {
    return [
        'text'       => $faker->realText(),
    ];
});

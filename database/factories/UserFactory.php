<?php

use Faker\Generator as Faker;

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name'  => $faker->name,
        'login' => $faker->firstName . $faker->lastName, //$faker->unique()->userName дает точку(
        'password' => '$2y$10$dgnWLmNBK6Jlubh/RMb7Ter8xa4veA34TO291dvJf6Pdt7BXt//FS', // Secret123321
        'remember_token' => str_random(10),
        'is_admin'  => $faker->boolean(),
    ];
});

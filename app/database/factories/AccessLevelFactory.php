<?php

use Faker\Generator as Faker;

$factory->define(App\Models\AccessLevel::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Read', 'Write']),
        'key' => $faker->randomElement(['ready', 'write']),
        'description' => $faker->text(100)
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Calendar::class, function (Faker $faker) {
    return [
        'name' => 'My Calendar',
        'color' => $faker->hexColor,
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Event::class, function (Faker $faker) {
    $isAllDay = $faker->randomElement([1, 0]);
    return [
        'title' => $faker->randomElement([
            'Sprint Planning',
            'Morning Stand up',
            'Unit Tests workshop',
            'PM\'s meeting',
        ]),
        'description' => $faker->text,
        'start_at' => $isAllDay ? null : $faker->dateTime(),
        'end_at' => $isAllDay ? null : $faker->dateTime(),
        'isAllDay' => $isAllDay,
        'timezone' => $faker->timezone,
    ];
});

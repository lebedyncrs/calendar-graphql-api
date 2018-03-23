<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Event::class, function (Faker $faker) {
    $isAllDay = $faker->randomElement([1, 0]);
    return [
        'title' => $faker->randomElement([
            'Sprint Planning',
            'Morning Stand up',
            'Unit Tests workshop',
            'Continuous Integration workshop',
            'Gulp and daily tasks workshop',
            'PM\'s meeting',
            'Team Lunch',
            'OKR\' planning',
            'Business Development Team presentation'
        ]),
        'description' => $faker->text,
        'start_at' => $isAllDay ? null : $faker->dateTime(),
        'end_at' => $isAllDay ? null : $faker->dateTime(),
        'is_all_day' => $isAllDay,
        'timezone' => $faker->timezone,
    ];
});

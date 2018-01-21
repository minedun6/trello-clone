<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Story::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'description' => $faker->paragraph,
        'due_date' => $faker->dateTimeBetween('now', 'next year'),
        'group_id' => random_int(1, 3),
    ];
});

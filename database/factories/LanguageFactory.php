<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Language::class, function (Faker $faker) {
    return [
        'code' => $faker->languageCode,
        'name' => $faker->word,
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Book::class, function (Faker $faker) {
    return [
        'title' => $faker->words(3, true),
        'description' => $faker->paragraph,
        'publisher' => $faker->word,
        'price' => $faker->numberBetween(5, 25),
        'country_code' => $faker->countryCode,
        'language_code' => $faker->languageCode,
        'author_id' => 1,
    ];
});

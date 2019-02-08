<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Author::class, function (Faker $faker) {
    return [
        'last_name' => $faker->lastName,
        'first_name' => $faker->firstName,
        'date_of_birth' => $faker->dateTimeThisCentury->format('Y-m-d'),
        'homepage' => $faker->url,
        'country_code' => $faker->countryCode,
    ];
});

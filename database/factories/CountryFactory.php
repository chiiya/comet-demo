<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Country::class, function (Faker $faker) {
    return [
        'code' => $faker->countryCode,
        'name' => $faker->country,
    ];
});

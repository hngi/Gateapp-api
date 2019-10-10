<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Estate;
use Faker\Generator as Faker;

$factory->define(Estate::class, function (Faker $faker) {
    return [
        'estate_name' => $faker->secondaryAddress(),
        'country' => $faker->country(),
        'city' => $faker->city()
    ];
});

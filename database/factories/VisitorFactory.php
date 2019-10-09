<?php

// * @var \Illuminate\Database\Eloquent\Factory $factory 

use App\Visitor;

use Faker\Generator as Faker;

use Illuminate\Support\Str;

$factory->define(Visitor::class, function (Faker $faker) {
    return [
        'visitor_name' => $faker->name,
        'arrival_date' => $faker->date('Y-m-d', $max = 'now'),
        'user_id'	   => $faker->unique()->numberBetween(1, App\User::count()),
        'car_plate_no' => $faker->realText(rand(10,20)),
        'purpose' 	   => $faker->sentence(3, true, 'none'),
        'status' 	   => $faker->randomDigitNotNull,
    ];
});
<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service_Provider;
use Faker\Generator as Faker;

$factory->define(Service_Provider::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => Str::random(10),
        'description' => Str::random(40), 
        'image' => Str::random(20), 
        'estate_id' => rand(1, 5), 
        'category_id' => function () {
            return factory(App\Category::class)->create()->id;
        }
    ];
});

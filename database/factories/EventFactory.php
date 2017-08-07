<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(nullx27\Herald\Models\Event::class, function (Faker $faker) {
    static $password;

    return [
        'title' => $faker->text(30),
        'description' => $faker->text(150),
        'due' => \Carbon\Carbon::now()->addDay(rand(1,10)),
        'user_id' => 1,
    ];
});

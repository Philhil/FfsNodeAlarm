<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Node::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'mac' => str_random(10),
    ];
});

$factory->define(App\Nodestat::class, function (Faker\Generator $faker) {
    return [
        'isonline' => $faker->boolean(50),
        'clientcount' => $faker->numberBetween(0,20),
    ];
});

$factory->define(App\Task::class, function (Faker\Generator $faker) {
    return [
        'intervall' => $faker->numberBetween(1,100),
        'active' => $faker->boolean(50),
    ];
});

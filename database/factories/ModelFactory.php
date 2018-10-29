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
        'name' => $faker->asciify('ffs-*********'),
        'mac' => $faker->macAddress
    ];
});

$factory->define(App\Nodestat::class, function (Faker\Generator $faker) {
    return [
        'isonline' => $faker->boolean(50),
        'clientcount' => $faker->numberBetween(0,20),
    ];
});

$factory->defineAs(App\Nodestat::class, 'up', function (Faker\Generator $faker) use ($factory) {
    $nodestat = $factory->raw(App\Nodestat::class);

    return array_merge($nodestat, ['isonline' => true]);
});

$factory->defineAs(App\Nodestat::class, 'down', function (Faker\Generator $faker) use ($factory) {
    $nodestat = $factory->raw(App\Nodestat::class);

    return array_merge($nodestat, ['isonline' => false]);
});

$factory->define(App\Task::class, function (Faker\Generator $faker) {
    return [
        'intervall' => \Carbon\Carbon::createFromTime($faker->numberBetween(0, 23), $faker->numberBetween(0, 59)),
        'active' => $faker->boolean(50),
    ];
});

$factory->defineAs(App\Task::class, 'active', function (Faker\Generator $faker) use ($factory) {
    $task = $factory->raw(App\Task::class);

    return array_merge($task, ['active' => true]);
});

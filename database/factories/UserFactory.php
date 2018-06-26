<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->unique()->firstName,
        'email' => strtolower($name).'@gmail.com',
        'password' => 123456,
        'remember_token' => str_random(10),
    ];
});

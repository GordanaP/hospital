<?php

use App\Role;
use Faker\Generator as Faker;

$factory->define(App\Title::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
        'role_id' => Role::all()->random()->id
    ];
});

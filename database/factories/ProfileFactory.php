<?php

use App\Services\Utilities\ProfileTitle;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Profile::class, function (Faker $faker) {

    $titles = array_keys(ProfileTitle::all());

    return [
        'user_id' => User::all()->random()->id,
        'title' => $titles[array_rand($titles)],
        'first_name' => $faker->unique()->firstName,
        'last_name' => $faker->unique()->lastName,
    ];
});

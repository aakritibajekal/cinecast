<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'username' => $faker->name,
        'bio' => $faker->paragraph,
        'user_id' => $faker->unique()->randomElement(User::pluck( 'id' )->toArray()),
    ];
});

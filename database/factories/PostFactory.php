<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph,
        'picture' => $faker->imageUrl($width = 640, $height = 480),
        'profile_id' => $faker->randomElement(Profile::pluck( 'id' )->toArray()),
    ];
});

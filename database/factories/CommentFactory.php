<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\User;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph,
        'profile_id' => $faker->randomElement(Profile::pluck( 'id' )->toArray()),
        'post_id' => $faker->randomElement(Post::pluck( 'id' )->toArray()),
    ];
});

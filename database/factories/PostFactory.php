<?php

use App\Models\Post;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'title' => $title = $faker->sentence,
        'slug' => str_slug($title),
        'body' => $faker->paragraph
    ];
});

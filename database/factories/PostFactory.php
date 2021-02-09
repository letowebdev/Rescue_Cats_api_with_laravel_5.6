<?php

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $title = $faker->sentence,
        'slug' => str_slug($title),
        'body' => $faker->paragraph
    ];
});

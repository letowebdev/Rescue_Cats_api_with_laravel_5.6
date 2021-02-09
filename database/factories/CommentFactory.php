<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return factory(User::class)->create()->id;
        },
        'post_id' => function() {
            return factory(Post::class)->create()->id;
        },
        'body' => $faker->sentence
    ];
});

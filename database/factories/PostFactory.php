<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;

use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->paragraph,
        'content' => $faker->text,
        'slug' => $faker->slug,
        'author' => $faker->name,
        'published' => 1,
        'image' => $faker->imageUrl(),
    ];
});

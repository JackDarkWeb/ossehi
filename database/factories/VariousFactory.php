<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Various;

use Faker\Generator as Faker;

$factory->define(Various::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle,
        'user_id' => 4,
        'slug' => $faker->slug(6),
        'description' => $faker->text,
        'image' => $faker->imageUrl()
    ];
});

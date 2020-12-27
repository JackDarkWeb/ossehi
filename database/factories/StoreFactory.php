<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Store;
use Faker\Generator as Faker;

$factory->define(Store::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'slug' => $faker->slug(6),
        'image' => $faker->imageUrl()
    ];
});

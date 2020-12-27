<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\StoreProduct;
use Faker\Generator as Faker;

$factory->define(StoreProduct::class, function (Faker $faker) {

    return [
        'title' => $faker->title,
        'slug' => $faker->slug(6),
        'image' => $faker->imageUrl(),
        'description' => $faker->text(200),
        'price' => 300,
        'colors' => json_encode(['color_1' => $faker->hexColor, 'color_2' => $faker->hexColor, 'color_3' => $faker->hexColor], true),
        'sizes' => json_encode(['size_1' => 'M', 'size_2' => 'L', 'size_3' => 'S', 'size_4' => 'XL'], true),
        'brands' => 'Addidas'
    ];
});

<?php

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'isbn' => $faker->randomNumber(9),
        'price' => $faker->randomNumber(4),
        'currency' => 'HUF'
    ];
});

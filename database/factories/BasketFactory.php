<?php

use App\Models\Basket;
use Faker\Generator as Faker;

$factory->define(Basket::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'product_id' => $faker->numberBetween(1,20)
    ];
});

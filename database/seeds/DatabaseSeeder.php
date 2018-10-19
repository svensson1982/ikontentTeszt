<?php

use App\Models\User;
use App\Models\Basket;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create();
        factory(Basket::class, 10)->create();
        factory(Product::class, 20)->create();
    }
}

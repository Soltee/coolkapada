<?php

namespace Database\Seeders;

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
        \App\Models\Customer::factory(10)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Product::factory(40)->create();
        \App\Models\ProductImages::factory(80)->create();
    }
}

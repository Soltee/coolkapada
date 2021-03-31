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
        \App\Models\Admin::factory()->create([
            'first_name'         => 'Kamal',
	        'last_name'          => 'Grg',
	        'email'              => 'kamal@gmail.com',
	        'email_verified_at'  => now(),
	        'password'           => bcrypt('11111111'),
	        // 'password' => bcrypt('#$rvU_@$%URT'),
	        'remember_token'     => \Illuminate\Support\Str::random(10),
        ]);
        
        \App\Models\Customer::factory(10)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Product::factory(40)->create();
        \App\Models\ProductImages::factory(80)->create();
        \App\Models\Order::factory(100)->create();
        \App\Models\OrderItem::factory(200)->create();
    }
}

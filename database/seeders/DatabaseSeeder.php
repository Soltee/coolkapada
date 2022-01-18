<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Admin::create([
        //     'first_name'         => 'Prabin',
        //     'last_name'          => 'grg',
        //     'email'              => 'soltee.13@gmail.com',
        //     'email_verified_at'  => now(),
        //     'password'           => bcrypt('22222222'),
        //     // 'password' => bcrypt('#$rvU_@$%URT'),
        //     'remember_token'     => \Illuminate\Support\Str::random(10),
        // ]);
        // \App\Models\Customer::create([
        //    'first_name'         => 'Test',
        //     'last_name'          => 'test',
        //     'email'              => 'test@gmail.com',
        //     'email_verified_at'  => now(),
        //     'password'           => bcrypt('11111111'),
        //     // 'password' => bcrypt('#$rvU_@$%URT'),
        //     'remember_token'     => \Illuminate\Support\Str::random(10),
        // ]);

        \App\Models\Admin::factory()->create([
            'first_name'         => 'Kamal',
	        'last_name'          => 'Grg',
	        'email'              => 'kamal@gmail.com',
	        'email_verified_at'  => now(),
	        'password'           => bcrypt('11111111'),
	        // 'password' => bcrypt('#$rvU_@$%URT'),
	        'remember_token'     => \Illuminate\Support\Str::random(10),
        ]);
        \App\Models\Admin::factory()->create([
            'first_name'         => 'Prabin',
	        'last_name'          => 'grg',
	        'email'              => 'soltee.13@gmail.com',
	        'email_verified_at'  => now(),
	        'password'           => bcrypt('22222222'),
	        // 'password' => bcrypt('#$rvU_@$%URT'),
	        'remember_token'     => \Illuminate\Support\Str::random(10),
        ]);

        \App\Models\Customer::factory()->create([
            'first_name'         => 'Test',
	        'last_name'          => 'test',
	        'email'              => 'test@gmail.com',
	        'email_verified_at'  => now(),
	        'password'           => bcrypt('11111111'),
	        // 'password' => bcrypt('#$rvU_@$%URT'),
	        'remember_token'     => \Illuminate\Support\Str::random(10),
        ]);
        
        \App\Models\Customer::factory(2)->create();

        \App\Models\Category::factory()->create(['name' => 'Tops', 'slug'  => 'tops']);
        \App\Models\Category::factory()->create(['name' => 'Dressess', 'slug' => 'dress']);
        \App\Models\Category::factory()->create(['name' => 'Jeans', 'slug' => 'jeans']);
        \App\Models\Category::factory()->create(['name' => 'Shorts', 'slug' => 'shorts']);
        \App\Models\Category::factory()->create(['name' => 'Swims', 'slug' => 'swims']);
        \App\Models\Category::factory()->create(['name' => 'Leggings', 'slug' => 'leggings']);

        // \App\Models\Category::create(['name' => 'Tops', 'slug'  => 'tops']);
        // \App\Models\Category::create(['name' => 'Dressess', 'slug' => 'dress']);
        // \App\Models\Category::create(['name' => 'Jeans', 'slug' => 'jeans']);
        // \App\Models\Category::create(['name' => 'Shorts', 'slug' => 'shorts']);
        // \App\Models\Category::create(['name' => 'Swims', 'slug' => 'swims']);
        // \App\Models\Category::create(['name' => 'Leggings', 'slug' => 'leggings']);


        for ($i=0; $i <= 10 ; $i++) { 
            $url    =  \Illuminate\Support\Arr::random([
                    'storage/products/dress1.webp',
                    'storage/products/dress2.webp',
                    'storage/products/dress3.webp',
                    'storage/products/dress4.webp',
                    'storage/products/dress5.webp',
                    'storage/products/dress6.webp',
                    'storage/products/jeans3.webp',
                    'storage/products/jeans4.webp',
                    'storage/products/jeans5.webp',
                    'storage/products/jeans6.webp',
                    'storage/products/jeans7.webp',
                    'storage/products/jeans8.webp',
                    'storage/products/jeans9.webp',
                    'storage/products/jeans10.webp',
                    'storage/products/jeans11.webp',
                    'storage/products/jeans12.webp',
                    'storage/products/jeans1.webp',
                    'storage/products/jeans2.webp',
                    'storage/products/shorts1.webp',
                    'storage/products/shorts2.webp',
                    'storage/products/shorts3.webp',
                    'storage/products/shorts4.webp',
                    'storage/products/shorts5.webp',
                    'storage/products/shorts6.webp',
                    'storage/products/shorts7.webp',
                    'storage/products/shorts8.webp',
                    'storage/products/shorts9.webp',
                    'storage/products/shorts10.webp',
                    'storage/products/shorts11.webp',
                    'storage/products/shorts12.webp',
                    'storage/products/swim1.webp',
                    'storage/products/swim2.webp',
                    'storage/products/swim3.webp',
                    'storage/products/tops1.webp',
                    'storage/products/tops2.webp',
                    'storage/products/tops3.webp',
                    'storage/products/tops4.webp',
                    'storage/products/tops5.webp',
                    'storage/products/tops6.webp',
                    'storage/products/tops7.webp',
                    'storage/products/tops8.webp',
                    'storage/products/tops9.webp',
                    'storage/products/tops10.webp',
                    'storage/products/tops11.webp',
                    
                ]);

                \App\Models\Media::create([
                    'image_url'  => $url,
                    'thumbnail'  => $url
                ]);

        }


        $pds = \App\Models\Product::factory(20)->create();
        foreach($pds as $p){
            $rm = \Illuminate\Support\Arr::random([0,1,2,3]);

            $imgs = \App\Models\ProductImage::factory(3)->create([
                'product_id' => $p->id
            ]);

            foreach($imgs as $i){
                \App\Models\Attribute::factory(3)->create([
                        'product_image_id'   => $i->id,
                        'product_id'        => $p->id
                    ]);   
            }

            //Min Max Price
            $min = $p->attributes()->min('price');
            $max = $p->attributes()->max('price');
            $p->update([
                'stock'  => $p->attributes()->sum('quantity'),
                'min'   => $min,
                'max'   => $max
            ]);

            //Customers
            $cs    = \App\Models\Customer::inRandomOrder()
                                        ->pluck('id')
                                        ->toArray();

            $csRm =  \Illuminate\Support\Arr::random($cs);

            $ods = \App\Models\Order::factory($rm)->create([
                'customer_id' => $csRm
            ]);

            foreach($ods as $o){
                $rm = \Illuminate\Support\Arr::random([0,1,2,3]);
                \App\Models\OrderItem::factory($rm)->create([
                    'order_id'      => $o->id,
                    'product_id'    => $p->id,
                    'customer_id'   => $csRm,
                    'image_url'     => $p->media->image_url,
                ]);
            }
        }

        \App\Models\Newsletter::factory(12)->create();
        \App\Models\Review::factory(100)->create();
        // \App\Models\ProductImage::factory(80)->create();
        // \App\Models\Attribute::factory(400)->create();
        // \App\Models\Order::factory(200)->create();
        // \App\Models\OrderItem::factory(200)->create();
    }
}

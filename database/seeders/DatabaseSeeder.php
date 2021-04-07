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
        
        \App\Models\Customer::factory(10)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Media::factory(100)->create();
        

        $pds = \App\Models\Product::factory(40)->create();
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
                'min'   => $min,
                'max'   => $max
            ]);

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
                    'customer_id'   => $csRm
                ]);
            }
        }

        \App\Models\Newsletter::factory(30)->create();
        // \App\Models\ProductImage::factory(80)->create();
        // \App\Models\Attribute::factory(400)->create();
        // \App\Models\Order::factory(200)->create();
        // \App\Models\OrderItem::factory(200)->create();
    }
}

<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->firstName . $this->faker->unique(true)->numberBetween(1, 100);
        return [
            'category_id' => function(){
                $category = Category::inRandomOrder()->pluck('id')->toArray();
                return  \Illuminate\Support\Arr::random($category);
            },
            'image_url' => function(){
                $image = [
                    'storage/products/1.webp',
                    'storage/products/2.webp',
                    'storage/products/3.webp',
                    'storage/products/4.webp',
                    'storage/products/5.webp',
                    'storage/products/6.webp',
                    'storage/products/7.webp',
                    'storage/products/8.webp',
                    'storage/products/9.webp',
                    'storage/products/10.webp',
                    'storage/products/12.webp',
                ];
                return  \Illuminate\Support\Arr::random($image);
            },
            'name'    => $title,
            'slug'    => Str::slug($title),
            'prev_price'    => $this->faker->unique(true)->numberBetween(50, 100),
            'price'    => $this->faker->unique(true)->numberBetween(2, 100),
            'qty'    => $this->faker->unique(true)->numberBetween(1, 30),
            'sold'    => $this->faker->unique(true)->numberBetween(1, 30),
            'sizes'    => function(){
                
                $sizes = ['XS, L', 'S, L, XL', 'XS, S, XL', 'XS, S, L, XL'];
    
                return \Illuminate\Support\Arr::random($sizes);
            },
            'colors' => function(){
                $cs = ['#000000', '#000000,#DEDCD9', '#FF0000, #000000', '#00FF10,#FF0000,#DEDCD9'];
    
                return \Illuminate\Support\Arr::random($cs);
            },
            'description' => $this->faker->text($maxNbChars = 500),
            'created_at'    => function(){
                $dates = [1,2,3,5,8, 10, 20];
                return  \Illuminate\Support\Arr::random($dates);
            },
            'featured'    => function(){
                $bools = [true, false];
                return \Illuminate\Support\Arr::random($bools);
            }
        ];
    }

}

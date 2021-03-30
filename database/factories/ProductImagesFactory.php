<?php

namespace Database\Factories;

use App\Models\ProductImages;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductImagesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductImages::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'product_id' => function(){
                $category = Product::inRandomOrder()->pluck('id')->toArray();
                return  \Illuminate\Support\Arr::random($category);
            },
            'image_url'    => function(){
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
            'thumbnail' => function(){
                $thumb = [
                    '1.webp',
                    '2.webp',
                    '3.webp',
                    '4.webp',
                    '5.webp',
                    '6.webp',
                    '7.webp',
                    '8.webp',
                    '9.webp',
                    '10.webp',
                    '12.webp',
                ];
                return  \Illuminate\Support\Arr::random($thumb);
            },
            'color' =>  function(){
                $cs = ['#000000', '#DEDCD9', '#FF0000', '#00FF10', '#DEC66C'];
    
                return \Illuminate\Support\Arr::random($cs);
            }
        ];
    }

    
}

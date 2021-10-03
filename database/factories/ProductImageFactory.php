<?php

namespace Database\Factories;

use App\Models\ProductImage;
use App\Models\Product;
use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductImage::class;

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
            'media_id' => function(){
                $media = Media::inRandomOrder()->pluck('id')->toArray();
                return  \Illuminate\Support\Arr::random($media);
            },
            'color' =>  function(){
                $cs = ['#000000', '#DEDCD9', '#FF0000', '#00FF10', '#DEC66C'];
                return \Illuminate\Support\Arr::random($cs);
            }
        ];
    }

    
}

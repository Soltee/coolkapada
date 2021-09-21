<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attribute::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => function(){
                $prod = Product::inRandomOrder()->pluck('id')->toArray();
                return  \Illuminate\Support\Arr::random($prod);
            },
            'identifier_id' => function(){
                return random_int(1000, 10000000);
            },
            'product_image_id' => function(){
                $image = ProductImage::inRandomOrder()->pluck('id')->toArray();
                return  \Illuminate\Support\Arr::random($image);
            },
            'size' =>  function(){
                $cs = ['S', 'L', 'XS', 'M', 'XL'];
    
                return \Illuminate\Support\Arr::random($cs);
            },
            'price'       => $this->faker->unique(true)->numberBetween(2, 100),
            'quantity'    => $this->faker->unique(true)->numberBetween(0, 4),
            
        ];
    }
}

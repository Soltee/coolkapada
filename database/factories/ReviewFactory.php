<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => function(){
                $p = Product::inRandomOrder()->pluck('id')->toArray();
                return  \Illuminate\Support\Arr::random($p);
            },
            'customer_id' => function(){
                $c = Customer::inRandomOrder()->pluck('id')->toArray();
                return  \Illuminate\Support\Arr::random($c);
            },
            'rating'  => function(){
                return random_int(3.5, 5);
            },
            'comment'  => $this->faker->text($maxNbChars = 500),
            'status'  => function(){
                return Arr::random([0,1]);
            }
        ];
    }
}

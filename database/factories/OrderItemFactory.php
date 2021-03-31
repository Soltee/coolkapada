<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class OrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => function(){
                $customers = Customer::inRandomOrder()->pluck('id')->toArray();
                return  Arr::random($customers);
            },
            'order_id' => function(){
                $orders = Order::inRandomOrder()->pluck('id')->toArray();
                return  Arr::random($orders);
            },
            'product_id' => function(){
                $product = Product::inRandomOrder()->pluck('id')->toArray();
                return  Arr::random($product);
            },
            'image_url' => function(){
                $url = Product::inRandomOrder()->pluck('image_url')->toArray();
                return  Arr::random($url);
            },
            'name' => function(){
                $names = Product::inRandomOrder()->pluck('name')->toArray();
                return  Arr::random($names);
            },
            'price' => function(){
                $prices = Product::inRandomOrder()->pluck('price')->toArray();
                return  Arr::random($prices);
            },
            'qty' => function(){
                $quantities = Product::inRandomOrder()->pluck('qty')->toArray();
                return  Arr::random($quantities);
            },
            'total' => function(){
                $price = Product::inRandomOrder()->pluck('price')->toArray();
                $quantities = Product::inRandomOrder()->pluck('qty')->toArray();
                $p = Arr::random($price);
                $q = Arr::random($quantities);
    
                return $p * $q;
            },
            'created_at' => function(){
                return \Carbon\Carbon::now()->subDays(rand(0, 20))->format('Y-m-d');
            }
        ];
    }
}

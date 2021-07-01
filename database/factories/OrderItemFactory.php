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
        $product = Product::inRandomOrder()->with('media')->first();

        $price = Arr::random([8,4,10,20,329.9,899.9]);
        $qty   = Arr::random([1,2,3]);
        return [
            'customer_id' => function(){
                $customers = Customer::inRandomOrder()->pluck('id')->toArray();
                return  Arr::random($customers);
            },
            'order_id' => function(){
                $orders = Order::inRandomOrder()->pluck('id')->toArray();
                return  Arr::random($orders);
            },
            'product_id' => $product->id,
            // 'image_url'  => $product->media->image_url,
            'name'  => $product->name,
            'price' => $price,
            'qty'   => $qty,
            'total' => function() use($price, $qty) {
                return $price * $qty;
            },
            'created_at' => function(){
                return \Carbon\Carbon::now()->subDays(rand(0, 20))->format('Y-m-d');
            }
        ];
    }
}

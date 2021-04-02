<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

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
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email'     => $this->faker->email,
            'phone_number' => $this->faker->phoneNumber,
            'city' => $this->faker->city,
            'street_address' => $this->faker->streetAddress ,
            'house_number' => $this->faker->unique(true)->numberBetween($min = 500, $max = 1200) ,
            'payment_method' => function(){
                $methods = ['khalti', 'e-sewa', 'cash-on-delivery'];
                return Arr::random($methods);
                // $table->enum('payment_method', ['khalti', 'e-sewa', 'cash-on-delivery']);
            },
            'payment_id' => $this->faker->bankAccountNumber,
            'sub_total' => $this->faker->unique(true)->numberBetween($min = 100, $max = 300),
            'discount' => $this->faker->unique(true)->numberBetween($min = 10, $max = 100),
            'sub_after_discount' => $this->faker->unique(true)->numberBetween($min = 100, $max = 400),
            'tax' => 200,
            'grand_total' => $this->faker->unique(true)->numberBetween($min = 500, $max = 1200),
            'created_at' => function(){
                return \Carbon\Carbon::now()->subDays(rand(0, 20))->format('Y-m-d');
            },
            'is_paid' => function(){
                $methods = [true, false];
                return Arr::random($methods);
            }
        ];
    }
}

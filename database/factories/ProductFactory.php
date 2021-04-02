<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Media;
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
            'media_id' => function(){
                $media = Media::inRandomOrder()->pluck('id')->toArray();
                return  \Illuminate\Support\Arr::random($media);
            },
            'name'    => $title,
            'slug'    => Str::slug($title),
            'sold'    => $this->faker->unique(true)->numberBetween(1, 30),
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

<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image_url'    => function(){
                $image = [
                    'storage/products/13.webp',
                    'storage/products/14.webp',
                    'storage/products/15.webp',
                    'storage/products/16.webp',
                    'storage/products/17.webp',
                    'storage/products/18.webp',
                    'storage/products/19.webp',
                    'storage/products/20.webp',
                    'storage/products/21.webp',
                    'storage/products/22.webp',
                    'storage/products/23.webp',
                    'storage/products/24.webp',
                    'storage/products/25.webp',
                    'storage/products/26.webp',
                    'storage/products/27.webp',
                    'storage/products/28.webp',
                    'storage/products/29.webp',
                    'storage/products/31.webp',
                    'storage/products/32.webp'
                ];
                return  \Illuminate\Support\Arr::random($image);
            
            },
            'thumbnail'    => function(){
                $image = [
                    '13.webp',
                    '14.webp',
                    '15.webp',
                    '16.webp',
                    '17.webp',
                    '18.webp',
                    '19.webp',
                    '20.webp',
                    '21.webp',
                    '22.webp',
                    '23.webp',
                    '24.webp',
                    '25.webp',
                    '26.webp',
                    '27.webp',
                    '28.webp',
                    '29.webp',
                    '31.webp',
                    '32.webp',
                ];
                return  \Illuminate\Support\Arr::random($image);
            
            }
        ];
    }
}

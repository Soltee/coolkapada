<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, UsesUuid;

    protected $guarded = [];
    public $incrementing = false;

    public function category()
    {
    	return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function isMenApparel(){
        return $this->category->name === 'Men';
    }

    public function isWomenApparel(){
        return $this->category->name === 'Women';
    }

    public function media()
    {
    	return $this->belongsTo(Media::class);
    }

    public function images()
    {
    	return $this->hasMany(ProductImage::class);
    }

    public function attributes()
    {
    	return $this->hasMany(Attribute::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    //Return Attribute coount
    public function checkAttribute()
    {
        return $this->attributes()->count();
    }

    public function stock_level()
    {
        if($this->qty < 1){
            return '<span class="px-2 py-2 rounded-lg text-white bg-red-600">Out of Stock</span>';
        } else if( $this->qty >= 1 AND $this->qty <=3 )
        {
            return '<span class="px-2 py-2 rounded-lg text-white bg-gray-600">Low Stock</span>';
        } elseif($this->qty > 3){
            return '<span class="px-2 py-2 rounded-lg text-white bg-green-600">In Stock</span>';
        }


    }

    public function price_level()
    {
        if($this->prev_price > 0) {
            return  abs(round(( ($this->prev_price - $this->price)  / $this->prev_price * 100 ), 0));

        } else {
            return 0;
        }

    }



}

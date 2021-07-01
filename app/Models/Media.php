<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory, UsesUuid;

    protected $guarded = [];
    public $incrementing = false;
    
    public function product()
    {
        return $this->hasOne(Product::class);
    }
    public function productImage()
    {
        return $this->hasOne(ProductImage::class);
    }

}

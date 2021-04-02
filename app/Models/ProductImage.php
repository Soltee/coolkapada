<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

    public function media()
    {
    	return $this->belongsTo(Media::class);
    }

    public function attributes(){
        return $this->hasMany(Attribute::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory, UsesUuid;

    protected $guarded = [];
    public $incrementing = false;

    public function image(){
        return $this->belongsTo(ProductImages::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}

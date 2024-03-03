<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, UsesUuid;

    protected $guarded = [];
    public $incrementing = false;

    public function products()
    {
    	return $this->hasMany(Product::class);
    }

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function children(){
        return $this->hasMany(Category::class, "parent_id", "id");
    }

    public function childrenCount(){
        return $this->children->count();
    }
}

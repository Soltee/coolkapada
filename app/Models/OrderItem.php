<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory, UsesUuid;


    protected $guarded = [];
    public $incrementing = false;

    public function order()
    {
    	return $this->belongsTo(Order::class);
    }

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}

<?php

namespace App\Http\Livewire\Admin\Attribute;

use Livewire\Component;
use App\Models\ProductImage;
use App\Models\Product;
use App\Models\Attribute;

class Create extends Component
{
    public $image;
    public $product;

    public $size;
    public $quantity;
    public $price;

    public $message;

    public function mount(ProductImage $productImage)
    {
        $this->product       = $productImage->product;
        $this->image         = $productImage;
    }
    
    public function render()
    {
        return view('livewire.admin.attribute.create', [
            'attributes'   => $this->image->attributes()->get()
        ]);
    }

    public function saveAttribute()
    {
        $this->message = '';

        $this->validate([
                'size'       => 'required|string',
                'price'      => 'required|int',
                'quantity'   => 'required|int',
            ]);

        $this->image->attributes()->create([
            'product_id' => $this->product,
            'size'       => $this->size,
            'price'      => $this->price,
            'quantity'   => $this->quantity
        ]);

            $this->size     = '';
            $this->price    = '';
            $this->quantity = '';
            $this->message   = 'Attribute Uploaded';
    }

    /**
     * Delete Attribute
     */
    public function deleteAttribute($id)
    {
        $a = Attribute::findOrfail($id);
        $a->delete();
        $this->message  = 'Attribute Deleted';
    }
   
}

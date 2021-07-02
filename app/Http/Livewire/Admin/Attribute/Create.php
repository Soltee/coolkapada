<?php

namespace App\Http\Livewire\Admin\Attribute;

use Livewire\Component;
use App\Models\ProductImage;
use App\Models\Product;
use App\Models\Attribute;

use Illuminate\Support\Str;

class Create extends Component
{
    public $image;
    public $product;
    public $published = false;

    public $size;
    public $quantity;
    public $price;

    public $message;
    public $attr_id = '';

    public function mount(ProductImage $productImage)
    {
        $this->product       = $productImage->product;
        $this->image         = $productImage;
        $this->published     = ($this->product->published) ? true : false; 
    }
    
    public function render()
    {
        return view('livewire.admin.attribute.create', [
            'attributes'   => $this->image->attributes()->get(),
            'published'    => $this->published
        ]);
    }

    public function saveAttribute()
    {
        $this->message = '';

        $this->validate([
                'size'       => 'required|string|min:1|max:3',
                'price'      => 'required|int',
                'quantity'   => 'required|int',
            ]);

        //Create Attr
        $a = $this->image->attributes()->create([
            'product_id' => $this->product->id,
            'size'       => Str::upper($this->size),
            'price'      => $this->price,
            'quantity'   => $this->quantity
        ]);

        $this->updateProductMinMax();

        $this->size     = '';
        $this->price    = '';
        $this->quantity = '';
        $this->message   = 'Attribute Added';
    }

    

    /**
     * Update Product Min and Max value 
     */
    public function updateProductMinMax()
    {
        //Update Product mIn and max value
        $min = $this->product->attributes()->min('price');
        $max = $this->product->attributes()->max('price');

        $this->product->update([
            'min'   => $min,
            'max'   => $max
        ]);

    }
}

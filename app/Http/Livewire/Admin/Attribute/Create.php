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
                'size'       => 'required|string',
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

        //Update Product mIn and max value
        $min = $this->product->attributes()->min('price');
        $max = $this->product->attributes()->max('price');

        $this->product->update([
            'min'   => $min,
            'max'   => $max
        ]);

            $this->size     = '';
            $this->price    = '';
            $this->quantity = '';
            $this->message   = 'Attribute Added';
    }

    /**
     * Delete Attribute
     */
    public function deleteAttribute($id)
    {
        $a = Attribute::findOrfail($id);
        $a->delete();

        //Remove Min Max from product if no attributes
        if($this->product->doesnthave('attributes')){
            $this->product->update([
                'min' => 0,
                'max' => 0,
            ]);
        }
        $this->message  = 'Attribute Deleted';
    }

    /**
     * Publish & Unpublish product for the world to see
     */
    public function toggleProductVisibility()
    {
        $this->product->update([
            'published'  => !$this->product->published
        ]);

        session()->flash('success', 'Product visibility updated.');
        return redirect('admin/products/'. $this->product->id);
    }
   
}

<?php

namespace App\Http\Livewire\Admin\ProductImage;

use Livewire\Component;
use App\Models\Product;
use App\Models\Media;
use App\Models\ProductImage as I;

class Edit extends Component
{
    protected $listeners = ['receiveMedia', 'fromAttribute', 'closeMedia'];

    public $product;
    public $published;
    public $image;
    public $media_url;
    protected $rules = [
        'color'     => 'required|string'
    ];

    public $showImages = false;

    public $media;
    public $color;
    public $step = 1;
    public $message;


    public function mount(Product $product, I $i)
    {
        $this->product    = $product;
        $this->image      = $i;
        $this->media      = $i->media->id;
        $this->media_url  = $i->media->image_url;
        $this->color      = $i->color;
        $this->published  = $product->published;
    }

    public function render()
    {
        return view('livewire.admin.product-image.edit', [

            ]);
    }

    public function editProductImage()
    {
        $this->message = '';
        $this->validate();
                
        $this->image->update([
            'product_id'  =>  $this->product->id,
            'media_id'    =>  $this->media,
            'color'       =>  $this->color
        ]);

        $this->skiptoAttribute();
                
    }

    public function skiptoAttribute()
    {
        $this->step = 2;
    }


    public function receiveMedia($id)
    {
        $m                 = Media::findOrfail($id);
        $this->media_url   = $m->image_url;
        $this->media       = $m->id;
        $this->showImages  = false;
    }

    public function closeMedia()
    {
        $this->showImages = false;
    }

    /**
     * Get Return Signal from Attribute Create Component
     */
    public function fromAttribute()
    {
        $this->step = 1;
    }

     /**
     * Publish & Unpublish product for the world to see
     */
    public function toggleProductVisibility()
    {
        $this->product->update([
            'published'  => !$this->product->published
        ]);

        // $this->message = 'Product visibility updated';
        session()->flash('success', 'Product visibility updated.');
        return redirect('admin/products/'. $this->product->id);
    
    }

    /**
     * Delete Product Image with their all attributes
     */
    public function deleteProductImage($id)
    {
        $i = I::findOrfail($id);
        foreach($i->attributes as $a){
            $a->delete();
        }
    
        $i->delete();

        if($this->product->has('attributes')){
            $this->updateProductMinMax();
        }

        session()->flash('success', 'Product image deleted with attributes.');
        return redirect('admin/products/'. $this->product->id);
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

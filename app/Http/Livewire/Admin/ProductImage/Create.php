<?php

namespace App\Http\Livewire\Admin\ProductImage;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductImage as I;

class Create extends Component
{
    protected $listeners = ['receiveMedia', 'fromAttribute'];
    
    public $product;
    public $published;

    public $media;
    public $color;
    public $image;
    
    public $step = 1;
    public $message;


    public function mount(Product $product)
    {
        $this->product    = $product;
        $this->published  = $product->published;
    }
    
    public function render()
    {
        $this->message = '';
        return view('livewire.admin.product-image.create', [
            'images'   => $this->product->images()->with('media')->get()
        ]);
    }

    public function saveImage()
    {
        // dd($this->media);
        $this->message = '';
        $this->validate([
            'media'     => 'required',
            'color'     => 'required|string'    
        ]);
                
        $image = $this->product->images()->create([
            'media_id'    =>  $this->media,
            'color'       =>  $this->color
        ]);

        $this->image        = $image->id;
        $this->step         = 2;
    }

    /**
     * Get MediaId from Media Component
     */
    public function receiveMedia($id)
    {
        $this->media = $id;
        // dd($id);
    }

    /**
     * Next Step -Got o Create Attribute for Image
     */
    public function nextStep($img)
    {
        $this->image = $img;
        $this->step  = 2;
    }

    /**
     * Get Return Signal from Attribute Create Component
     */
    public function fromAttribute()
    {
        $this->step = 1;
    }

    /**
     * Delete Product Image
     */
    public function deleteImage($id)
    {
        $i = I::findOrfail($id);
        foreach($i->attributes as $att)
        {
            $att->delete();
        }
        $i->delete();

        if($this->product->has('attributes')){
            $this->updateProductMinMax();
        }

        $this->message  = 'Image Deleted';
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
        return redirect('admin/products/'. $this->product->id . '/images/create');
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

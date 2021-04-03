<?php

namespace App\Http\Livewire\Admin\ProductImage;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    protected $listeners = ['mediaId', 'fromAttribute'];
    protected $rules = [
            'color'     => 'required|string|unique:product_images'
        ];
        
    public $product;
    
    public $media;
    public $color;
    public $image;
    
    public $step = 1;

    public function mount($product)
    {
        $this->product    = $product;

    }
    public function render()
    {
        return view('livewire.admin.product-image.create');
    }

    public function saveImage()
    {
        $this->validate();
        
        $p = Product::findOrfail($this->product);
        
        $image = $p->images()->create([
            'media_id'    =>  $this->media,
            'color'       =>  $this->color
        ]);

        $this->image        = $image->id;
        $this->step         = 2;
    }

    /**
     * Get MediaId from Media Component
     */
    public function mediaId($id)
    {
        $this->media = $id;
    }

    /**
     * Get Return Signal from Attribute Create Component
     */
    public function fromAttribute()
    {
        $this->step = 1;
    }


}

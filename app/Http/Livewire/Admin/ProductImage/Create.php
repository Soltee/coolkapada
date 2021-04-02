<?php

namespace App\Http\Livewire\Admin\ProductImage;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $product;
    protected $rules = [
        'size'      => 'required|string',
        'price'     => 'required|int',
        'quantity'  => 'required|int'
    ];


    public $image;
    public $color;

    public $image_id;

    public $size;
    public $quantity;
    public $price;

    public $message;

    public function mount(Product $product)
    {
        $this->product    = $product->id;

    }
    public function render()
    {
        return view('livewire.admin.product-image.create');
    }

    public function store()
    {
        $this->validate([
            'image'     => 'required|image',
            'color'     => 'required|string',
            'size'      => 'required|string',
            'price'     => 'required|int',
            'quantity'  => 'required|int',
        ]);
        
        $p = Product::findOrfail($this->product);
        
        $image = $p->images()->create([
            'image_url'   =>  $img,
            'color'       => $this->color
        ]);
    
        $this->image_id     = $image;
        $this->saveAttribute($image);
    }

    public function saveAttribute($image)
    {
        
        $image->attributes()->create([
            'product_id'      => $this->product,
            'size'      => $this->size,
            'price'     => $this->price,
            'quantity'  => $this->quantity
        ]);

        $this->size     = '';
        $this->price    = '';
        $this->quantity = '';

        $this->message   = 'Image Created';

    }

    public function nextAttribute()
    {
        if($this->image_id)
        {
            $this->validate();
            $this->image->attributes()->create([
                'size'      => $this->size,
                'price'     => $this->price,
                'quantity'  => $this->quantity
            ]);

            $this->size     = '';
            $this->price    = '';
            $this->quantity = '';

            $this->message   = 'Image Created';


        }
    }
}

<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\Product as P;
use App\Models\ProductImage;
use App\Models\Attribute;
use Cart;

class Product extends Component
{   
    public $from;
    public $cover;
    public $url;
    public $min;
    public $max;
    public $p;
    public $images;
    public $attributes;
    public $sizes = ['S', 'M', 'L'];
    public $stock;

    public $selectedCover;
    public $selectedImage;
    public $color;
    public $colorId;
    public $attributeId;
    public $size;
    public $price;
    public $quantity;
    public $qty = 1;

    public $addedId;
    public $success = false;

    protected $rules = [
        'color' => 'required',
        'size'  => 'required',
        'price' => 'required',
        'qty'  => 'required',
    ];

    public function mount(P $p, $url, $from)
    {
        $this->from   = $from;
        $image        = $p->images()->first();

        $this->cover  = $image->media->image_url;
        $this->url    = $url;
        $this->p      = $p;
        $this->images = $p->images;
        $this->stock  = $p->attributes()->sum('quantity');

        $this->min = $p->min;
        $this->max = $p->max;

    }

    public function render()
    {
        return view('livewire.customer.product', [
            'p'        => $this->p,
            'images'   => $this->images
        ]);
    }

    public function getAttributes($colorId)
    {
        $co = ProductImage::with('media')
                    ->findOrfail($colorId);

        //Refresh Success Message
        $this->success         = false;

        //Refresh Attributes
        $this->attributeId    = '';
        $this->price          = 0;
        $this->quantity       = 0;

        //Set Color And Attributes
        $this->attributes    = $co->attributes;
        $this->colorId       = $co->id;
        $this->color         = $co->color;
        $this->colorImage    = $co->color;

        //Change the image cover
        $this->cover         = $co->media->image_url; 

    }

    public function qty($attributeId)
    {
        // $attribute = Attribute::where('identifier_id', $attribute)->firstOrfail();
        $attribute = Attribute::findOrfail($attributeId);

        // dd($attribute->id);
        $this->attributeId    = $attribute->id;
        $this->price          = $attribute->price;
        $this->size           = $attribute->size;
        $this->quantity       = $attribute->quantity;

    }

    public function store()
    {
        $pd = P::findOrfail($this->p->id);

        Cart::add([
                'id'         => $pd->id,
                'name'       => $pd->name,
                'price'      => $this->price,
                'quantity'   => $this->qty,
                'attributes' => [
                    'product_id'  => $pd->id,
                    'slug'        => $pd->slug,
                    'cover_url'   => $pd->media->image_url,
                    'image_url'   => $this->cover,
                    'colorId'     => $this->colorId,
                    'color'       => $this->color,
                    'attributeId' => $this->attributeId,
                    'size'        => $this->size
                ]
        ]);

        //Dispatch Success Message
        $this->dispatchBrowserEvent('product-added', [
            "type"       => "success",
            "title"      => "Product added to the bag.",
            "text"       => ""
        ]);

        //Reset 
        $this->attributes     = '';
        $this->colorId        = '';
        $this->color          = '';
        $this->colorImage     = '';

        $this->price          = '';
        $this->size           = '';
        $this->quantity       = 1;

        //Emit for Cart Model
        $this->emit('product_added');
 
    }

    /** Clear All Messages */
    public function clearMessage()
    {
        $this->success = false;
    }
}

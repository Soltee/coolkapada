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

    protected $color;
    protected $colorId;
    protected $attributeId;
    public $size;
    public $price;
    public $quantity;
    public $qty = 1;

    public $addedId;
    public $success;

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
        // dd($image->media);
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

    public function getAttributes($color)
    {
        // dd($color);
        $co = ProductImage::where('identifier_id', $color)->first();

        //Refresh Attributes
        $this->attributeId    = '';
        $this->price          = 0;
        $this->quantity       = 0;

        //Set Color And Attributes
        $this->attributes    = $co->attributes;
        $this->colorId       = $co->id;
        $this->color         = $co->color;

        //Change the image cover
        $this->cover         = $co->media->image_url; 

    }

    public function qty($attribute, $price, $quantity)
    {
        $attribute = Attribute::where('identifier_id', $attribute)->firstOrfail();

        // dd($attribute->id);
        $this->attributeId    = $attribute->id;
        $this->price          = $price;
        $this->quantity       = $quantity;
        $this->size           = $quantity;

        // dd($this->attributeId);
    }

    public function store()
    {
        $pd = P::findOrfail($this->p->id);
        // dd($pd->id);

        Cart::add([
                'id'         => $pd->id,
                'name'       => $pd->name,
                'price'      => $this->price,
                'quantity'   => $this->qty,
                'attributes' => [
                    'product_id'  => $pd->id,
                    'slug'        => $pd->slug,
                    'image_url'   => $pd->media->image_url,
                    'colorId'     => $this->colorId,
                    'color'       => $this->color,
                    'attributeId' => $this->attributeId,
                    'size'        => $this->size,
                ]
        ]);

        $this->addedId  = $pd->id;
        $this->success  = true;

        session()->flash('success', 'Item added to my bag.');
        return redirect($this->url);    
    }
}

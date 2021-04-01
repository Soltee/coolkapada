<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\Product as P;
use App\Models\ProductImage;
use App\Models\Attribute;
use Cart;

class Product extends Component
{   
    public $url;
    public $display;
    public $min;
    public $max;
    public $p;
    public $images;
    public $attributes;

    public $color;
    public $colorId;
    public $attributeId;
    public $size;
    public $price;
    public $quantity;
    public $qty;

    protected $rules = [
        'color' => 'required',
        'size'  => 'required',
        'price' => 'required',
        'qty'  => 'required',
    ];

    public function mount(P $p, $url)
    {
        
        if($url !== '/') {
            $this->display = true;
        }

        $this->url    = $url;
        $this->p      = $p;
        $this->images = $p->images;

        $this->min = $p->attributes()->min('price');
        $this->max = $p->attributes()->max('price');

    }

    public function render()
    {
        return view('livewire.customer.product', [
            'p'        => $this->p,
            'images'   => $this->images
        ]);
    }

    public function attributes($color)
    {
        //Refresh Attributes
        $this->attributeId    = '';
        $this->price          = 0;
        $this->quantity       = 0;

        //Set Color And Attributes
        $this->attributes = Attribute::where('productImage_id', $color)->get();
        $this->colorId    = $color;
    }

    public function qty($attribute, $price, $quantity)
    {
        $this->attributeId    = $attribute;
        $this->price          = $price;
        $this->quantity       = $quantity;
    }

    public function store()
    {
        $data = [
            $this->p->id,
            $this->colorId,
            $this->color,
            $this->attributeId,
            $this->size,
            $this->price,
            $this->qty
        ];

        // dd(url()->current());

        $pd = P::findOrfail($this->p->id);
        $qty = $this->qty ?? 1;

        Cart::add([
                'id'         => $pd->id,
                'name'       => $pd->name,
                'price'      => $this->price,
                'quantity'   => $qty,
                'attributes' => [
                    'product_id'  => $pd->id,
                    'slug'        => $pd->slug,
                    'image_url'   => $pd->image_url,
                    'colorId'     => $this->colorId,
                    'color'       => $this->color,
                    'attributeId' => $this->attributeId,
                    'size'        => $this->size,
                ]
        ]);

        session()->flash('success', 'Item added to my bag.');
        return redirect($this->url);    
    }
}

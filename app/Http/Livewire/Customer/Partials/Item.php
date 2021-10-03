<?php

namespace App\Http\Livewire\Customer\Partials;

use Livewire\Component;
use Cart;
use App\Models\Product;

class Item extends Component
{
    public $i;
    public $itemId;
    public $name;
    public $slug;
    public $image;
    public $price;
    public $size;
    public $quantity;
    public $color;

    public function mount($i)
    {
        $this->i           = $i;
        $this->itemId      = $i->id;
        $this->name        = $i->name;
        $this->slug        = $i->attributes->slug;
        $this->image       = $i->attributes->image_url;
        $this->price       = $i->price;
        $this->size        = $i->attributes->size;
        $this->quantity    = $i->quantity;
        $this->color       = $i->attributes->color;

    }

    public function render()
    {
        return view('livewire.customer.partials.item', [
            'item'          => $this->i
        ]);
    }


    public function removeItem()
    {

        Cart::remove($this->itemId);
        $this->emitUp('item_removed');
    
    }
}

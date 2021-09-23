<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use Cart;

class Bag extends Component
{   

    protected $listeners = ['item_removed' => 'render', 'product_added' => 'render'];

    public function render()
    {
       
        // return view('livewire.customer.bag', [
        //     'items'        => $this->readyToLoad ? Cart::getContent() : [],
        //     'sub'          => $this->readyToLoad ? Cart::getSubTotal() : 0,
        //     'shipping'     => $this->readyToLoad ? 'getshipping' : 0,
        //     'total_qty'    => $this->readyToLoad ? Cart::getTotalQuantity() : 0,
        //     'total'        => $this->readyToLoad ? Cart::getTotal() : 0,
            
        // ]);

        return view('livewire.customer.bag', [
            'items'        => Cart::getContent(),
            'sub'          => Cart::getSubTotal(),
            'shipping'     => 'getshipping',
            'total_qty'    => Cart::getTotalQuantity(),
            'total'        => Cart::getTotal(),
            
        ]);
    }


}

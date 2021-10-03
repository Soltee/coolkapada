<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use Cart;

class Bag extends Component
{   

    protected $listeners = ['item_removed' => 'render', 'product_added' => 'render'];

    public function render()
    {
        return view('livewire.customer.bag', [
            'items'        => Cart::getContent(),
            'sub'          => Cart::getSubTotal(),
            'shipping'     => 'getshipping',
            'total_qty'    => Cart::getTotalQuantity(),
            'total'        => Cart::getTotal(),
            
        ]);
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

class BagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items       = Cart::getContent();
        $sub         = Cart::getSubTotal();
        $shipping    = 'FREE';
        $total_qty   = Cart::getTotalQuantity();
        $total       = Cart::getTotal();
        // dd($items);

        return view('bag', compact('items', 'sub', 'shipping', 'total_qty', 'total'));
    }

    


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $pd = Product::findOrfail(request()->generateId);
        $qty = request()->qty ?? 1;
        Cart::add([
                'id'         => $pd->id,
                'name'       => $pd->name,
                'price'      => $pd->price,
                'quantity'   => $qty,
                'attributes' => [
                    'product_id'  => $pd->id,
                    'slug'        => $pd->slug,
                    'image_url'   => $pd->image_url,
                    'size'        => request()->size,
                    'color'       => request()->color
                ]
        ]);

        return back()->with('success', 'Item added to my bag.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if(request()->quantity < 1){
            Cart::remove($product->id);
        } else {
            Cart::update($product->id, array(
              'quantity' => array(
                  'relative' => false,
                  'value' => request()->quantity
              ),
            ));
        }
       

        return back()->with('success', 'Bag updated');
    }

    /**
     * Remove a cart item
     *
     * @param NOthing
     * @return \Illuminate\Http\Response
     */
    public function remove($item)
    {
        if(Cart::isEmpty()){
            return redirect()->route('shop');
        }

        Cart::remove($item);

        return  back()->with('success', 'Item removed from my bag.');
    }
    /**
     * Clear cart
     *
     * @param NOthing
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        if(Cart::isEmpty()){
            return redirect()->route('shop');
        }

        Cart::clear();

        return  back()->with('success', 'Bag cleared');
    }


}

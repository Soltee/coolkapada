<?php

namespace App\Http\Controllers;

use Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Cart::isEmpty() ){ return redirect('/shop'); }
        $cartCollection = Cart::getContent();
        $sub            = Cart::getSubTotal();
        $shipping       = 25;
        $total          = Cart::getTotal();
        $order          = Order::first();

        $auth = Auth::guard('customer')->user() ? Auth::guard('customer')->user() : null;
        return view('checkout', compact('auth' , 'order', 'cartCollection', 'sub', 'shipping', 'total'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //get the request data
        // dd($request->all());
        $this->validate($request, [
            'first_name'        =>  'required|string' ,
            'last_name'         =>  'required|string' ,
            'email'             =>  'required|string|email' ,
            'phone_number'      =>  'required|numeric|digits:10|starts_with:98' ,
            'city'              =>  'required|string' ,
            'street_address'    =>  'required|string' ,
            'house_number'      =>  'required|numeric' ,
            'payment_method'    =>  'required|string'   
        ]);
        // dd($request->all());
        //store order
        $user     = auth('customer')->user() ? auth('customer')->user()->id : null;

        $shipping = (request()->city == 'pokhara') ? 0 : 50;
        $grand = Cart::getTotal() + $shipping;

        $order = Order::create([
            'customer_id'      => $user,
            'first_name'       => request()->first_name,
            'last_name'        => request()->last_name,
            'email'            => request()->email,
            'phone_number'     => request()->phone_number,
            'city'             => request()->city,
            'street_address'   => request()->street_address,
            'house_number'     => request()->house_number,
            'payment_method'   => request()->payment_method, 
            'sub_total'        => Cart::getSubTotal(),
            'shipping'         => $shipping,
            'grand_total'      => $grand
        ]);


        //store order _items
        foreach(Cart::getContent() as $item){
            OrderItem::create([
                'order_id'       => $order->id,
                'customer_id'    => $user ,
                'product_id'     => $item->id,
                'image_url'      => $item->attributes->image_url,
                'name'           => $item->name,
                'price'          => $item->price,
                'qty'            => $item->quantity,
                'total'          => $item->price * $item->quantity,
                'size'           => $item->attributes->size,
                'color'          => $item->attributes->color
            ]);

            $found     = Product::findOrFail($item->attributes->product_id);

            $remaining   = $found->qty - $item->quantity;
            $found->sold = $found->qty - $remaining;
            $found->qty  = $remaining;
            $found->save();
        }
        

        // Cart::clear();
        return redirect()
                    ->route('thankyou', ['order' => $order->id])
                    ->with('success_message', 'Thank you for purchasing our products.');
    }


    /**
     * Show Thankyou View
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        // if(!session('success_message')){
        //     return redirect('/shop');
        // }

        $items    = $order->items;
        $products = Product::latest()
                            ->take(6)
                            ->get();

        // dd(count($items));
      
        return view('thankyou', compact('order', 'items', 'products'));
    }
}

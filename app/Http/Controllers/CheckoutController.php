<?php

namespace App\Http\Controllers;

use Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

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
        $shipping       = 'Free';
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

        // dd('d');
        $data = $this->validate($request, [
            'first_name'        =>  'required|string' ,
            'last_name'         =>  'required|string' ,
            'email'             =>  'required|string|email' ,
            'phone_number'      =>  'required|numeric|digits:10|starts_with:98' ,
            'city'              =>  'required|string' ,
            'street_address'    =>  'required|string' ,
            'house_number'      =>  'required|numeric' ,
            'payment_method'    =>  'required|string',   
            // 'check'           =>  'required'   
        ]);

        //Values for order
        $user     = auth('customer')->user() ? auth('customer')->user()->id : null;
        $shipping = (request()->city == 'pokhara') ? 0 : 0;
        $grand    = Cart::getTotal() + $shipping;

        $order = Order::create([
            'customer_id'      => $user,
            'first_name'       => $data['first_name'],
            'last_name'        => $data['last_name'],
            'email'            => $data['email'],
            'phone_number'     => $data['phone_number'],
            'city'             => $data['city'],
            'street_address'   => $data['street_address'],
            'house_number'     => $data['house_number'],
            'payment_method'   => $data['payment_method'], 
            'sub_total'        => Cart::getSubTotal(),
            'shipping'         => $shipping,
            'grand_total'      => $grand
        ]);

        //store order _items
        foreach(Cart::getContent() as $item){
            // dd($item->id);
            $items[] = OrderItem::create([
                'order_id'       => $order->id,
                'customer_id'    => $user ,
                'product_id'     => $item->id,
                'image_url'      => $item->attributes->image_url,
                'name'           => $item->name,
                'price'          => $item->price,
                'qty'            => $item->quantity,
                'total'          => $item->price * $item->quantity,
                'attributeId'    => $item->attributes->attributeId,
                'size'           => $item->attributes->size,
                'colorId'        => $item->attributes->colorId,
                'color'          => $item->attributes->color
            ]);

            //Decrement Quantity
            $attribute     = Attribute::findOrfail($item->attributes->attributeId)
                                        ->decrement('quantity', $item->quantity);

            //Update Product Sold Qty
            $product    = Product::findOrfail($item->id);
            $product->update(['sold' => $item->quantity]);

        }


        // Cart::clear();

        return redirect()
                    ->route('thankyou', ['order' => $order->id])
                    ->with('success', 'Hurray! Your orders is being processed. And Thank you for purchasing our products.');
    }


    /**
     * Show Thankyou View
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        if(!session('success')){
            // return redirect('/shop');
        }        

        $items    = $order->items;
        $products = Product::latest()
                            ->has('attributes')
                            ->with('media')
                            ->take(3)
                            ->get();

        return view('thankyou', compact('order', 'items', 'products'));
    }

    /**
     * Download Invoice
     */
    public function download(Order $order)
    {
        $data = [
            'order'  => $order,
            'items'  => $order->items
        ];
        $pdf =  PDF::loadView('pdf.invoice', $data);
        return $pdf->download('invoice.pdf');
                         
        
    }
}

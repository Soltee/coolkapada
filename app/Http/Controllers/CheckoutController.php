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
use App\Http\Requests\StoreOrderRequest;
use App\Services\CheckoutService;

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
    public function store(StoreOrderRequest $request)
    {

        //Instantiate CheckoutSevice class
        $newOrder   = (new CheckoutService($request->validated()))
                        ->confirmAndCreateOrder(); 
        return redirect()
                    ->route('thankyou', ['order' => $newOrder->id])
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
            return redirect('/shop');
        }        

        $items    = $order->items;
        $products = Product::latest()
                            ->has('attributes')
                            ->with('media')
                            ->whereNotIn("id", $order->items->pluck("product_id")->toArray())
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

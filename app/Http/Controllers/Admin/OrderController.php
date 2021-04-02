<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request()->search;


        $query = Order::latest()->with('customer');
        if($search){
            $query = $query->where('first_name', 'LIKE', '%'.$search.'%')
                            ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                            ->orWhere('email', 'LIKE', '%'.$search.'%')
                            ->orWhere('phone_number', 'LIKE', '%'.$search.'%');
         }

        $orders   = $query->paginate(8);
        $total    = $orders->total();

        return view('admin.orders.index', compact('orders', 'total'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $customer = $order->customer;
        $items    = $order->items;
        return view('admin.orders.show', compact('order', 'customer', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->update([
            'is_paid' => !$order->is_paid
        ]);
        
        return back()->with('toast_success', 'Paid Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        foreach ($order->items as $i) {
            $i->delete();
        }
        $order->delete();
        return redirect('/admin/orders')
                    ->with('toast_success', 'Deleted Successfully.');        
    }

}

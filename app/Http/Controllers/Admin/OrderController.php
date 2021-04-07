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
        $keyword    = request()->keyword;
        $paidOrNot = request()->paidOrNot;

        $query = Order::latest()->with('customer');

        if($keyword){
            $query = $query->where('first_name', 'LIKE', '%'.$keyword.'%')
                            ->orWhere('last_name', 'LIKE', '%'.$keyword.'%')
                            ->orWhere('email', 'LIKE', '%'.$keyword.'%')
                            ->orWhere('phone_number', 'LIKE', '%'.$keyword.'%');
        }

        if($paidOrNot){
            if($paidOrNot == 'unpaid'){
                $query  = $query->orWhere('is_paid', false);
            } else {
                $query  = $query->orWhere('is_paid', true);  
            } 
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
        // dd($order->grand_total);

        $order->update([
            'is_paid' => !$order->is_paid
        ]);
        
        return back()->with('success', 'Order set as Completed/Paid.');
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
                    ->with('toast_success', 'Order deleted Successfully.');        
    }

}

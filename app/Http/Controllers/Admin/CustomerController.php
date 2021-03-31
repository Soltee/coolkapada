<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Customer;

class CustomerController extends Controller
{   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $search = request()->search;


        $query = Customer::latest();
        if($search){
            $query = $query->where('first_name', 'LIKE', '%'.$search.'%')
                            ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                            ->orWhere('email', 'LIKE', '%'.$search.'%');
         }

        $paginate = $query->paginate(8);
        $customers = $paginate->items();
        $previous = $paginate->appends(request()->input())->previousPageUrl();
        $next     = $paginate->appends(request()->input())->nextPageUrl();
        $total    = $paginate->total();

        return view('admin.customers.index', compact('customers', 'next', 'previous', 'total'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $orders = $customer->orders()->paginate(3);
        $items_count  = $customer->items()->sum('qty');
        $total_orders = $customer->orders()->count();
        $total_amount = $orders->sum('grand_total');

        // dd($items_count);
        return view('admin.customers.show', compact('customer', 'orders', 'total_amount', 'total_orders', 'items_count'));
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        foreach($customer->orders as $order){
            foreach($order->items as $item){
                $item->delete();
            }
            $order->delete();
        }

        $customer->delete();
        
        return redirect('/admin/customers')
                    ->with('toast_success', 'Customer with orders and items deleted Successfully.');        
    }
}

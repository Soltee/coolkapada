<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Order_item;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $auth = $this->guard()->user();

        $query = Order::latest()->withCount('items')->where('customer_id', $auth->id);

        $orders = $query->paginate(8);
    
        return view('customers.dashboard', compact('auth', 'orders'));
    }

    /**
    * Update Customer
    */
    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            // 'first_name'    => 'required|string',
            // 'last_name'     => 'required|string',
            // 'email'         => 'nullable|email|unique:customers',
            'password'      => 'required|string:min:8|confirmed'
        ]);

        $this->guard()->user()->update([
            // 'first_name'    => $data['first_name'],
            // 'last_name'     => $data['last_name'],
            // 'email'         => $data['email'],
            'password'      => bcrypt($data['password']),
        ]);
        
        return back()->with('success', 'Password changed.');

    }


    /* SIngle Order */
    public function show(Order $order)
    {
        $items   = $order->items;
        $auth    = $this->guard()->user();
        return view('customers.order', compact('auth','order', 'items'));        
    }

    /* Profile*/
    public function profile()
    {
        $auth = $this->guard()->user();
        return view('customers.profile', compact('auth'));        
    }

    public function guard()
    {
        return Auth::guard('customer');
    }
}

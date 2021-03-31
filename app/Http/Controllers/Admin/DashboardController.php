<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Order;

class DashboardController extends Controller
{
    /**
     * Admin Dashboard View
     */
    public function index()
    {
        //Orders
        $today_orders       = Order::whereDate('created_at', today())->count();
        $today_orders_amount = Order::whereDate('created_at', today())->sum('grand_total');

        // dd($today_orders_amount);

        $pending_orders = Order::where('is_paid', false)->count();
        $pending_orders_amount = Order::where('is_paid', false)->sum('grand_total');

        $paid_orders = Order::where('is_paid', true)->count();
        $paid_orders_amount = Order::where('is_paid', true)->sum('grand_total');

        $paginate = Order::latest()->where('is_paid', false)->paginate(10);

        $orders = $paginate->items();
        $previous = $paginate->previousPageUrl();
        $next = $paginate->nextPageUrl();
        $total = $paginate->total();
        
        //Products
        $get_products = Product::all()->count();

        //Customers
        return view('admin.dashboard', compact( 'today_orders',  'today_orders_amount', 'pending_orders', 'pending_orders_amount', 'paid_orders', 'paid_orders_amount', 'orders' , 'previous', 'next', 'total'));
    }

    /**
     * Profile
     */
    public function show()
    {
        $auth = auth()->guard('admin')->user();
        return view('admin.profile', compact('auth'));
    }

    /**
     * Update Profile
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'email'       => 'required|email',
            'password'    => 'required|string|min:8|confirmed'
        ]);

        auth()->guard('admin')->user()->update([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'email'         => $data['email'],
            'password'      => bcrypt($data['password'])
        ]);


        return back()
                ->with('success', 'Profile updated');
    }
}

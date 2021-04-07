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
        $search = request()->search;
        $month  = date('m');
        // dd($month);
        //Orders
        $today_orders         = Order::whereDate('created_at', today())->count();
        $today_orders_amount  = Order::whereDate('created_at', today())->sum('grand_total');

        //This Month Orders
        // $today_orders         = Order::whereMonth('created_at', $month)->count();
        // $today_orders_amount  = Order::whereMonth('created_at', $month)->sum('grand_total');

        $pending_orders         = Order::whereMonth('created_at', $month)
                                            ->where('is_paid', false)->count();
        $pending_orders_amount  = Order::whereMonth('created_at', $month)
                                            ->where('is_paid', false)->sum('grand_total');

        $paid_orders        = Order::whereMonth('created_at', $month)
                                    ->where('is_paid', true)->count();
        $paid_orders_amount = Order::whereMonth('created_at', $month)
                                    ->where('is_paid', true)->sum('grand_total');

        $query = Order::latest()->where('is_paid', false);
        if($search){
            $query = $query->where('first_name', 'LIKE', '%'.$search.'%')
                            ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                            ->orWhere('email', 'LIKE', '%'.$search.'%')
                            ->orWhere('phone_number', 'LIKE', '%'.$search.'%');
         }

        $orders   = $query->paginate(5);        
        
        
        return view('admin.dashboard', compact( 'today_orders',  'today_orders_amount', 'pending_orders', 'pending_orders_amount', 'paid_orders', 'paid_orders_amount', 'orders' ));
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
            // 'first_name'  => 'required|string|max:255',
            // 'last_name'   => 'required|string|max:255',
            // 'email'       => 'required|email',
            'password'    => 'required|string|min:8|confirmed'
        ]);

        auth()->guard('admin')->user()->update([
            // 'first_name'    => $data['first_name'],
            // 'last_name'     => $data['last_name'],
            // 'email'         => $data['email'],
            'password'      => bcrypt($data['password'])
        ]);


        return back()
                ->with('success', 'Password changed.');
    }
}

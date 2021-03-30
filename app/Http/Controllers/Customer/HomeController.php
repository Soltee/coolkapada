<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

class HomeController extends Controller
{
    /**
     * Welcome Home Page
     */
    public function index()
    {
        $orders  = Order::latest()
                    ->paginate(10);
        return view('customers.dashboard');
    }
}

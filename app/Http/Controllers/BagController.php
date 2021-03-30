<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BagController extends Controller
{
    /**
     * Store
     */
    public function store()
    {
        return back()
                ->with('success', 'Product to my bag.');
    }
}

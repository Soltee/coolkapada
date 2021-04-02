<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;

class WelcomeController extends Controller
{
    /**
     * Welcome Home Page
     */
    public function index()
    {
        $new  = Product::latest()
                    ->with('media', 'images')
                    ->where('price', '>', '0')
                    ->take(3)
                    ->get();
        return view('welcome', compact('new'));
    }

    /**
     * Newsletter Store
     */
    public function newsletter(Request $request)
    {
        $data = $request->validate([
            'email'       => 'required|email|unique:newsletters'
        ]);

        $contact = Newsletter::create([
            'email'       => $data['email']
        ]);

        return response()->json(['success' => 'We will get to you shortly.'], 201);
    }
}

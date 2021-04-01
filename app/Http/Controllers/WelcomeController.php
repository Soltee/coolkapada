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
        // dd(ProductImage::first());
        $new  = Product::latest()
                    ->with('images')
                    ->where('price', '>', '0')
                    ->take(3)
                    ->get();
        echo "<pre>";
        // dd($new);
        echo "</pre>";
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

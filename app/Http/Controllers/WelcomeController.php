<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Newsletter;

class WelcomeController extends Controller
{
    /**
     * Welcome Home Page
     */
    public function index()
    {
        $new  = Product::latest()
                    ->where('published', true)
                    ->has('attributes')
                    ->with('media', 'images')
                    ->paginate(6);
        return view('welcome', compact('new'));
    }

    /**
     * FAQs
     */
    public function faqs()
    {
        return view('faqs');
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

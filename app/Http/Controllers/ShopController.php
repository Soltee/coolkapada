<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shop');
    }

    /*
		* Show Single product page
    */
	public function show($slug)
	{   
        $product          =  Product::where('slug', $slug)
                                ->with('media')
                                ->first();
        $images           =  $product->images()
                                    ->with('media')
                                    ->get();
        $image_count      =  $images->count();

        $auth             = Auth::guard('customer')->user() ? Auth::guard('customer')->user()->id : null;

        $similar          =  $product->category
                                    ->products()
                                        ->inRandomOrder()
                                        ->where('id', '!=' , $product->id)
                                        ->with('media')
                                        ->take(10)
                                        ->get();
		return view('show', compact('product', 'image_count', 'images', 'auth', 'similar'));
	}
}

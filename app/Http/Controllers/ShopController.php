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
        $category = request()->category;
        $search   = request()->keyword;
        $sort     = request()->sort;

        $query    = Product::latest();

        if($category){
            $categories =   Category::latest()->paginate(6);
            $query      =   $query->where('category_id', $category);
        }

        if($search){
            $query  =   $query->where('name', 'LIKE' , "%".$search."%")
                            ->orWhere('price', 'LIKE' , "%".$search."%");
        }
    
    	$categories =   Category::latest()->take(6)->get();
        $products   =   $query->paginate(9);

        $count      =   $products->total();
        $first      =   $products->firstItem();
        $last       =   $products->lastItem();
    	
    	// dd($categories);
        // \Cart::clear();
        return view('shop', compact('categories', 'products', 'first', 'last', 'count'));

    }

    /*
		* Show Single product page
    */
	public function show($slug)
	{   
        $product          =  Product::where('slug', $slug)->first();
        $images           =  $product->images;
        $image_count      =  count($images);

        $auth             = Auth::guard('customer')->user() ? Auth::guard('customer')->user()->id : null;

        $similar          =  $product->category->products()->inRandomOrder()->where('id', '!=' , $product->id)->take(10)->get();
		// dd($average);
		return view('show', compact('product', 'image_count', 'images', 'auth', 'similar'));
	}
}

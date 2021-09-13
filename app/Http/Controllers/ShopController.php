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
        // $filter   = request()->_filter;
        $category = request()->category;
        $search   = request()->keyword;
        $size     = request()->size;

        $query    = Product::latest()
                    ->where('published', true)
                    ->has('attributes')
                    ->with('media');

        if($category){
            // $category   = Category::findOrfail($category);
            $categories =   Category::latest()->paginate(6);
            $query      =   $query->where('category_id', $category);
        }

        if($search){
            $query  =   $query->where('name', 'LIKE' , "%".$search."%");
        }

        if($size){
            $query   = $query->whereRelation('attributes', 'size', $size);
        }
    
    	$categories =   Category::latest()->take(6)->get();
        $products   =   $query->paginate(9);
        $sizes      =   [
                            ['name' => 'Extra Small', 'symbol' => 'XS'],
                            ['name' => 'Small', 'symbol' => 'S'],
                            ['name' => 'Medium', 'symbol' => 'M'],
                            ['name' => 'Large', 'symbol' => 'L'],
                            ['name' => 'Extra Large', 'symbol' => 'XL']
                        ];

        $count      =   $products->total();
        $first      =   $products->firstItem();
        $last       =   $products->lastItem();
    	
        return view('shop', compact('categories','category', 'products', 'sizes', 'size', 'first', 'last', 'count'));

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
        // dd($images->count());
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

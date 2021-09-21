<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use App\Models\ProductImage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search    = request()->search;
        $published = request()->published;

        $query = Product::latest()
                        ->with('media');
        if($search){
            $query = $query->where('name', 'LIKE', '%'.$search.'%');
        }

        if($published){
            if($published == 'un'){
                $query  = $query->orWhere('published', false);
            } else {
                $query  = $query->orWhere('published', true);  
            } 
        }

        $products = $query->paginate(8);
        $total    = $products->total();
        // dd($products);
        // dd(Product::pluck('id')->toArray());
        // dd(Product::with('category', 'media')->inRandomOrder()->take(6)->get());
        // dd(Product::first()->media->image_url);

        return view('admin.products.index', compact('products', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            
        $data = $request->validate([
            'cover'        => 'mimes:jpeg,jpg,png|max:2048',
            'category'     => 'required|string',
            'name'         => 'required|string|unique:products',
            'description'  => 'required'
        ]);
        
        if($request->hasFile('cover')){

            $image      = $request->file('cover'); 
        
            $original   = 'md-' . 
                            Str::random() . '.' . $image->getClientOriginalExtension();

            $image->move(storage_path('app/public/products'), $original);
    
            $path       = 'storage/products/' . $original;

            // dd($path);
            $mediaId    = Media::create([
                            'image_url'  => $path,
                            'thumbnail'  => $original
                        ]);

            $product = Product::create([
                'category_id'  => $data['category'],
                'media_id'     => $mediaId->id,
                'name'         => $data['name'],
                'slug'         => Str::slug($data['name'], '-'),
                'description'  => $data['description'] 
            ]);

            return redirect()
                    ->route('product.image.create', [
                        'product' => $product->id
                    ])
                    ->with('toast_success', 'Product uploaded.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $media      = $product->media;
        $cat        = $product->category;
        $images     = $product->images()->with('media')->paginate(6);
        $quantity   = $product->attributes()->sum('quantity');
        $sizes      = $product->attributes()->groupBy('size')->pluck('size');

        return view('admin.products.show', compact('product', 'media', 'images', 'cat', 'quantity', 'sizes'));
    }

    /**
     * Show Edit page for Product
    */
    public function edit(Product $product)
    {
        $categories = Category::latest()->get();
        return view('admin.products.edit', compact('categories', 'product'));
    }

    /**
     * EDit  the  specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {   

        $data = $request->validate([
            'category'     => 'required|string',
            'name'         => 'required|string',
            'description'  => 'required'
        ]);


        if($request->hasFile('cover')){


            //Validate
            $request->validate([
                'cover'        => 'mimes:jpeg,jpg,png|max:2048'
            ]);

            //Remove previous cover image from db.
            unlink($product->media->image_url);
            $product->media->delete();


            //Get & Upload
            $image      = $request->file('cover'); 
            // dd($image);
            $original   = 'md-' . 
                            Str::random() . '.' . $image->getClientOriginalExtension();

            $image->move(storage_path('app/public/products'), $original);
    
            $path       = 'storage/products/' . $original;

            $mediaId    = Media::create([
                            'image_url'  => $path,
                            'thumbnail'  => $original
                        ]);

            $mediaArray = ['media_id'  => $mediaId->id];
            
        }   

        $p  = $product->update(
            array_merge([
                'category_id'  => $data['category'],
                'name'         => $data['name'],
                'slug'         => Str::slug($data['name'], '-'),
                'description'  => $data['description'] 
            ],
            $mediaArray ?? []
        ));

        return back()->with('success', 'Product updated.');

    }

    /**
     * Publish / Unpublished  the  specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publish(Request $request, Product $product)
    {
        $product->update([
            'published'  => !$product->published
        ]);

        return back()->with('success', 'Visibility updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            foreach($image->attributes as $a){
                $a->delete();
            }
            
            if(File::exists($image->image_url)){
                unlink($image->image_url);
            }
    
            $image->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.view')->with('toast_success', 'Product deleted.');
    }

}

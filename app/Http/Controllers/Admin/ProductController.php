<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Category;
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
        $search = request()->search;


        $query = Product::latest()
                        ->with('media');
        if($search){
            $query = $query->where('name', 'LIKE', '%'.$search.'%')
                            ->orWhere('price', 'LIKE', '%'.$search.'%');
         }

        $products = $query->paginate(8);
        $total    = $products->total();
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
        // dd($request->all(
            
        $data = $request->validate([
            'media'        => 'required|string',
            'category'     => 'required|string',
            'name'         => 'required|string|unique:products',
            'description'  => 'required'
        ]);
        
        $product = Product::create([
            'category_id'  => $data['category'],
            'media_id'     => $data['media'],
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // $categories = Category::latest()->get();
        $cat = $product->category;
        $images = $product->images;
        return view('admin.products.show', compact('product', 'images', 'cat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::latest()->get();
        $cat        = $product->category;
        $images     = $product->images;

        return view('admin.products.edit', compact('product', 'categories', 'cat', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // dd($request->all());
        $data = $request->validate([
            'category'     => 'required|string',
            'name'         => 'required|string',
            'prev_price'   => 'int|min:0',
            'price'        => 'required|int|min:1',
            'qty'          => 'required|int|min:1',
            'sizes'        => 'required|string',
            'colors'       => 'required|string',
            'excerpt'       => 'nullable|required',
            'description'   => 'required',
        ]);
        
        
        // dd($request->file('files'));
        if($request->hasFile('files')){

            $allowedfileExtension = ['jpeg','jpg','png','gif'];
            $images      = $request->file('files'); 
            foreach($images as $file){
                $filename = $file->getClientOriginalName();

                $extension = $file->getClientOriginalExtension();

                $check = in_array($extension,$allowedfileExtension);
                
                if(!$check){
                    return back()
                        ->with('error', 'Please select only jpeg, jpg and png images.');
                }
            }

            foreach ($images as $image) {
                $basename  = Str::random();
                $original  = 'pd-' . $basename . '.' . $image->getClientOriginalExtension();
                $image->move(storage_path('app/public/products'), $original);
                $paths[] = [
                    'url'    => 'storage/products/'. $original,
                    'thumb'  => $original
                ];
            }

            $cover = ['image_url' => $paths[0]['url']];
            
        }

        $excerptArr  = ['excerpt' => $data['excerpt']];
        $descriptArr = ['description' => $data['description']];

        $update = $product->update(array_merge([
            'category_id'  => $data['category'],
            'name'         => $data['name'],
            'slug'         => Str::slug($data['name'], '-'),
            'prev_price'   => $data['prev_price'],
            'price'        => $data['price'],
            'qty'          => $data['qty'],
            'sizes'        => $data['sizes'],
            'colors'       => $data['colors']
        ]), 
            $cover       ?? [],
            $excerptArr  ?? [],
            $descriptArr ?? []
        );

        if($request->hasFile('files')){
            foreach ($paths as $data) {
                    ProductImage::create([
                        'product_id'  => $product->id,
                        'image_url'   => $data['url'],
                        'thumbnail'   => $data['thumb']
                    ]);
            }
        }

        return redirect()->back()->with('toast_success', 'Product updated.');
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
            
            $image->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.view')->with('toast_success', 'Product deleted.');
    }

}

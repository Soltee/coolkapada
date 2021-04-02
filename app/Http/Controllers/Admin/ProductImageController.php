<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Attribute;

class ProductImageController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('admin.images.create', compact('product'));
    }

    public function store()
    {
        $allowedfileExtension = ['jpeg','jpg','png'];
        $images      = $request->file('files'); 
        foreach($images as $file){
            $filename = $file->getClientOriginalName();

            $extension = $file->getClientOriginalExtension();

            $check = in_array($extension,$allowedfileExtension);
            
            if(!$check){
                return back()
                    ->with('errors', 'Please select only jpeg, jpg and png images.');
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

        foreach ($paths as $data) {
            ProductImage::create([
                'product_id'  => $product->id,
                'image_url'   => $data['url'],
                'thumbnail'   => $data['thumb']
            ]);
        }

    }

}

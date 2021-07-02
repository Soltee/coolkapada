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


    /*
        * Upload images with color
    */
    public function store(Request $request)
    {
        $data = $request->validate([
            '_product' => 'required|uuid',
            'color'    => 'required|string|min:3',
            'media'    => 'required|uuid'
        ]);

        // dd($data);

        $image = ProductImage::create([
            'product_id'     => $data['_product'],
            'media_id'       => $data['media'],
            'color'          => $data['color']
        ]);

        return redirect()
                ->route('product.image.show', [
                    'product'        => $data['_product'],
                    'productImage'   => $image->id
                ])
                ->with('toast_success', 'Image uploaded.');
    
    }

    /*
        * Updaate image and color
    */
    public function update(Request $request, ProductImage $productImage)
    {
        $data = $request->validate([
            '_product' => 'required|uuid',
            '_color'   => 'required|string|min:3',
            'media'    => 'nullable|uuid'
        ]);

        // dd($data);
        if($data['media']){
           $mediaArr = ['media_id'   => $data['media']];
        }

        $updated = $productImage->update(array_merge(
            [
            'color'          => $data['_color']
            ],
            $mediaArr ?? []
        ));

        return redirect()
                ->back()
                ->with('toast_success', 'Product color updated.');
    
    }

    /*
    * Show The Single Product Image
    */
    public function  show(Product $product, ProductImage $productImage)
    {
        // dd($productImage);
        return view('admin.images.show', compact('product', 'productImage'));
    }

}

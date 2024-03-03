<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Attribute;
use App\Models\Media;
use Illuminate\Support\Str;

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
            'media'    => 'required|mimes:jpeg,jpg,png|max:2048'
        ]);



        $image      = $request->file('media'); 
    
        $original   = 'md-' . 
                        Str::random() . '.' . $image->getClientOriginalExtension();

        $image->move(storage_path('app/public/products'), $original);

        $path       = 'storage/products/' . $original;

        // dd($path);
        $mediaId    = Media::create([
                        'image_url'  => $path,
                        'thumbnail'  => $original
                    ]);

        $image = ProductImage::create([
            'product_id'     => $data['_product'],
            'media_id'       => $mediaId->id,
            'color'          => $data['color']
        ]);


        return 

            redirect()
                ->route('product.image.show', [
                    'product'        => $data['_product'],
                    'productImage'   => $image->id,
                ])    
                ->with('toast_success', 'Product Image uploaded.');

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

    /*
    * Delete ProductImage with its Attributes
    */
    public function destroy(ProductImage $productImage)
    {

        $imageProduct = $productImage->product;

        //Product Image Attribute Delete
        foreach($productImage->attributes as $att)
        {
            $att->delete();
        }

        //Delete Product Image Linked with Media and delete the column
        unlink($productImage->media->image_url);
        $productImage->delete();

        //Update Product mIn and max value of Product
        $min = $imageProduct->attributes()->min('price');
        $max = $imageProduct->attributes()->max('price');

        $imageProduct->update([
            'min'   => $min,
            'max'   => $max
        ]);

        //Return with success
        return 
            redirect()
                ->route('admin.product', [
                    'product'        => $imageProduct->id
                ])
                ->with('toast_success', 'Image with attributes removed.');
    

    }
}

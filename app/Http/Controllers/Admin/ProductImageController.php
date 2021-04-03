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

    // public function store()
    // {
    //     $request->validate([
    //         'product_id'    => 'required|string',
    //         'media_id'      => 'required|string',
    //         'color'         => 'required|string',
    //     ]);
    //     foreach ($images as $image) {
    //         ProductImage::create([
    //             'product_id'  => $product->id,
    //             'image_url'   => $data['url'],
    //             'thumbnail'   => $data['thumb']
    //         ]);
    //     }

    //     foreach ($paths as $data) {
            
    //     }

    // }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request()->search;


        $query = Category::latest();
        if($search){
            $query = $query->where('name', 'LIKE', '%'.$search.'%');
         }

        $categories  =   $query->paginate(2);
        $total       =   $categories->total();
        $allCategories = Category::get();
        return view('admin.categories.index', compact('categories', 'total', 'allCategories'));
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
            'name'  => 'required|string|min:3|unique:categories',
            'parent_id' => 'nullable|string|exists:categories,id'
        ]);


        if($request->parent_id){

            $parentIDArray = ['parent_id' => $data['parent_id']];

        }

        Category::create(array_merge([
            'name'       => $data['name'],
            'slug'       => Str::slug($data['name'])
        ], $parentIDArray ?? []));

        return back()->with('toast_success', 'Created');
    }

     /**
     * Update a resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name'  => 'required|string|min:3|unique:categories'
        ]);

        $category->update([
            'name'       => $data['name'],
            'slug'       => Str::slug($data['name'])
        ]);

        return back()->with('toast_success', 'Updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        foreach($category->products() as $product){
            foreach($product->images() as $image){
                foreach($image->attributes() as $attr){
                    $attr->delete();
                }
                $image->delete();
            }
            $product->delete();
        }

        $category->delete();

        return redirect('/admin/categories')
                    ->with('toast_success', 'Destroyed');
    }
}

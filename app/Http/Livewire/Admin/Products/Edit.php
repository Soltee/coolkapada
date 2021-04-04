<?php

namespace App\Http\Livewire\Admin\Products;

use Livewire\Component;

use App\Models\Category;
use App\Models\Product;
use App\Models\Media;
 use Illuminate\Support\Str;

class Edit extends Component
{
    public $product;

    protected $rules = [
            'category'     => 'required|string',
            'name'         => 'required|string',
            'description'  => 'required'
        ];

    protected $listeners = ['receiveMedia', 'closeMedia'];

    public $media;
    public $media_url;
    public $category;
    public $name;
    public $description;
    public $showImages = false;

    public $data;

    public function mount(Product $product)
    {
        $this->product        = $product;
        $this->name           = $product->name;
        $this->media_url      = $product->media->image_url;
        $this->description    = $product->description;
        $this->category       = $product->category->id;
    }

    public function render()
    {
       
        return view('livewire.admin.products.edit', [
            'categories'   => Category::latest()->get()
        ]);
    }

    public function editProduct()
    {
        $this->validate();

        $this->product->update([
            'category_id'  => $this->category,
            'media_id'     => $this->media,
            'name'         => $this->name,
            'slug'         => Str::slug($this->name, '-'),
            'description'  => $this->description 
        ]);

        session()->flash('success', 'Product updated.');
        return redirect()->to('/admin/products/' . $this->product->id . '/images/create');
                
    }

    public function receiveMedia($id)
    {
        $m                 = Media::findOrfail($id);
        $this->media_url   = $m->image_url;
        $this->media       = $m->id;
        $this->showImages  = false;
    }

    public function closeMedia()
    {
        $this->showImages = false;
    }

}

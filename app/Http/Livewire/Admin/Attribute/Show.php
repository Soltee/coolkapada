<?php

namespace App\Http\Livewire\Admin\Attribute;

use Livewire\Component;
use App\Models\Product as P;
use App\Models\Attribute as Att;
use App\Models\ProductImage as Image;

class Show extends Component
{
    public $product;
    public $attribute;
    public $image;

    public $message;

    public function mount(Att $att, P $p, Image $image)
    {
        $this->product       = $p;
        $this->attribute     = $att;
        $this->image         = $image;
    }
    
    public function render()
    {
        return view('livewire.admin.attribute.show', [
            'att'    => $this->attribute
        ]);
    }

    /**
     * Delete Attribute
     */
    public function deleteAttribute()
    {
        // dd($this->image->id);
        // dd('admin/products/'. $this->product->id . '/' . $this->image->id);

        $a = Att::findOrfail($this->attribute->id);
        $a->delete();

        if($this->product->has('attributes')){
            $this->updateProductMinMax();
        }

        session()->flash('success', 'Attribute Deleted.');
        return redirect('admin/products/'. $this->product->id . '/' . $this->image->id);
    
    }

    /**
     * Update Product Min and Max value 
     */
    public function updateProductMinMax()
    {
        //Update Product mIn and max value
        $min = $this->product->attributes()->min('price');
        $max = $this->product->attributes()->max('price');

        $this->product->update([
            'min'   => $min,
            'max'   => $max
        ]);

    }
}

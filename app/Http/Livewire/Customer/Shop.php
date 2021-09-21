<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination;
    public $search;
    public $category;
    public $size;
    public $pageSize = 6;

    public $categories;
    public $sizes      =   [
            ['name' => 'Extra Small', 'symbol' => 'XS'],
            ['name' => 'Small', 'symbol' => 'S'],
            ['name' => 'Medium', 'symbol' => 'M'],
            ['name' => 'Large', 'symbol' => 'L'],
            ['name' => 'Extra Large', 'symbol' => 'XL']
        ];

    public function mount()
    {
        $this->search       = request()->keyword;
        $this->categories   = Category::latest()->get();
    }

    public function render()
    {        
        // return view('livewire.customer.shop', [
        //     'products'         => $paginate,
        //     'categories'       => $this->categories,
        //     'category'         => $this->category,

        //     'count'            => $paginate->total(),
        //     'first'            => $paginate->firstItem(),
        //     'last'             => $paginate->lastItem()
        // ]);

        return $this->renderProductsList();
    }

    /* When Search */
    public function renderProductsList()
    {
        if($this->search){

            $products   = Product::where('name', 'LIKE' , "%".$this->search."%")
                                    ->where('published', true)
                                    ->has('attributes')
                                    ->with('Media')
                                    ->paginate($this->pageSize);
            $this->goToPage(1);

        } else {

            $query      = Product::where('published', true)
                                    ->has('attributes')    
                                    ->with('media');
                                

            if($this->category)
            {   
                $query  = $query->where('category_id', $this->category);
                // $this->category = Category::findOrfail($this->category)->name;
            }

            if($this->size){
                $query   = $query->whereRelation('attributes', 'size', $this->size);
            }

            $products   = $query->latest()
                                ->paginate($this->pageSize);
        }

        return view('livewire.customer.shop', [
            'products'    => $products->onEachSide(3),
            'total'       => $products->total(),
            'first'       => $products->firstItem(),
            'last'        => $products->lastItem(),
            'categories'  => $this->categories,
            'category'    => $this->category
        ]);

                          
    }

    /*
        * Filter
    */
    public function filterByCategory()
    {
        $this->goToPage(1);
    }

    public function filterBySize()
    {
        $this->goToPage(1);
    }

    public function resetFilters()
    {
        $this->category   = '';
        $this->size       = '';
    }

    
    /* New Pagination */
    public function paginationView()
    {
        return 'vendor.pagination';

    }
}

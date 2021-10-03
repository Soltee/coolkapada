<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

use Livewire\WithPagination;

class ProductReview extends Component
{
    use WithPagination;

    public $product;

    public $rating = 1;
    public $comment;

    public $selectedId;

    protected $rules = [
        'rating' => ['required', 'in:1,2,3,4,5'],
        'comment' => 'required',
    ];


    public function mount(Product $product)
    {
        $this->product    = $product;
    }


    public function render()
    {
        return $this->renderProductsList();
    }

    public function rate()
    {
        //New Review
        $this->validate();

        if($this->selectedId){

            $review = Review::findOrfail($this->selectedId);
            $review->rating     = $this->rating;
            $review->comment    = $this->comment;
            $review->save();

        } else {

            auth()->guard('customer')->user()->reviews()->create([
                'product_id'     => $this->product->id,
                'rating'         => $this->rating,
                'comment'        => $this->comment
            ]);

        }

        //Clear Fields
        $this->rating       = 1;
        $this->comment      = '';
        $this->selectedId   = '';

        //Rerender the Compoent 
        return $this->renderProductsList();
    }

    public function renderProductsList(){

        return view('livewire.customer.product-review', [
            'reviews'  => $this->product
                                ->reviews()
                                ->latest()
                                ->with('customer')->paginate(4)
        ]);
    }

    /*Edit review */
    public function selectToEdit($reviewId)
    {
        $review = Review::findOrfail($reviewId);
        if ($review && ($review->customer_id == auth()->guard('customer')->user()->id)) {
            $this->selectedId          = $review->id;

            $this->rating              = $review->rating;
            $this->comment             = $review->comment;
        } 
    }

    /* New Pagination */
    public function paginationView()
    {
        return 'vendor.pagination';

    }
}

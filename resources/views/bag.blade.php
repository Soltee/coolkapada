@extends('layouts.app')
@section('head')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/tiny-slider.css">

	<style>
		.custom_radio input:checked + .radio_btn{border: 2px solid black;}
		.custom_radio2 input:checked + .radio_btn2{border: 2px solid black;}

		/* [2] Transition property for smooth transformation of images */
		.img-hover-zoom img {
		  transition: transform .5s ease;
		}

		/* [3] Finally, transforming the image when container gets hovered */
		.img-hover-zoom:hover img {
		  /*transform: scale(1.05);*/
		  opacity: 0.8;
		}	
		.imgBlock{transition: transform 0.3s ease-in-out;}
		.imgBlock:hover img{opacity: 0.8; transform: scale(1.2);}
		.imgBlock:hover  .addBtn {
			visibility: initial;
		}

	</style>
@endsection
@section('content')
		<div class="px-6  py-3 w-full">
	        
      <div class="flex justify-between md:justify-start items-center mb-8 w-full">
          <a href="/"><h4 class="text-md opacity-75 hover:opacity-100 font-light text-gray-900 mr-2">HOME</h4></a>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
          <a href="/shop">
            <h4 class="text-md opacity-75 hover:opacity-100 font-light text-gray-900 mr-2">SHOP</h4>
          </a>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
          <h4 class="text-lg font-bold text-gray-900 ">BAG</h4>        
        
      </div>

      <!-- Cart -->
      <div class="table w-full ">
          <div class="w-full hidden md:block md:table-row mb-4">
            <div class="md:table-cell px-2 py-2 border uppercase text-left text-gray-900 border-collapse font-bold"></div>
            <div class="md:table-cell px-2 py-2 border uppercase text-left text-gray-900 border-collapse font-bold">Photo</div>
            <div class="md:table-cell px-2 py-2 border font-bold uppercase text-left text-gray-900 border-collapse">Quantity</div>
            <div class="md:table-cell px-2 py-2 border font-bold uppercase text-left text-gray-900 border-collapse">Price</div>
            <div class="md:table-cell px-2 py-2 border font-bold uppercase text-left text-gray-900 border-collapse">Total</div>
            
          </div>
          @forelse($items as $item)

            <div class="w-full flex flex-col md:flex-row md:justify-center md:items-center  md:table-row mb-6 border rounded">
              <div class="md:table-cell px-2 py-2 border capitalize text-left text-gray-900 border-collapse font-thin">
                <!-- Delete Item -->
                <form action="{{ route('cart.remove', $item->id) }}" method="POST" accept-charset="utf-8">
                  @csrf
                  @method('DELETE')
                  <button 
                    onClick="return confirm('Are you sure?')"
                    type="submit">
                      <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash h-8 w-8 text-red-600 hover:opacity-80 cursor-pointer"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                      
                  </button>
                </form>
              </div>
              <div class="md:table-cell md:px-2 md:py-2 border capitalize text-left text-gray-900 border-collapse">
                  <a class="w-full" href="/product/{{ $item->attributes->slug }}">
                    <img  class="rounded-xl w-full md:w-32 md:h-32 object-center object-contain  hover:opacity-75" src="{{ asset($item->attributes->image_url) }}" >
                    </a>

                </div>
                <div class="md:table-cell px-2 py-2 border flex items-center capitalize text-left text-gray-900 border-collapse font-bold">
                  <form action="{{ route('cart.update', $item->id) }}" method="POST" accept-charset="utf-8">
                    @csrf
                    @method('PATCH')
                    <div class="flex items-center mr-3">
                      <input type="number" name="quantity" class=" md:w-24 text-center  mr-3 px-4 py-2 rounded " value="{{ $item->quantity }}" >
                      
                      <button type="submit" class="cursor-pointer">
                        <svg 
                          xmlns="http://www.w3.org/2000/svg" 
                          viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" 
                          class="h-8 w-8 cursor-pointer text-yellow-600"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
    
                      </button>
                    </div>
                  </form>

                  
                </div>

                <div class="md:table-cell px-2 py-2 border capitalize text-left text-gray-900 border-collapse font-thin">Rs {{ $item->price }}</div>
                <div class="md:table-cell px-2 py-2 border capitalize text-left text-gray-900 border-collapse font-bold">Rs {{ $item->price * $item->quantity }}</div>
                  
                </div>
          @empty
              <div class="md:table-cell px-2 text-red-600 py-2 border capitalize text-left text-gray-900 border-collapse font-thin">My</div>
              <div class="md:table-cell px-2 text-red-600 py-2 border capitalize text-left text-gray-900 border-collapse font-thin">Bag</div>
              <div class="md:table-cell px-2 text-red-600 py-2 border capitalize text-left text-gray-900 border-collapse font-thin">is </div>
              <div class="md:table-cell px-2 text-red-600 py-2 border capitalize text-left text-gray-900 border-collapse font-thin">Empty</div>
              <div class="md:table-cell px-2 text-red-600 py-2 border capitalize text-left text-gray-900 border-collapse font-thin">
                <a href="/shop" class="px-2 py-2 rounded bg-gray-900 hover:bg-gray-700 text-white">Browse Products</a>
              </div>

          @endforelse
        </div>
      </div>
        
    	<!-- Cart Details -->
	    	@if($total_qty)
        	<div class="w-full flex flex-col px-6 border rounded">
        		<div class="flex justify-between items-center mb-4  w-full px-3 pt-3">
        			<h5 class="text-gray-800 text-md">SubTotal</h5>
        			<span class="text-gray-800 text-md">Rs {{ $sub }}</span>
        		</div>
        		<div class="flex justify-between items-center mb-4  w-full px-3 ">
        			<h5 class="text-gray-800 text-md">Discount</h5>
        			<span class="text-gray-800 text-md">Rs 0</span>
        		</div>
        		<div class="flex justify-between items-center mb-4  w-full px-3 ">
        			<h5 class="text-gray-800 text-md">Shipping</h5>
        			<span class="text-gray-800 text-md">{{ $shipping }}</span>
        		</div>
        		<div class="flex justify-between items-center  w-full border-t border-gray-400 py-3 px-3">
        			<h5 class="text-gray-800 text-xl">Grand Total</h5>
        			<span class="text-gray-800 text-xl font-bold">Rs {{ $total }}</span>
        		</div>

    
	    		<div class="fixed z-20 bottom-0 left-0 right-0 px-6 xl:px-0 w-full xl:mb-4 xl:relative xl:static  flex flex-col md:flex-row md:justify-end items-center xl:mb-0 py-5 xl:py-0 bg-gray-400 xl:mt-10 xl:px-3 xl:bg-white">
	    			<a href="/checkout" class="px-10 py-4  w-full xl:w-64 rounded bg-gray-900 hover:opacity-75 text-white text-xl cursor-pointer  xl:mb-0 text-center">Checkout Now</a>
	    		</div>
        	</div>
        	@endif

	    </div>

    </div>
      
@endsection


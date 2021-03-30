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
		.addBtn{visibility: hidden;}

	</style>
@endsection
@section('content')
		<div class="px-6  py-3 w-full">
	        
      <div class="flex justify-between items-center mb-8 w-full">
        <div class="flex items-center">
          <a href="/"><h4 class="text-md opacity-75 hover:opacity-100 font-light text-gray-900 mr-2">HOME</h4></a>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
          <h4 class="text-md font-md text-gray-900 ">SHOP</h4>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
          <h4 class="text-lg font-bold text-gray-900 ">BAG</h4>
        </div>
        
        
      </div>

      <!-- Cart -->
      
      <div class="flex flex-col ">
        <div 
            class="w-full mt-3 overflow-x-scroll w-full md:overflow-auto md:w-full">
	        <table class="table-auto  w-full mb-8" >
                <thead>
                    <tr>
                      <th class="px-4 py-2 text-left text-capitalize text-gray-600">Action</th>
                      <th class="px-4 py-2 text-left text-capitalize text-gray-600">Photo</th>
                      <th class="px-4 py-2 text-left text-capitalize text-gray-600">Quantity</th>
                      <th class="px-4 py-2 text-left text-capitalize text-gray-600">Price</th>
                      <th class="px-4 py-2 text-left text-capitalize text-gray-600">Total</th>
                    </tr>
                </thead>
               <tbody>
                  @forelse($items as $item)
                  <tr>
                    <td class="border px-4 py-4">
                      <div class="w-full xl:w-auto mb-3 xl:mb-0 ">
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
                    </td>
                    
                    <td class="border px-4 py-4">
                        <a class="w-full" href="/product/{{ $item->attributes->slug }}">
                        <img  class="rounded-xl w-full h-40 md:w-24 md:h-24 object-center object-cover mr-3 mb-3 md:mb-0 hover:opacity-75" src="{{ asset($item->attributes->image_url) }}" >
                        </a>
                    </td>
                    <td class="border px-4 py-4">
                      <form action="{{ route('cart.update', $item->id) }}" method="POST" accept-charset="utf-8">
                        @csrf
                        @method('PATCH')
                        <div class="flex items-center">
                          <input type="number" name="quantity" class=" w-40  mr-3 px-4 py-2 rounded-l border  border-c-light-gray " value="{{ $item->quantity }}" >
                          <button type="submit" class="px-3 py-2  w-40 rounded-r bg-gray-900  text-white text-xl cursor-pointer hover:opacity-50">Update</button>
                        </div>
                      </form>
                    </td>
                    <td class="border px-4 py-4">Rs {{$item->price }}</td>
                    <td class="border px-4 py-4 font-bold text-lg">Rs {{$item->price * $item->quantity}}</td>
                    
                  </tr>
                  @empty
                      <tr>
                        <td class="border text-red-600 text-lg px-4 py-4">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-24 2-24 feather feather-frown text-red-600"><circle cx="12" cy="12" r="10"></circle><path d="M16 16s-1.5-2-4-2-4 2-4 2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                        </td>
                        <td class="border text-red-600 text-lg px-4 py-4">Bag</td>
                        <td class="border text-red-600 text-lg px-4 py-4">is</td>
                        <td class="border text-red-600 text-lg px-4 py-4">Empty</td>
                        <td class="border text-red-600 text-lg px-4 py-4">
                          <a href="/shop" class="px-6 py-3 rounded bg-gray-900 hover:opacity-75 text-white text-xl cursor-pointer">Browse Products</a>
                        </td>

                      </tr>
                  @endforelse

                </tbody>
			      </table>
		</div>


	    	{{-- <div class="w-full  flex flex-col items-start">

	    		@forelse($items as $item)
	    			<div class="py-3 border-b border-gray-400 flex flex-col lg:flex-row justify-between lg:items-center border-gray-200 w-full">
		    				<div class="w-full xl:w-auto mb-3 xl:mb-0 ">
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
							<a class="w-full" href="/product/{{ $item->attributes->slug }}">
								<img  class="rounded-xl w-full h-40 md:w-24 md:h-24 object-center object-cover mr-3 mb-3 md:mb-0 hover:opacity-75" src="{{ asset($item->attributes->image_url) }}" >
		    				</a>

							<h3 class="flex flex-col w-full xl:w-auto text-gray-800 text-xl mr-3 mb-3 xl:mb-0" >
        					<span class=""> {{ $item->name }}</span> 
        				</h3>
						<div class=" mb-3 mr-3 xl:mb-0">
		    				<form action="{{ route('cart.update', $item->id) }}" method="POST" accept-charset="utf-8">
		    					@csrf
		    					@method('PATCH')
		    					<div class="flex flex-col">
			    					<input type="number" name="quantity" class="w-full xl:w-40  mr-3 px-4 py-2 rounded-t border  border-c-light-gray " value="{{ $item->quantity }}" >
			    					<button type="submit" class="px-3 py-2  xl:w-40 rounded-b bg-c-light-blue opacity-75 text-white text-xl cursor-pointer hover:opacity-50">Update</button>
			    				</div>
		    				</form>
		    			</div>
						<div class="w-full xl:w-auto mb-4 xl:mb-0">
    						<span class="text-sm text-gray-800 text-xl xl:px-2 w-56 xl:hidden xl:mb-0">Price </span>
    						<span class="w-full xl:w-auto text-sm text-gray-800 text-xl xl:px-2  xl:mb-0">Rs {{ $item->price }} </span>
    					</div>
        				<div class="w-full xl:w-auto mb-4 xl:mb-0">
    						<span class="text-sm text-gray-800 text-xl xl:px-2 w-56 xl:hidden xl:mb-0">Total </span>
    						<span class="text-xl font-bold text-gray-800 w-full xl:w-auto mb-4 xl:mb-0">Rs {{ $item->quantity * $item->price }}</span>
    					</div>
	        				
	    			</div>
	    		@empty
	    			<div class="my-4 flex flex-col items-center w-full">
	    				<div class="py-4 flex flex-col items-center justify-center">
		    				<svg class="w-16 md:w-24 text-c-red mb-4" fill="currentColor" stroke-width="1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
		    				<p class="text-gray-900 text-xl py-3 text-left">No item in my bag.</p>
		    			</div>

	    				<a href="/shop" class="px-10 py-3 mt-5 rounded bg-gray-900 hover:opacity-75 text-white text-xl cursor-pointer">Browse Products</a>
	    			</div>
	    		@endforelse
	    	</div> --}}

	    	<!-- Cart Details -->
	    	@if($total_qty)
        	<div class="w-full  flex flex-col  border-gray-400 rounded  mt-5 xl:mt-0 border xl:relative">
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

@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){

	// let imgBlock = document.querySelectorAll('.imgBlock');
	// // let addBtn   = document.querySelectorAll('.addBtn');
	// imgBlock.forEach((block)=>{
	// 	block.addEventListener('mouseover', (e) => {
	// 		console.log(e.target.children.classList.contains('addBtn'));
	// 		// e.target.
	// 		// e.target.lastElementChild.classList.toggle('hidden');
	// 	});
	// });
    // var slider = tns({
    //     container: '.categories',
    //     items: 1,
    //     responsive: {
    //       640: {
    //         // edgePadding: 20,
    //         gutter: 10,
    //         items: 2
    //       },
    //       700: {
    //         // gutter: 30
    //       },
    //       900: {
    //         items: 3,
    //         gutter: 20
    //       },
    //       1080: {
    //         items: 4
    //       }
    //     },
    //     controls :false,
    //     mouseDrag : true
    // });

});

</script>

@endpush
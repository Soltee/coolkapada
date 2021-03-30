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
          <h4 class="text-lg font-bold text-gray-900 ">SHOP</h4>
        </div>
        
        <span class=" text-gray-900 ">
          {{ $first . ' - ' . $last }} of {{ $count }} @if(request()->search) found @endif
        </span>
      </div>

      <!-- Products -->
			<div class="w-full grid gap-6 grid-cols-1 md:grid-cols-3 lg:grid-columns-4">
		    @forelse($products as $product)
          <div class="flex flex-col items-center mb-8">
            <div 
	        					class="imgBlock relative w-full  cursor-pointer">
	        					<div class="overflow-hidden">
			        				<a class="" href="{{ route('product', $product->slug)}}">
				        				<img  class="w-full mb-5 rounded object-cover hover:opacity-70 shadow" src="{{ asset($product->image_url) }}" alt="{{ $product->slug }}">
				        			</a>
				        		</div>
			        			@if($product->prev_price)	        				
			        				<span class="bg-red-600 text-center rounded-lg text-white p-3 absolute top-0 right-0 -mr-3 -mt-3">{{ $product->price_level() }}% off</span>
			        			@endif
			        	

            </div>
            
            <div class="flex flex-col  justify-between w-full">
              <div class="flex justify-between items-center mb-3">
                <h5 class="text-lg text-c-dark-gray">{{ $product->name }}</h5>
              </div>
              <div class="flex items-center mb-3">

                @if($product->qty < 1)
                    <span class="px-2 py-2 rounded-lg text-white bg-red-600">Out of Stock</span>'
                @else
                  @if($product->prev_price)
                  <span class=" line-through mr-4">Rs {{ $product->prev_price }}</span>
                  @endif
                  <span class="p-3 border-1 border-c-light-gray {{ $product->prev_price ?? 'text-lg' }}">Rs {{ $product->price }}</span>
                @endif

              </div>
            </div>
          
          
          <div class="w-full">
						<form method="POST" action="{{ route('bag.store') }}">
							@csrf
							  <input type="text" class="hidden" name="generateId" value="{{ $product->id }}">
	        				
		        			<!-- Colors & -->
                  <div class="w-full  mb-3 flex flex-col">
                    <div class="flex flex-row items-center">
                      @forelse(explode(',', $product->colors) as $c)
    
                        <label  class="custom_radio relative flex flex-col">
                          <input class="hidden" type="radio"  
                          {{ ($loop->first) ? 'checked' : '' }} 
                          name="color" value="{{ $c }}">
                          <span  class="radio_btn mr-2 px-3 py-3 rounded-full  border-2 border-white text-gray-900 cursor-pointer hover:border-gray-400" style="background-color: {{ $c }}"
                          >
                            
                          </span>
                          
                        </label>
                        
                      @empty
    
                      @endforelse
                    </div>							
                  </div>
                
                  <div class="w-full  mb-4 flex flex-col">
                    <div class="flex flex-row items-center">
                      @forelse(explode(', ', $product->sizes) as $s)
    
                        <label  class="custom_radio2 relative flex flex-col">
                          <input class="hidden" type="radio"  
                          {{ ($loop->first) ? 'checked' : '' }}  
                          name="size" value="{{ $s }}">
                          <span  class="radio_btn2 mr-2 px-4 py-3 rounded-lg  border-2 border-white text-gray-900 cursor-pointer hover:border-gray-400"
                          >
                            {{ $s }}
                          </span>
                          
                        </label>
                        
                      @empty
    
                      @endforelse
                    </div>							
                  </div>

                  @if($product->qty > 1)
                    
                    <button type="submit" class="w-full my-4 px-8 py-4 rounded bg-gray-900 hover:opacity-75 text-white ">Add To Bag</button>
                      
                  @else
                    <button class="w-full my-4 px-8 py-4" >Out of Stock</button>
                  @endif
							
            </form>
          </div>
		        			
		      </div>
		    @empty
	    	@endforelse
		  </div>

          
		  <div class=" flex justify-center items-center my-6">
		    @if($products->appends(request()->input())->previousPageUrl())
		        	<a class="px-6 py-3 rounded text-c-dark-gray border-1 hover:bg-gray-900 hover:text-white" href="{{ $products->appends(request()->input())->previousPageUrl()}}">
		        		Prev
		        	</a>
		    @else
		        	<span class="px-6 py-3 rounded text-transparent ">
		        		Prev
		        	</span>
		        	
        @endif
        
        <span class="px-6 py-3 mx-4 rounded  border-1 bg-gray-900 text-white">{{ $products->appends(request()->input())->currentPage() }}</span>
        
		    @if($products->appends(request()->input())->nextPageUrl())
		        	<a class="px-6 py-3 rounded text-c-dark-gray border-1 hover:bg-gray-900 hover:text-white" href="{{ $products->appends(request()->input())->nextPageUrl()}}">
		        		Next
		        	</a>
		    @else
		        	<span class="px-6 py-3 rounded text-transparent ">
		        		Next
		        	</span>
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
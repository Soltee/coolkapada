@extends('layouts.app')
@section('head')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/tiny-slider.css">

	<style>
		.custom_radio input:checked + .radio_btn{
			border: 2px solid black;
			/*padding: 24px;*/
		}
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
	<div class="px-6  py-3 w-full flex flex-col md:flex-row">


		<!--- Left hand side -->
		<div class="w-full md:w-56">
			<div class="mr-0 md:mr-4">

				<form method="GET" action="/shop">
					@csrf
					<input type="hidden" name="_filter" value="_filter">

						<div class="border-t border-gray-200 px-4 py-6">
							<div class="flex justify-between">
		          	<h3 class="-mx-2 -my-3 flow-root">
		            	Category
		          	</h3>

		        	</div>
		          <!-- Filter section, show/hide based on section state. -->
		          <div class="pt-6" id="filter-section-mobile-1">
		          	@forelse($categories as $cat)
		          		<div class="space-y-6">

			              <div class="flex items-center">
			                <input 
			                	id="filter-mobile-category-2" 
			                	name="category" 
			                	value="{{ $cat->id }}" 
			                	type="radio"
			                	{{ ($cat->id === $category) ? 'checked' : '' }}  
			                	class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
			                <label for="filter-mobile-category-2" class="ml-3 min-w-0 flex-1 text-gray-500">
			      		      	{{ $cat->name }}
			                </label>
			              </div>

		             </div>
		          
								@empty
								@endforelse

		           </div>
		        </div>

	        	<div class="border-t border-gray-200 px-4 py-6">
	            <h3 class="-mx-2 -my-3 flow-root">
	              Size
	            </h3>

	            <!-- Filter section, show/hide based on section state. -->
	            <div class="pt-6" id="filter-section-mobile-2">
	              <div class="space-y-6">
	                
	                @forelse($sizes as $s)
			          		<div class="space-y-6">

				              <div class="flex items-center">
				                <input 
				                	id="filter-mobile-category-2" 
				                	name="size" 
				                	value="{{ $s['symbol'] }}" 
				                	type="radio"
				                	{{ ($s['symbol'] === $size) ? 'checked' : '' }}  
  
				                	class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
				                <label for="filter-mobile-category-2" class="ml-3 min-w-0 flex-1 text-gray-500">
	      		      				{{ $s['name'] }}
				                </label>
				              </div>

			             </div>
			          
									@empty
									@endforelse


	              </div>
	            </div>

	          </div>

	          <div class=" flex flex-col">

	          	<button type="submit" class="mb-3 bg-gray-900 hover:opacity-70 text-white rounded px-3 py-2 font-bold w-full">FILTER</button>
	          	<a href="/shop" class="text-center bg-white text-gray-900 rounded px-3 py-2 font-bold w-full hover:text-white hover:bg-gray-900">RESET</a>

	          </div>
	      </form>

	    </div>

		</div>
		<!--- Right hand side -->
		<div class="flex-1 flex flex-col">
	        
      <div class="flex  justify-between items-center mb-8 w-full">
        <div class="flex items-center">
          <a href="/"><h4 class="text-md opacity-75 hover:opacity-100 font-light text-gray-900 mr-2">HOME</h4></a>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
          <h4 class="text-lg font-bold text-gray-900 ">SHOP</h4>
        </div>
        
        <span class=" text-gray-900 ">
        	@if($count > 0)
          	{{ $first . ' - ' . $last }} of {{ $count }} @if(request()->keyword) found @endif
          	@endif
        </span>
      </div>

      <div class="flex flex-col">
	      <!-- Products -->
				<div class="w-full grid gap-6 grid-cols-1 md:grid-cols-3 lg:grid-columns-4">

			    @forelse($products as $product)

						<div class="flex flex-col items-center mb-8">
																
							<livewire:customer.product :p="$product->id" :url="'/product/'.$product->slug"/>
							
						</div>

					@empty
						<div class="flex flex-col items-center mb-8">

							<p class="font-thin text-md text-red-600 text-center flex items-center w-full">
								Oops! No products @if(request()->keyword) match the search term. @endif
							</p>

						</div>


					@endforelse

				</div>

	      <!-- Pagination -->
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
					
	        @if($count > 0)
						<span class="px-6 py-3 mx-4 rounded  border-1 bg-gray-900 text-white">{{ $products->appends(request()->input())->currentPage() }}</span>
					@endif

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
		</div>
  </div>
      
@endsection
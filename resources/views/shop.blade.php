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
          {{ $first . ' - ' . $last }} of {{ $count }} @if(request()->keyword) found @endif
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
							<img  class="w-full mb-5 rounded object-cover hover:opacity-70 shadow" src="{{ asset($product->media->image_url) }}" alt="{{ $product->slug }}">
						</a>
					</div>
							
				</div>
				
					<livewire:customer.product :p="$product->id" :url="'/product/'.$product->slug"/>
				
			</div>
				@empty
					<p class="font-thin text-md text-gray-900">
						Oops! No products @if(request()->keyword) match the search term. @endif
					</p>
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
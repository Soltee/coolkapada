@extends('layouts.app')
@section('head')

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/tiny-slider.css">

	<style>
		.custom_radio input:checked + .radio_btn{border: 2px solid black;}
		.custom_radio2 input:checked + .radio_btn2{border: 2px solid black;}
    	.imgBlock:hover img{opacity: 0.8; transform: scale(1.2);}

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
		.imgBlock:hover img{opacity: 0.7;}
		.imgBlock:hover  .addBtn {
			visibility: initial;
		}
		/* .tns-controls{ text-align: center; } */
		@media screen and (max-width: 740px){
			.tns-controls{
				display: block;
				position: absolute;
				right: 0;
				top: 0;
				display: flex;justify-content: center;
				margin: 0 4px 0 0;
				text-align: center;
			
        }} 


	</style>
@endsection
@section('content')
	<div class="px-6  py-3 w-full">
	        
      	<div class="flex justify-between items-center mb-8 w-full">
	        <div class="flex items-center">
	          <a href="/"><h4 class="text-md opacity-75 hover:opacity-100 font-light text-gray-900 mr-2">HOME</h4></a>
	          	<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
	          	<a href="/shop"><h4 class="text-md opacity-75 hover:opacity-100 font-light text-gray-900 mr-2 ">SHOP</h4></a>
	          	<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
	        	<h4 class="text-lg font-bold text-gray-900 ">{{ $product->name }}</h4>
	        </div>
      	</div>


    	<!-- Product Component-->
		<livewire:customer.product 
			:p="$product->id" 
			:url="'/product/'.$product->slug"
			:from="'single'"/>

				
		<!-- Description && Reviews -->
		<div 
			x-data="{ tab : 'detail' }"
			class="mt-16 mb-10 w-full">
			<div id="tab-nav" class="flex items-center mb-4">
				<h5 
					:class="{ 'font-bold': tab === 'detail' }" 
					x-on:click="tab = 'detail'"
					class="text-lg cursor-pointer mr-3 font-light text-c-light-black md:w-32">Description</h5>
				<h5 
					:class="{ 'font-bold': tab === 'reviews' }" 
					x-on:click="tab = 'reviews'"
					class="text-lg cursor-pointer mr-3 font-light text-c-light-black md:w-32">Reviews</h5>
				
			</div>

			<div id="tab-contents mt-6 w-full">
		        {{-- <div 
		        	x-show.transition.in.duration.200ms.out.duration.50ms="tab == 'detail'"
		        	class="tabtxt text-gray-900 active w-full leading-relaxed">
		        	{!! $product->description !!}
		        </div> --}}
		        <div 
		        	{{-- x-show.transition.in.duration.200ms.out.duration.50ms="tab == 'reviews'" --}}
		        	class="tabtxt text-gray-900 active w-full leading-relaxed">
		        	
		        	<!--- Product Review Livewire Component -->
		        	<livewire:customer.product-review 
		        		:product="$product->id"
		        		/>
		        </div>
		        
		    </div>
		</div>


		<div class="relative mt-16 mb-10">

			<h5 class="text-lg font-semibold text-gray-800 mr-2 ">Similar Products</h5>

			<div 
				style="cursor: grab"
				class="similar">
				@forelse($similar as $product)

					<div class="flex flex-col items-center shadow rounded-lg">
		                <div 
		                    class="imgBlock relative w-full  cursor-pointer w-full">
		                    <div class="overflow-hidden">
		                        <a class="" 
		                            href="{{ route('product', $product->slug)}}">
		                            <img  
		                                class="w-full mb-5 h-72 object-top object-fit rounded object-cover hover:opacity-70" 
		                                src="{{ asset($product->media->image_url) }}" 
		                                alt="{{ $product->slug }}">
		                        </a>
		                    </div>
		                </div>
		                      
		                <div class="pb-3 px-3">

		                    <div class="mt-3flex  justify-between items-center mb-2">
		                        <a class="" href="{{ route('product', $product->slug)}}">
		                            <h2 class="hover:font-bold cursor-pointe text-thin text-gray-700">
		                                {{ $product->name }} 
		                            </h2>
		                        </a>
		                        <h4 class="text-lg font-semibold">
		                            RS {{ $product->min }} +
		                            NP 
		                        </h4>

		                    </div>

		                    @if(!$product->attributes()->sum('quantity'))
		                        <div class="flex items-center">
		                            <span class="font-bold text-red-600">Out of Stock</span>
		                        </div>
		                    @endif

		                </div>
		              
		            </div>

		
					
				@empty
				@endforelse
        	</div>
		</div>
      
    </div>
      
@endsection

<!-- JS -->
@push('scripts')

	<script src="{{ asset('js/wheelzoom.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
	<script>
    document.addEventListener('DOMContentLoaded', function () { 		


    	let thumbnails = document.getElementsByClassName('thumbnail')

		let activeImages = document.getElementsByClassName('active')

		for (var i=0; i < thumbnails.length; i++){

			thumbnails[i].addEventListener('mouseover', function(){
				// console.log(activeImages)
				
				if (activeImages.length > 0){
					activeImages[0].classList.remove('active')
				}

				this.classList.add('active')
				let img = document.getElementById('featured');
				img.src = this.src;
			})
		}

		var slider = tns({
        container: '.similar',
        items: 1,
        responsive: {
          640: {
            edgePadding: 40,
            gutter: 10,
            items: 3
          },
          700: {
            gutter: 30
          },
          900: {
            items: 4,
            // gutter: 20
          },
          1080: {
            items: 4
          }
        },
        controls : true,
        // controlsPosition: top,
        controlsText : [
              '<svg class="w-8 h-8 md:hidden text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.05 9.293L6.343 10 12 15.657l1.414-1.414L9.172 10l4.242-4.243L12 4.343z"/></svg>', 
              '<svg class="w-8 h-8 md:hidden text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>'
        ],
        mouseDrag : true,
        arrowKeys: true

    });



		wheelzoom(document.querySelector('.featured'));

	
	});

	</script>

@endpush


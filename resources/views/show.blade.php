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
          	<a href="/shop"><h4 class="text-md opacity-75 hover:opacity-100 font-light text-gray-900 mr-2 ">SHOP</h4></a>
          	<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
        	<h4 class="text-lg font-bold text-gray-900 ">{{ $product->name }}</h4>
        </div>
        
      </div>


      <div class="flex flex-col md:flex-row justify-around ">
				<div class="w-full md:w-1/2 mt-4 
				 ">
		
					<div class="relative imageDiv
						 ">
						<img id="featured" 
						  class="focus-img shadow-lg cursor-move grabbable featured w-full object-cover object-center" src="{{ asset($product->media->image_url) }}">
						<p 
							class="text absolute top-0 right-0 flex justify-center items-center text-c-pink text-md">
							Scroll in or out to zoom
						</p>
						@if($product->prev_price)	        				
							<span class="bg-c-pink text-center text-white p-2 absolute top-0 left-0 -mt-4">{{ $product->price_level() }}% off</span>
						@endif
					</div>

					@if($image_count > 1)
					<div id="slide-wrapper w-full 
						" >
						<div id="slider" class="flex flex-row">
							@forelse($images as $img)
								<img  
								 class="thumbnail glightbox3 cursor-pointer w-16 h-16 border border-gray-300 md:w-24 md:h-24 object-cover object-center
									" 
									src="{{ asset($img->media->image_url) }}"/>
							@empty
							@endforelse

						</div>

					</div>
					@endif
					
				</div>
				<div class="md:ml-8 w-full md:w-1/2 mt-4  md:py-0 flex flex-col">

					<livewire:customer.product :p="$product->id" :url="'/product/'.$product->slug"/>

				</div>
			</div>


			<div 
				x-data="{ tab : 'detail' }"
				class="mt-16 mb-10 w-full">
				<div id="tab-nav" class="flex items-center mb-4">
					<h5 
						:class="{ 'font-bold': tab === 'detail' }" x-on:click="tab = 'detail'"
						class="text-lg cursor-pointer mr-3 font-light text-c-light-black md:w-32">Description</h5>
					
				</div>

				<div id="tab-contents mt-6 w-full">
			        <div 
			        	x-show.transition.in.duration.200ms.out.duration.50ms="tab == 'detail'"
			        	class="tabtxt text-gray-900 active w-full leading-relaxed">
			        	{!! $product->description !!}
			        </div>
			        
			    </div>
			</div>
			<div class="relative mt-16 mb-10">

				<h5 class="text-lg font-light text-c-light-black mr-2 mb-6">Similar Products</h5>

        <div class="  
                similar hover:cursor-move           
              ">
              @forelse($similar as $p)
                <div class="flex flex-col items-center">
                    <div 
						class="imgBlock relative w-full  cursor-pointer">
						<div class="overflow-hidden">
							<a class="" href="{{ route('product', $p->slug)}}">
								<img  class="w-full mb-5 rounded object-cover hover:opacity-70 shadow" src="{{ asset($p->media->image_url) }}" alt="{{ $p->slug }}">
							</a>
						</div>
					</div>
					
					<livewire:customer.product :p="$p->id" :url="'/product/'.$p->slug"/>

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
            edgePadding: 20,
            gutter: 10,
            items: 3
          },
          700: {
            // gutter: 30
          },
          900: {
            items: 4,
            gutter: 20
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


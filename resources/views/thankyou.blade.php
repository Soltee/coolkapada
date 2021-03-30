@extends('layouts.app')

@section('head')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/tiny-slider.css">
    <style>
        .imgBlock:hover img{opacity: 0.8; transform: scale(1.2);}
	</style>

@endsection

@section('content')
    <div class="">
	    
	    <div class="px-6  py-3  flex  flex-col md:flex-row ">
	    	<div class="w-full flex-1 md:w-1/2 md:mr-8 bg-gray-300">

	    		<div class=" mx-4 mt-6">
	        		<div class="flex items-center my-3">
		    			<svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-c-light-green mr-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
	    				<p class="text-c-dark-gray leading-relaxed">{{ session('success_message') }}</p>
	    			</div>

	    			<div class="my-5 border border-gray-400 rounded">
	    				<div class=" border-2 border-gray-300 rounded-lg p-3 mb-5">
			    			<h4 class="text-sm text-c-light-blue">Personal Info</h4>

			    			<div class="my-5">
				    			<div class="flex items-center mb-4">
					    			<div class="md:w-1/2 md:mr-2 flex flex-col text-lg text-c-dark-gray">
					    				{{ $order->first_name . ' ' . $order->last_name  }}
					    			</div>
				    			</div>
				    			<div class="flex flex-col mb-4 text-lg text-c-dark-gray">
					    			{{ $order->email }}
					    		</div>
					    		<div class="flex flex-col mb-4 text-lg text-c-dark-gray">
					    			{{  $order->phone_number }}
					    		</div>
			    			</div>

			    		</div>

			    		<div class=" border-2 border-gray-300 rounded-lg p-3 mb-5">
			    			<h4 class="text-sm text-c-light-blue">Billing Info</h4>

			    			<div class="my-5">
			    				<div class="mb-4 flex flex-col text-lg text-c-dark-gray">
					    			{{  $order->city }}			    	
					    		</div>
				    			<div class="flex flex-col items-start mb-4 text-lg text-c-dark-gray">

					    			{{  $order->street_address }}	,
					    			{{  $order->house_number }}
				    	
				    			</div>
				    			
							</div>
			    		</div>

			    		<div class=" border-2 border-gray-300 rounded-lg p-3 mb-5">
			    			<h4 class="text-sm text-c-light-blue">Payment Info</h4>

			    			<div class="my-5">
				    			<div class="flex flex-col mb-4">
					    			<label  class=" relative flex flex-col">
										
										<div class=" mr-2 px-5 py-3 rounded-lg  border border-white text-gray-900 cursor-pointer border-green-500 flex items-center @error('payment_method') border-red-500  @enderror">
											<svg xmlns="http://www.w3.org/2000/svg" class="rounded-full p-1 border border-green-600   w-8 h-8  text-green-600 mr-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
											<span class="text-md">Cash on Delivery</span>
										</div>
									</label>
					    		</div>
			    			</div>
			    		</div>
	    			</div>

	    			<div 
	    				x-data="{ open : true }"
	    				class="">
		    			<div class="flex justify-between items-center mb-6">
				        	<h4 class="text-lg text-gray-800">Your Order (Rs {{ $order->grand_total }})</h4>
				        	<svg
				        		x-on:click="open = !open" 
				        		xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-800 font-bold cursor-pointer" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
				        </div>
		        		<div 
		        			x-show.transition.50ms="open" 
		        			class="mb-16">
			        	@forelse($items as $item)
			        		<div class="flex justify-between mb-5">

			        			<img  class="image rounded w-40 mr-3" src="{{ asset($item->image_url) }}" alt="{{ $item->image_url }}">
			        			<div class="flex flex-col my-4">
				        			<div class="flex items-center justify-between mb-3">
				        				<h3 class="mr-3 text-gray-800 text-lg mb-4" >
				        					<span class="mr-2"> {{ $item->name }}</span> * 
				        					<span class="ml-2 text-xl font-bold">{{ $item->qty }} </span>
				        				</h3>
				        				
				        			</div>
				        			<div class="flex items-center">
					        			<span class="text-xl font-bold text-gray-800">Rs {{ $item->qty * $item->price }}</span>
					        		</div>
				        				
				        		</div>
			        		</div>
			        	@empty
			        	@endforelse
			        	</div>

			        </div>


			        	<!-- Order Details -->
			        	<div class="flex flex-col border border-gray-400 rounded my-6">
			        		<div class="flex justify-between items-center mb-4 px-3 pt-3">
			        			<h5 class="text-gray-800 text-md">SubTotal</h5>
			        			<span class="text-gray-800 text-md">Rs {{ $order->sub_total }}</span>
			        		</div>
			        		<div class="flex justify-between items-center mb-4 px-3 ">
			        			<h5 class="text-gray-800 text-md">Discount</h5>
			        			<span class="text-gray-800 text-md">Rs {{ $order->discount }}</span>
			        		</div>
			        		<div class="flex justify-between items-center mb-4 px-3 ">
			        			<h5 class="text-gray-800 text-md">Shipping</h5>
			        			<span class="text-gray-800 text-md">Rs 0</span>
			        		</div>
			        		<div class="flex justify-between items-center mb-4 border-t border-gray-400 pt-3 px-3">
			        			<h5 class="text-gray-800 text-lg">Total</h5>
			        			<span class="text-gray-800 text-xl font-bold">Rs {{ $order->grand_total }}</span>
			        		</div>
			        	</div>
	        	</div>

	    	</div>
	        <div class="relative w-full md:w-1/2  p-5 ">
	        	
	        	<h5 class="">Check out our recommended products.</h5>
	           	<div class="mt-10 w-full grid grid-cols-1 lg:grid-cols-2 gap-6 ">
	           		@forelse($products as $product)
	           			<div class="w-full flex flex-col items-center mb-6">
							<div 
							class="imgBlock relative w-full  cursor-pointer">
								<div class="overflow-hidden">
									<a class="" href="{{ route('product', $product->slug)}}">
										<img  class="w-full mb-5 rounded object-cover hover:opacity-70 shadow" src="{{ asset($product->image_url) }}" alt="{{ $product->slug }}">
									</a>
								</div>
								@if($product->prev_price)	        				
									<span class="bg-red-600 text-center rounded-lg text-white p-3 absolute top-0 right-0">{{ $product->price_level() }}% off</span>
								@endif
					

							</div>

		        			<div class="flex flex-col items-start justify-between">
		        				<h5 class="mb-3 text-lg text-c-dark-gray">{{ $product->name }}</h5>
		        				<div class="flex items-center mb-3">
		        					@if($product->prev_price)
		        					<span class=" line-through mr-4">Rs {{ $product->prev_price }}</span>
		        					@endif
		        					<span class="p-3 border-1 border-c-light-gray {{ $product->prev_price ?? 'text-lg' }}">Rs {{ $product->price }}</span>
								</div>
		        			</div>
	           			</div>
	           		@empty
	           		@endforelse
	           	</div>

	           	<div class="mt-6 w-full flex justify-end">
					<a href="/shop" class="px-10 py-3  rounded bg-gray-900 hover:opacity-75 text-white text-lg cursor-pointer">Browse More</a>
				</div>
	        </div>
	    </div>
    </div>
@endsection
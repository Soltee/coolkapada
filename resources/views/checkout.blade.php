@extends('layouts.app')

@section('head')
<style>
	.custom_radio:hover .svg{
		color: green;
		border: 0.6px solid green;
	}
	.custom_radio input:checked + .radio_btn{
		border: 0.6px solid green;
	}	
	.custom_radio input:checked + .svg{
		color: green;
		border: 0.6px solid green;
	}
</style>
@endsection
@section('content')
    <div class="px-6 flex flex-col lg:flex-row justify-center my-6 w-full">

    	<div class="w-full lg:w-1/2 md:mr-8">
    		<form method="POST" action="{{ route('checkout.store') }}">   
	    		@csrf		
		    		<div class="flex flex-col border border-lighter-black rounded-lg p-3 mb-4">
		    			<h3 class="mt-2 mb-3">
		    				<span class="mr-2 border px-3 py-2 border-gray-400 rounded-full text-md text-c-light-blue">1</span> 
		    				<span class="text-md text-c-light-blue font-semibold">Personal Info</span>
		    			</h3>

		    			<div class="mt-5 mb-3">
			    			<div class="flex flex-col lg:flex-row items-center mb-4">
				    			<div class="w-full lg:w-1/2 lg:mr-2 flex flex-col mb-4 md:mb-0">
				    				<label for="first_name" class="mb-2 text-c-lighter-black text-sm">First name</label>
				    				@if($auth)
				    					<input type="text" name="first_name" value="{{ old('first_name') ?? $auth->first_name }}" class="px-6 py-3 rounded-lg border border-gray-300 @error('first_name') border-red-500  @enderror" placeholder="Shraddha">
				    				@else
				    					<input type="text" name="first_name" value="{{ old('first_name') ?? ''  }}" class="px-6 py-3 rounded-lg border border-gray-300 @error('first_name') border-red-500  @enderror" placeholder="Shraddha">

				    				@endif

				    				<div class="md:hidden mb-2  flex flex-col">
						    			@error('first_name')
					    					<p class="text-c-red">{{ $message }}</p>
					    				@enderror
				    				</div>
					    			
				    			</div>
				    			<div class="w-full lg:w-1/2  lg:ml-2 flex flex-col">
				    				<label for="last_name" class="mb-2 text-c-lighter-black text-sm">Last name</label>
				    				@if($auth)

				    					<input type="text" name="last_name" value="{{ old('last_name') ?? $auth->last_name }}" class="px-6 py-3 rounded-lg border border-gray-300 @error('last_name') border-red-500  @enderror" placeholder="Shrestha">
				    				@else
				    					<input type="text" name="last_name" value="{{ old('last_name') ?? '' }}" class="px-6 py-3 rounded-lg border border-gray-300 @error('last_name') border-red-500  @enderror" placeholder="Shrestha">

				    				@endif

				    				<div class="md:hidden mb-2  flex flex-col">
						    			@error('last_name')
					    					<p class="text-c-red">{{ $message }}</p>
					    				@enderror
				    				</div>
				    			</div>
			    			</div>
			    			<div class="hidden md:block md:flex  md:flex-row md:items-center mb-6">
			    				<div class="md:w-1/2 md:mr-2 flex flex-col">
					    			@error('first_name')
				    					<p class="text-c-red">{{ $message }}</p>
				    				@enderror
			    				</div>
				    			<div class="md:hidden mb-2  flex flex-col">
					    			@error('last_name')
				    					<p class="text-c-red">{{ $message }}</p>
				    				@enderror
			    				</div>
			    			</div>
			    			<div class="flex flex-col mb-4">
			    				<label for="email" class="mb-2 text-c-lighter-black text-sm">Email</label>
			    				@if($auth)
			    					<input type="email" name="email" value="{{ old('email') ?? $auth->email }}" class="px-6 py-3 rounded-lg border border-gray-300 @error('email') border-red-500  @enderror" placeholder="shraddha@gmail.com">

			    				@else
			    					<input type="email" name="email" value="{{ old('email') ?? '' }}" class="px-6 py-3 rounded-lg border border-gray-300 @error('email') border-red-500  @enderror" placeholder="shraddha@gmail.com">

			    				@endif

			    				<div class="hidden md:block w-full mt-3">
					    			@error('email')
				    					<p class="text-c-red">{{ $message }}</p>
				    				@enderror
			    				</div>
				    		</div>
				    		<div class="flex flex-col mb-4">
				    			<label for="phone_number" class="mb-2 text-c-lighter-black text-sm">Phone number</label>
				    			<div class="flex items-center">
				    				<span class="p-3 w-16 border border-lighter-black rounded-lg w-auto">+977</span>
				    				<input type="number" name="phone_number"  value="{{ (old('phone_number')) ?? ''  }}" class="px-6 py-3 rounded-lg border w-48 border-lighter-black  @error('phone_number') border-red-500  @enderror" placeholder="980*******">
				    			</div>
			    				<div class=" w-full mt-3">
					    			@error('phone_number')
				    					<p class="text-c-red">{{ $message }}</p>
				    				@enderror

			    				</div>
				    		</div>
		    			</div>		    			
		    		</div>

		    		<div class="flex flex-col border border-lighter-black rounded-lg p-3 mb-4">
		    			<h3 class="mt-2 mb-3">
		    				<span class="mr-2 border px-3 py-2 border-gray-400 rounded-full text-md text-c-light-blue">2</span>
		    				<span class="text-md text-c-light-blue font-semibold">Billing Info</span>
		    			</h3>

		    			<div class="mt-5 mb-3">
		    				<div class="mb-4 flex flex-col">
			    				<label for="city" class="mb-2 text-c-lighter-black text-sm">City</label>
			    				<select name="city" class="px-4 py-3 rounded-lg">
			    					<option class="" value="pokhara">Pokhara</option>
			    				</select>
				    		</div>
			    			<div class="box-content flex  flex-col lg:flex-row lg:items-center mb-4">
				    			<div class="lg:w-1/2 lg:mr-2 flex flex-col mb-4 lg:mb-0">
				    				<label for="street_address" class="mb-2 text-c-lighter-black text-sm">Street Address</label>
				    				<input type="text" name="street_address" value="{{ old('street_address') ?? '' }}" class="px-6 py-3 rounded-lg border border-gray-300 @error('street_address') border-red-500  @enderror" placeholder="Birauta, 17 Smaj Ghar">
				    				<div class="md:hidden mb-2  flex flex-col">
						    			@error('street_address')
					    					<p class="text-c-red">{{ $message }}</p>
					    				@enderror
				    				</div>
				    			</div>
				    			<div class="lg:w-1/2  lg:ml-2 flex flex-col">
				    				<label for="house_number" class="mb-2 text-c-lighter-black text-sm">House Number</label>
				    				<input type="number" name="house_number" class="px-6 py-3 rounded-lg border border-gray-300 @error('house_number') border-red-500  @enderror" placeholder="4598" value="{{ old('house_number') ?? '' }}">	
				    				<div class="md:hidden mb-2  flex flex-col">
						    			@error('house_number')
					    					<p class="text-c-red">{{ $message }}</p>
					    				@enderror
				    				</div>
				    			</div>
			    			</div>

			    			<div class="hidden md:block md:flex  md:flex-row md:items-center mb-4">
			    				<div class="md:w-1/2 md:mr-2 flex flex-col">
					    			@error('street_address')
				    					<p class="text-c-red">{{ $message }}</p>
				    				@enderror
			    				</div>
				    			<div class="md:w-1/2 md:mr-2 flex flex-col">
					    			@error('house_number')
				    					<p class="text-c-red">{{ $message }}</p>
				    				@enderror
			    				</div>
			    			</div>
			    			
		    			</div>
  			
		    		</div>

		    		<div  class=" flex flex-col border border-lighter-black rounded-lg p-3 mb-4">
		    			<h3 class="mt-2 mb-3">
		    				<span class="mr-2 border px-3 py-2 border-gray-400 rounded-full text-md text-c-light-blue">3</span> 
		    				<span class="text-md text-c-light-blue font-semibold">Payment Info</span>
		    			</h3>

		    			<div class="mt-5 mb-2">
			    			<div class="flex flex-col">
			    				<label  class="custom_radio relative flex flex-col">
									<input class="hidden" type="radio"  {{ old('payment_method') ? 'checked' : '' }} 
									name="payment_method" value="cash-on-delivery">
									<div class="radio_btn mr-2 px-5 py-3 rounded-lg  border border-white text-gray-900 cursor-pointer hover:border-green-500 flex items-center @error('payment_method') border-red-500  @enderror">
										<svg xmlns="http://www.w3.org/2000/svg" class="rounded-full p-1 border svg   w-8 h-8  hover:text-green-600 mr-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
										<span class="text-md">Cash on Delivery</span>
									</div>
								</label>
			    				
				    		</div>
				    		
		    			</div>

		    		</div>
	    			<div id="payBtn" class="fixed z-20 bottom-0 left-0 right-0 px-6 md:px-0 w-full md:relative md:hidden  md:flex m mb-8 d:justify-end mb-4">
	    				<button  type="submit" class="px-10 py-4  w-full rounded bg-c-light-blue hover:opacity-75 text-white text-lg cursor-pointer">Pay Now</button>
	    			</div>
	    			<div  class="hidden md:block z-20 bottom-0 left-0 right-0 px-6 md:px-0 w-full md:relative md:static  md:flex m mb-8 d:justify-end mb-4">
	    				<button  type="submit" class="px-10 py-4  w-full rounded bg-gray-900 hover:opacity-75 text-white text-lg cursor-pointer">Pay Now</button>
	    			</div>
	    	</form>
	    	
    	</div>
    	
        <div class="w-full  lg:w-1/2  p-5 bg-gray-300 rounded">
        	<div 
        		x-data="{ cart : true }"
        		class="mt-4">
        		<div class="flex justify-between items-center mb-6">
	        		<h4 class="text-lg text-gray-800 ">Order Summary ( Rs {{ $total + $shipping }} )</h4>

		        	<svg
		        		x-on:click="cart = !cart" 
		        		xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-800 font-bold cursor-pointer" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
	        	</div>
        		<div
        			x-show.transition.50ms="cart" 
        			class="mb-16">
	        	@forelse($cartCollection as $item)
	        		<div class="flex flex-col md:flex-row mb-5">

                <img  class="image rounded w-40 mr-3" src="{{ asset($item->attributes->image_url) }}" alt="{{ $item->attributes->image_url }}">

	        			<div class="flex flex-col my-4 md:w-1/2 ">
		        			<div class="flex flex-col items-start mb-3">
		        				<h3 class="flex flex-col text-gray-800 text-lg mb-4" >
		        					<span class=""> {{ $item->name }}</span> 
		        				</h3>
		        				<div class="flex items-center">
		        					<span class="text-sm text-gray-800 text-lg mr-5">{{ $item->quantity }} * {{ $item->price }} </span>
			        				<span class="text-xl font-bold text-gray-800">Rs {{ $item->quantity * $item->price }}</span>
			        			</div>
		        			</div>
		        			
		        				
		        		</div>
	        		</div>
	        	@empty
	        	@endforelse
	        	</div>


	        	<!-- Order Details -->
	        	<div class="flex flex-col border border-gray-400 rounded my-6">
	        		<div class="flex justify-between items-center mb-4 px-3 pt-3">
	        			<h5 class="text-gray-800 text-md">SubTotal</h5>
	        			<span class="text-gray-800 text-md">Rs {{ $sub }}</span>
	        		</div>
	        		<div class="flex justify-between items-center mb-4 px-3 ">
	        			<h5 class="text-gray-800 text-md">Discount</h5>
	        			<span class="text-gray-800 text-md">Rs 0</span>
	        		</div>
	        		<div class="flex justify-between items-center mb-4 px-3 ">
	        			<h5 class="text-gray-800 text-md">Shipping</h5>
	        			<span class="text-gray-800 text-md">Rs {{ $shipping }}</span>
	        		</div>
	        		<div class="flex justify-between items-center mb-4 border-t border-gray-400 pt-3 px-3">
	        			<h5 class="text-gray-800 text-lg">Grand Total</h5>
	        			<span class="text-gray-800 text-xl font-bold">Rs {{ $total + $shipping }}</span>
	        		</div>
	        	</div>
        	</div>
           
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () { 
    	const paymentInfo        = document.querySelector('.paymentInfo');		
    	let payBtn               = document.getElementById('payBtn');		
		var bodyRect             = document.body.getBoundingClientRect(),
		    paymentInfoBounding  = paymentInfo.getBoundingClientRect(),
		    offset               = paymentInfoBounding.bottom - bodyRect.top;

		alert('Element is ' + offset + ' vertical pixels from <body>');
	});
</script>

@endpush
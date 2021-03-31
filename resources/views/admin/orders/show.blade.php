@extends('layouts.admin')

@section('content')
    <div class="w-full ">

    	<div class="flex flex-col md:flex-row justify-between   mb-6">
       		<div class="flex items-start flex-col w-full mb-2 md:mb-0">
       			<div class="flex items-center mb-2 w-full">
	       			@if($order->customer)
	       				{{-- <a href="{{ route('admin.customer', $order->customer->id) }}"class=" text-blue-500 hover:text-blue-500 w-1/2 md:w-auto">
	       					is a customer.
	       				</a> --}}
	       			@endif
	       		</div>
       			<div class="flex items-center w-full">
       				<label for="" class=" border rounded-l px-4 py-3 w-1/2 md:w-auto">Status</label>
	    			@if($order->is_paid)
		      			<button class="border px-4 py-3 text-white bg-green-600 rounded-r cursor-auto">Completed</button>
		      		@else

			      		<form action="{{ route('admin.orders.update', $order->id) }}" method="POST" accept-charset="utf-8">
			      			
			      			@csrf
			      			@method('PATCH')
		      				<button class="border px-4 py-3 text-white bg-yellow-900 hover:bg-yellow-700 rounded-r">Set as Paid</button>
			      		</form>

		      		@endif
       			</div>
       		</div>

       		<div class="flex items-center">
				<h4 class="border rounded px-4 py-3 font-bold text-lg flex mr-3"><span>Rs</span> {{ $order->grand_total   }}</h4>

				<a  href="{{ route('admin.orders.delete', $order->id) }}" class="
					 px-6 py-2 bg-red-600 hover:opacity-75 text-white rounded" 
				onclick="
					event.preventDefault();
					if(confirm('Are you sure?')){
					 document.getElementById('order-delete-form').submit();
					}
				">
					Drop
				</a>
				<form id="order-delete-form" action="{{ route('admin.orders.delete', $order->id) }}" method="POST" class="hidden">
					@csrf
					@method('DELETE')
				</form>

				
			</div>

			
    	</div>
       	

    	<div class="my-8 flex flex-col md:flex-row">
    		<div class="w-full md:w-1/3">
    			<h5 class="mb-4 text-lg text-gray-800 px-2">General Info</h5>
	    		<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 md:w-1/2">Name</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $order->first_name  . ' ' . $order->last_name }}</h4>
		    	</div>
		    	<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 md:w-1/2">Email</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $order->email }}</h4>
		    	</div>
		    	<div class="flex items-center mb-8">
		    		<label for="" class=" border rounded px-4 py-3 md:w-1/2">Phone Number</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $order->phone_number }}</h4>
		    	</div>
		    	
		    

		    	<h5 class="mb-4 text-lg text-gray-800 px-2">Billing</h5>
		    	<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 md:w-1/2">City</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $order->city }}</h4>
		    	</div>
		    	<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 md:w-1/2">Street Address</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $order->street_address }}</h4>
		    	</div>
		    	<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 md:w-1/2">House Number</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $order->house_number }}</h4>
		    	</div>
		    	<div class="flex items-center mb-8">
		    		<label for="" class=" border rounded px-4 py-3 md:w-1/2">Created</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $order->created_at->diffForHumans() }}</h4>
		    	</div>

		    	
		    </div>

		    <div class="md:ml-4 w-full md:w-2/3">
		    	
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

				<div class="w-full sm:grid md:grid-cols-2 lg:grid-cols-3 sm:gap-4 md:gap-6 ">
			    	@forelse($items as $item)

			    		<div class="w-full sm:w-auto flex flex-col items-start mb-6">
	        				<div 
	        					class="imgBlock relative w-full  cursor-pointer">
	        					<div class="overflow-hidden">
			        				{{-- <a class="" href="{{ route('product', $item->id)}}"> --}}
				        				<img  class="w-full mb-5 rounded hover:opacity-75" src="{{ asset($item->image_url) }}" >
				        			{{-- </a> --}}
				        		</div>
		


			        		</div>
		        			<div class="flex flex-col items-start justify-between w-full">
		        				<h5 class="mb-3 text-lg text-c-dark-gray">{{ $item->name }}</h5>
		        				<div class="flex items-center mb-3 p-3">
		        					<span class="mr-3">
		        						{{ $item->price }} * {{ $item->qty }}
		        					</span>
		        					<span class="font-bold border-1 border-c-light-gray ">
		        						
		        					  Rs {{ $item->price * $item->qty }}
		        					</span>
								</div>
		        			</div>
		        			
		        		</div>

			    	@empty

			    	@endforelse
		    	</div>

		    </div>
    	</div>
      	
    </div>
@endsection
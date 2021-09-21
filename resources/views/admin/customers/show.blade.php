@extends('layouts.admin')

@section('content')
    <div class="md:mr-3">

    	<div class="flex justify-between   mb-6 items-center">
       		
       		<div class="flex items-center">
               <a 
                  href="/admin/dashboard" 
                  class="text-md text-gray-800 hover:opacity-70 border-b border-transparent hover:border-gray-900">Dashboard</a>
               <span class="px-2">/</span>
               <a 
                  href="/admin/customers" 
                  class="text-md text-gray-800 hover:opacity-70 border-b border-transparent hover:border-gray-900">
                	Customers
                </a>
                <span class="px-2">/</span>

               <h1 class="text-md text-gray-800 font-semibold ">{{ $customer->first_name }}</h1>

            </div>
            
       		<div class="flex items-center">
       			<div class="flex items-center mr-3">
		    		<label for="" class=" border rounded px-4 py-2 bg-gray-900 text-white">Total</label>
		    		<h4 class="border rounded px-4 py-2">Rs {{ $total_amount   }}</h4>
		    	</div>
				<a  
						href="{{ route('admin.customers.destroy', $customer->id) }}" 
						class="border rounded" 
						onClick="
							event.preventDefault();
							if(confirm('Are you sure?')){
								document.getElementById('customer-delete-form').submit();
							}
					">
					<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash h-8 w-8 text-red-600 hover:opacity-80 cursor-pointer"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                </a>

                    
                    <!-- Delete Form Hidden-->
                    <form id="customer-delete-form" action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
				
			</div>

			
    	</div>
       	

    	<div class="my-8 flex flex-col md:flex-row">
    		<div class="w-full md:w-1/2">
    			<h5 class="mb-4 text-lg text-gray-800 px-2">General Info</h5>
    			@if($customer->avatar)
    				<img src="{{ asset($customer->avatar) }}" class="mb-4">
    			@endif
	    		<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 md:w-1/3">Name</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $customer->first_name  . ' ' . $customer->last_name }}</h4>
		    	</div>
		    	<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 md:w-1/3">Email</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $customer->email }}</h4>
		    	</div>
		    	<div class="flex items-center mb-8">
		    		<label for="" class=" border rounded px-4 py-3 md:w-1/3">Phone Number</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $customer->phone_number }}</h4>
		    	</div>
		    	
		    
		    	<div class="flex items-center mb-8">
		    		<label for="" class=" border rounded px-4 py-3 md:w-1/3">Created</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $customer->created_at->diffForHumans() }}</h4>
		    	</div>

		    	
		    </div>

		    <div class="md:ml-4 w-full md:w-1/2">
		    	
		    	<div class="flex flex-col border border-gray-400 rounded my-6">
	        		<div class="flex justify-between items-center mb-2 px-3 py-3">
	        			<h5 class="text-gray-800 text-md">Total Orders</h5>
	        			<span class="text-gray-800 text-md">{{ $total_orders }}</span>
	        		</div>
	        		<div class="flex justify-between items-center mb-2 px-3 py-3">
	        			<h5 class="text-gray-800 text-md">Total Quantity</h5>
	        			<span class="text-gray-800 text-md">{{ $items_count }}</span>
	        		</div>
	        		<div class="flex justify-between items-center  border-gray-400 py-3 px-3">
	        			<h5 class="text-gray-800 text-lg">Total Amount</h5>
	        			<span class="text-gray-800 text-xl font-bold">Rs {{ $total_amount }}</span>
	        		</div>
	        	</div>

				
		    </div>
        </div>

        <div class="my-8">
            <div class="mb-3 flex justify-between items-center">
                <h2 class="text-lg">Orders</h2>

                <div class="flex flex-col">
                    {{ $orders->links() }}
                </div>
            </div>
            <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 items-center ">
                @forelse($orders as $order)
                    <div class="w-full md:mr-2 flex flex-col items-start mb-6 p-2 border">
        
                        <a href="{{ route('admin.order', $order->id) }}">
                            <h5 class="mb-3 text-lg font-bold text-blue-600 hover:text-blue-500">Rs {{ $order->grand_total }}</h5>
                        </a>

                        <div class="flex flex-col items-center mb-4">
                            <h4 class="border rounded px-4 py-3 font-bold text-lg flex-1 w-full">{{ $order->city  }}</h4>
                        </div>
                        <div class="flex flex-col items-center mb-4">
                            <label for="" class=" border rounded px-4 py-3 w-full mb-1">Street Address</label>
                            <h4 class="border rounded px-4 py-3 font-bold text-lg flex-1 w-full">{{ $order->street_address  }}</h4>
                        </div>
                        <div class="flex flex-col items-center mb-4">
                            <label for="" class=" border rounded px-4 py-3 w-full mb-1">House Number</label>
                            <h4 class="border rounded px-4 py-3 font-bold text-lg flex-1 w-full">{{ $order->house_number  }}</h4>
                        </div>
                        
                    </div>

                @empty

                @endforelse
            </div>
        </div>

      	
    </div>
@endsection
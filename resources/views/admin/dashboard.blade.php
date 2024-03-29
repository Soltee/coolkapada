@extends('layouts.admin')

@section('content')
    <div class="w-full">
    	<h1 class="text-md text-gray-800 font-semibold mb-4">Dashboard</h1>
       <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
       		<div class="border-t-2 relative border-green-600 p-4 shadow rounded-lg">
       			<h2 class="mb-3">Today Orders</h2>
       			<h3 class="text-lg md:text-3xl font-bold text-gray-800 mb-3">Rs {{ $today_orders_amount }}</h3>
       			<span class="text-lg">{{ $today_orders }} total</span>
       			<span class="absolute top-0 right-0 mt-2 mr-2 ml-3 px-2 py-2 rounded-lg text-blue-600 text-lg font-bold text-white">New</span>
       		</div>
       		<div class="border-t-2 relative border-green-600 p-4 shadow rounded-lg">
       			<h2 class="mb-3">Paid Orders</h2>
       			<h3 class="text-lg md:text-3xl font-bold text-gray-800 mb-3">Rs {{ $paid_orders_amount }}</h3>
       			<span class="text-lg">{{ $paid_orders }} total</span>
       			<span class="absolute top-0 right-0 mt-2 mr-2 ml-3 px-2 py-2 rounded-lg bg-green-400 text-white">Paid</span>
       		</div>
       		<div class="border-t-2 relative border-red-600 p-4 shadow rounded-lg">
       			<h2 class="mb-3">Pending Orders</h2>
       			<h3 class="text-lg md:text-3xl font-bold text-gray-800 mb-3">Rs {{ $pending_orders_amount }}</h3>
       			<span class="text-lg">{{ $pending_orders }} total</span>
       			<span class="absolute top-0 right-0 mt-2 mr-2 ml-3 px-2 py-2 rounded-lg bg-red-400 text-white">Pending</span>
       		</div>
       </div>

   
       <div class="mt-16 mb-6 flex justify-between items-center">
	       	<div class="flex items-center">
		        <h3 class="text-lg text-gray-700 fond-semibold mr-3">Orders</h3>
		        <form action="{{ route('admin.dashboard') }}" method="get" accept-charset="utf-8">
    				@csrf
	    			<div class="flex items-center w-full">

	    				<div class="flex w-full flex-col md:flex-row">
					        <input type="text"  class="focus:outline-none block  w-full bg-white rounded sm:rounded-r-none px-6 py-2 mb-2 sm:mb-0 border" name="search" placeholder="Name" value="{{ request()->search ?? '' }}" >
					        <button type="submit" class="focus:outline-none focus:bg-indigo-light  w-full sm:w-auto bg-gray-700 hover:bg-gray-900 rounded sm:rounded-l-none uppercase text-white font-bold tracking-wide py-2 px-6">Search</button>
					    </div>	
						
	    			</div>
    			</form>

	   		</div>

	       <span class="text-lg text-gray-700 fond-bold">{{ $orders->total() }}</span>
	   </div>
	   <div class="overflow-x-scroll w-full md:overflow-auto md:w-full">
	       <table class="w-full
	       		" >
			  <thead>
			    <tr>
			      <th class="px-4 py-2 text-left text-capitalize text-gray-600">Status</th>
			      <th class="px-4 py-2 text-left text-capitalize text-gray-600">Total</th>
			      <th class="px-4 py-2 text-left text-capitalize text-gray-600">Name</th>
			      <th class="px-4 py-2 text-left text-capitalize text-gray-600">Phone Number</th>
			      <th class="px-4 py-2 text-left text-capitalize text-gray-600">Created At</th>
			      <th class="px-4 py-2 text-left text-capitalize text-gray-600"></th>
			    </tr>
			  </thead>
			  <tbody>
			  	
			  	@forelse($orders as $order)
			    <tr>
			      <td class="border px-4 py-4">
			      		@if($order->is_paid)
			      			<button class="px-2 py-2 text-white bg-green-600 rounded-lg">Paid</button>
			      		@else
			      			<button class="px-2 py-2 text-white bg-red-600 rounded-lg">Pending</button>
			      		@endif
			      </td>
			      <td class="border px-4 py-4">Rs {{$order->grand_total }}</td>
			      <td class="border px-4 py-4">
			      	<a class="hover:text-blue-500" href="{{ route('admin.order', $order->id) }}">
			      		{{$order->first_name . ' ' . $order->last_name}}
			      	</a>
			      </td>
			      <td class="border px-4 py-4">{{$order->phone_number}}</td>
			      <td class="border px-4 py-4">{{$order->created_at->diffForHumans()}}</td>
			      <td class="border px-4 py-4">
					@if(!$order->is_paid)
					
						<form id="order-update-form" action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="">
							@csrf
							@method('PATCH')
							<button 
								type="submit"  
								class="border px-4 py-3 text-white bg-yellow-900 hover:bg-yellow-700 rounded" 
								onClick="
									return confirm('Are you sure?');
							">
								Set as Completed
							</button>
						
						</form>
				
					@endif


			      </td>
			    </tr>
			    @empty
			    	<tr>
				        <td class="border px-4 py-4">No Orders</td>
				    </tr>
			    @endforelse

			  </tbody>
			</table>
		</div>

		<div class="my-6 flex justify-center items-center w-full px-4">
			{{$orders->appends(request()->input())->links()}}
		</div>
    </div>

@endsection
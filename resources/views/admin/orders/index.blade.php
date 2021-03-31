@extends('layouts.admin')

@section('content')
    <div class="w-full md:mr-4">
    	<div class="flex justify-between items-center  mb-6">
    		<form action="{{ route('admin.orders.view') }}" method="get" accept-charset="utf-8">
    			@csrf
    			<div class="flex w-full flex-col md:flex-row">
                    <input type="text"  class="focus:outline-none block  w-full bg-white rounded sm:rounded-r-none px-6 py-2 mb-2 sm:mb-0 border" name="search" placeholder="Name" value="{{ request()->search ?? '' }}" required="">
                    
			        <button type="submit" class="focus:outline-none focus:bg-indigo-light  w-full sm:w-auto bg-gray-900 hover:bg-gray-700 rounded sm:rounded-l-none uppercase text-white font-bold tracking-wide py-2 px-6">Search</button>
			    </div>

    		</form>
    		<span class="ml-6 text-lg font-bold">{{ $total }} Orders</span>

    	
    	</div>

	   	<div class="overflow-x-scroll w-full md:overflow-auto md:w-full">
	      	<table class="  w-full mb-8" >
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
			      			<button class="px-2 py-2 text-white bg-green-600 rounded-lg">Completed</button>
			      		@else
			      			<button class="px-2 py-2 text-white bg-red-600 rounded-lg">Pending</button>
			      		@endif
			      </td>
			      <td class="border px-4 py-4">Rs {{$order->grand_total }}</td>
			      <td class="border px-4 py-4">		      	
			      		<a class="text-blue-600 hover:text-blue-500" href="{{ route('admin.order', $order->id) }}">
							{{$order->first_name . ' ' . $order->last_name}}
						</a>
					</td>
			      <td class="border px-4 py-4">{{$order->phone_number}}</td>
			      <td class="border px-4 py-4">{{$order->created_at->diffForHumans()}}</td>
			      <td class="border px-4 py-4">
					@if(!$order->is_paid)
						<a  
							href="{{ route('admin.orders.update', $order->id) }}" 
							class="border px-4 py-3 text-white bg-yellow-900 hover:bg-yellow-700 rounded" 
							onClick="
								event.preventDefault();
								if(confirm('Are you sure?')){
									document.getElementById('order-update-form').submit();
								}
						">
							Set as Completed
						</a>
						<form id="order-update-form" action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="hidden">
							@csrf
							@method('PATCH')
						</form>
				
			      	@endif

			      </td>
			    </tr>
			    @empty
			    @endforelse

			  </tbody>
			</table>
		</div>

		<div class="my-6 flex justify-between items-center w-full px-4">
			@if($previous)
			<a  class="px-4 py-3 rounded-lg text-indigo-500 text-lg" href="{{ $previous }}">
				Prev
			</a>
			@else
			<span  class="px-4 py-3 rounded-lg  text-white text-lg">
				
			</span>
			@endif

			@if($next)
			<a  class="px-4 py-3 rounded-lg text-indigo-500 text-lg" href="{{ $next }}">
				Next
			</a>
			@else
			<span  class="px-4 py-3 rounded-lg   text-white text-lg">
				
			</span>
			@endif
		</div>
    </div>
@endsection
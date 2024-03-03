@extends('layouts.admin')

@section('content')
    <div class="w-full md:mr-4">
    	<div class="flex items-center mb-2">
           <a 
              href="/admin/dashboard" 
              class="text-md text-gray-800 hover:opacity-70 border-b border-transparent hover:border-gray-900">Dashboard</a>
           <span class="px-2">/</span>
           
           <h1 class="text-md text-gray-800 font-semibold ">Orders</h1>

        </div>
    	<div class="flex justify-between items-center  mb-6">
    		<form action="{{ route('admin.orders.view') }}" method="get" accept-charset="utf-8">
    			@csrf
    			<div class="flex w-full flex-col md:flex-row">
                    <input type="text"  class="focus:outline-none block  w-full bg-white rounded sm:rounded-r-none px-6 py-2 mb-2 sm:mb-0 border" name="keyword" placeholder="Name" value="{{ request()->search ?? '' }}">
                    <select name="paidOrNot">
                    	<option value="unpaid">Not Paid</option>
                    	<option value="1">Paid/Completed</option>
                    </select>
			        <button type="submit" class="focus:outline-none focus:bg-indigo-light  w-full sm:w-auto bg-gray-900 hover:bg-gray-700 rounded sm:rounded-l-none uppercase text-white font-bold tracking-wide py-2 px-6">Search</button>
			    </div>

    		</form>
    	
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
			      <th class="px-4 py-2 text-left text-capitalize text-gray-600">
			      	
			      </th>
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
					        <td class="border px-4 py-4 text-center" colspan="5">No order available.</td>
					    </tr>
			    @endforelse

			  </tbody>
			</table>
		</div>

		<div class="my-6 flex justify-center items-center w-full px-4">
			{{  $orders->links() }}
		</div>
	</div>
@endsection
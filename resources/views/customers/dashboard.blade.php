@extends('layouts.app')

@section('content')
    <div
        class="px-6 flex flex-col my-6">

        <div class="flex items-center my-4">
            <button 
                class="pb-3 mr-4 font-medium text-md border-b-2 border-c-light-blue font-bold"
                >
                    Orders
            </button>
            <a href="{{ route('profile') }}"
                class="pb-3 mr-4 font-medium text-md border-b-2 hover:border-c-light-blue hover:font-bold">
                    Profile
            </a>
        </div>

        
    	<div 
            class="w-full mt-3 overflow-x-scroll w-full md:overflow-auto md:w-full">
	        <table class="table-auto  w-full mb-8" >
                <thead>
                    <tr>
                      <th class="px-4 py-2 text-left text-capitalize text-gray-600">Status</th>
                      <th class="px-4 py-2 text-left text-capitalize text-gray-600">Total</th>
                      <th class="px-4 py-2 text-left text-capitalize text-gray-600">Items</th>
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
			      			<button class="px-2 py-2 text-white bg-red-600 rounded-lg">On your Way</button>
			      		@endif
			      </td>
			      <td class="border px-4 py-4">
                        <a class="text-blue-500" href="{{ route('customer.order', $order->id) }}">
                            Rs {{$order->grand_total }}
                        </a>
                  </td>
			      <td class="border px-4 py-4">{{$order->items_count }}</td>
			      <td class="border px-4 py-4">{{$order->phone_number}}</td>
			      <td class="border px-4 py-4">{{$order->created_at->diffForHumans()}}</td>
			      
			    </tr>
			    @empty
		    		<tr  class="">
		    			<td class="border px-4 py-4">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 md:w-16 text-c-red mb-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 6H4.34a6 6 0 0 1 11.32 0z"/></svg>
                                <p class="text-c-red text-xl py-3 text-left">No orders yet.</p>
                                <a href="/shop" class="mt-3 w-full md:w-40 md:ml-2  px-3 py-3 rounded text-center text-white bg-c-black">
                                    Browse our store.
                                </a>
                            </div>
                        </td>
		    		</tr>
			    @endforelse

			  </tbody>
            </table>
            

            <div class="mt-5 flex justify-center items-center">

                {{ $orders->links() }}

            </div>
		</div>

      

		
            
    </div>
@endsection
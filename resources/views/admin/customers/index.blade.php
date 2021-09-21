@extends('layouts.admin')

@section('content')
    <div class="w-full">
    	<div class="flex flex-col md:flex-row justify-between md:items-center  mb-6">
    		<div class="flex items-center">
               <a 
                  href="/admin/dashboard" 
                  class="text-md text-gray-800 hover:opacity-70 border-b border-transparent hover:border-gray-900">Dashboard</a>
               <span class="px-2">/</span>
               <h1 class="text-md text-gray-800 font-semibold ">Customers</h1>

            </div>
            
            <div class="mt-2 md:mt-0">
	    		<form action="{{ route('admin.customers.view') }}" method="get" accept-charset="utf-8">
	    			@csrf
	    			<div class="flex w-full flex-col md:flex-row">
				        <input type="text"  class="focus:outline-none block  w-full bg-white rounded-t md:rounded-l md:rounded-t-none sm:rounded-r-none px-6 py-2 mb-2 sm:mb-0 border" name="search" placeholder="Name" value="{{ request()->search ?? '' }}" >
				        <button type="submit" class="focus:outline-none focus:bg-indigo-light  w-full sm:w-auto bg-gray-900 hover:bg-gray-700 rounded sm:rounded-l-none uppercase text-white font-semibold tracking-wide py-2 px-6">Search</button>
				    </div>

	    		</form>
	    	</div>
    			
    	
    	</div>
    	
	   	<div class="overflow-x-scroll w-full md:overflow-auto md:w-full">

	      	<table class="table-auto  w-full mb-8" >
			  <thead>
			    <tr>
			      <th class="px-4 py-2 text-left text-capitalize text-gray-600">Avatar</th>
			      <th class="px-4 py-2 text-left text-capitalize text-gray-600">Name</th>
			      <th class="px-4 py-2 text-left text-capitalize text-gray-600">Email</th>
			      <th class="px-4 py-2 text-left text-capitalize text-gray-600">Created At</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@forelse($customers as $customer)
			    <tr>
			      
			      <td class="border px-4 py-4"> 
			      	@if($customer->avatar)
			      		<img class="w-12 h-12 object-cover object-center" src="{{ asset('/'. $customer->avatar )}}" alt=""> 
			      	@else
			      		<svg class="w-12 h-12 object-cover object-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
			      	@endif
			      </td>
			        <td class="border px-4 py-4">
			      	    <a class="hover:text-blue-500" href="{{ route('admin.customer', $customer->id) }}">
							{{$customer->first_name . ' ' . $customer->last_name}}
						</a>
					</td>
			      <td class="border px-4 py-4">
			      	<a class="hover:text-blue-500" href="{{ route('admin.customer', $customer->id) }}">

			      			{{$customer->email}}
			      	</a>
			      </td>
			      <td class="border px-4 py-4">{{$customer->created_at->diffForHumans()}}</td>
			    </tr>
			    @empty
			    @endforelse

			  </tbody>
			</table>
		
		</div>

		<div class="my-6 flex justify-center items-center w-full px-4">
			{{  $customers->links() }}
		</div>

    </div>
@endsection
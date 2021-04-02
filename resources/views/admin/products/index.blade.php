@extends('layouts.admin')

@section('content')
    <div class="md:mr-3 w-full">
    	<div class="flex flex-col w-full md:flex-row justify-between mb-6">
    		<form action="{{ route('admin.products.view') }}" method="get" accept-charset="utf-8">
    			@csrf
    			<div class="flex items-center w-full">

    				<div class="flex w-full flex-col md:flex-row">
				        <input type="text"  class="focus:outline-none block  w-full bg-white rounded sm:rounded-r-none px-6 py-2 mb-2 sm:mb-0 border" name="search" placeholder="Name" value="{{ request()->search ?? '' }}" >
				        <button type="submit" class="focus:outline-none focus:bg-indigo-light  w-full sm:w-auto bg-gray-700 hover:bg-gray-900 rounded sm:rounded-l-none uppercase text-white font-bold tracking-wide py-2 px-6">Search</button>
				    </div>


    				
					
    			</div>
    		</form>

    		<span class="mr-3 text-lg font-bold">{{ $total }}</span>

            <a class="fixed bottom-0 right-0 mr-10 mb-24 z-30 hover:bg-gray-700 px-4 py-4  rounded-full bg-gray-900 text-white font-bold  " href="{{ route('admin.products.create') }}">
    			+ New
    		</a>
    	</div>

	   	<div class="overflow-x-scroll w-full md:overflow-auto md:w-full">

	      	<table class=" w-full" >
			  <thead>
			    <tr>
			      <th class="px-2 py-2 text-left text-capitalize text-gray-600">Image</th>
			      <th class="px-2 py-2 text-left text-capitalize text-gray-600">Name</th>
			      <th class="px-2 py-2 text-left text-capitalize text-gray-600"></th>
			    </tr>
			  </thead>
			  <tbody>
			  	@forelse($products as $product)
			    <tr>
			      <td class="border px-2 py-4">
			      	<a href="{{ route('admin.product', $product->id) }}">
				      	<img class="w-16 h-16  rounded-lg object-cover" src="{{ asset( $product->image_url) }}">
				    </a>
			      </td>
			        <td class="border px-2 py-4">
				      	<a class="text-blue-500 hover:text-blue-600" href="{{ route('admin.product', $product->id) }}">
				      		{{$product->name}}
				      	</a>
			        </td>
			      
			      <td class="border px-2 py-4">
			      	<div class="flex flex-col">
				      	<a href="{{ route('admin.products.edit', $product->id) }}" class="px-2 py-3  text-center rounded-lg text-white bg-yellow-600 mb-3">Edit</a>
				    </div>
			      </td>
			    </tr>
			    @empty
			    @endforelse

			  </tbody>
			</table>

		</div>

        <div class="my-6">
            {{ $products->links() }}
        </div>
		{{-- <div class="my-6 flex justify-between items-center w-full px-2">
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
		</div> --}}
    </div>
@endsection
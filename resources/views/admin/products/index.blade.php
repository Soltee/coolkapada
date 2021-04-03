@extends('layouts.admin')

@section('head')
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.css">
	<script src="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.min.js"></script>
@endsection
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

			<a 
				class="bg-gray-900 hover:bg-gray-700 px-2 py-2  rounded cursor-pointer bg-gray-900 text-white font-bold  " 
				href="/admin/products/create">

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
			      <th class="px-2 py-2 text-left text-capitalize text-gray-600"></th>
			    </tr>
			  </thead>
			  <tbody>
			  	@forelse($products as $product)
			    <tr>
			      <td class="border px-2 py-4">
			      	<a href="{{ route('admin.product', $product->id) }}">
				      	<img class="w-16 h-16  rounded-lg object-cover" src="{{ asset( $product->media->image_url) }}">
				    </a>
			      </td>
			        <td class="border px-2 py-4">
				      	<a class="text-blue-500 hover:text-blue-600" href="{{ route('admin.product', $product->id) }}">
				      		{{$product->name}}
				      	</a>
			        </td>
			      
			      <td class="border px-2 py-4">
			      	<div class="flex flex-col">
				      	<a href="{{ route('admin.products.edit', $product->id) }}" class="px-2 py-3 w-32 text-center rounded-lg text-white bg-yellow-600 mb-3">Edit</a>
				    </div>
				  </td>
				  	<td class="border px-2 py-4">
					<div class="flex flex-col">
						<form id="product-delete-form" action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="">
							@csrf
							@method('DELETE')
							<button type="submit">
								<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash h-8 w-8 text-red-600 hover:opacity-80 cursor-pointer"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
							</button>

						</form>
		
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
	</div>
@endsection
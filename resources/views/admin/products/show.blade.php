@extends('layouts.admin')

@section('content')
    <div class="w-full">

    	<div class="flex justify-between   mb-6">
       		
	       	<h3 class="text-gray-900 text-lg">{{ $product->name }}</h3>

       		<div class="flex items-center">
				<a href="/admins/products/{{ $product->id }}/edit" class="mr-4 text-md font-semibold">
					<svg 
						xmlns="http://www.w3.org/2000/svg" 
						viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" 
						class="h-8 w-8 cursor-pointer text-yellow-600"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
				</a>
				<form method="POST" action="{{ route('admin.products.destroy', $product->id) }}">
					@csrf
					@method('DELETE')
                    <button 
                        type="submit" 
                        onClick="return confirm('Are you sure?');"
                        class="px-6 py-3 hover:opacity-75 text-white rounded">
                        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash h-8 w-8 text-red-600 hover:opacity-80 cursor-pointer"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                    </button>
				</form>
			</div>

			
    	</div>
       	

    	<div class="my-4 flex flex-col md:flex-row">
    		<div class="w-full md:w-1/2">
    			<h5 class="mb-4 text-lg text-gray-800 px-2">General Info</h5>

	    		<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 md:w-1/3">Name</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $product->name  }}</h4>
		    	</div>
		    	<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 md:w-1/3">Price</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">
						RS {{ $product->min }} @if($product->max) - {{ $product->max }} @endif NP 
					</h4>
		    	</div>
		    	<div class="flex items-centerd mb-8">
		    		<label for="" class=" border rounded px-4 py-3 md:w-1/3">Quantity</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">
						{{ $quantity }}
					</h4>
		    	</div>

		    	<div class="w-full  my-6 flex">
		    		<label for="" class=" border rounded px-4 py-3 md:w-1/3">Color</label>
					<div class="flex flex-row items-center">
						@forelse($images as $c)

							<label  class="custom_radio relative flex flex-col">
								
								<span  class="radio_btn mr-2 px-5 py-5 rounded-lg  border-2 border-white text-gray-900 cursor-pointer hover:border-gray-400" style="background-color: {{ $c->color }}"
								>
									
								</span>
								
							</label>
							
						@empty

						@endforelse
					</div>							
				</div>
				
				<div class="flex items-centerd mb-8">
					<label for="" class=" border rounded px-4 py-3 md:w-1/3">Quantity</label>
					<div class="flex items-center">
						@forelse($sizes as $size)
							<div class="px-3 py-2 border border-gray-300 rounded-lg mr-2">
							<span class="h-8 w-8 ">
								{{$size}}
							</span>
							</div>
						@empty
						@endforelse
					</div>
		    	
		    	</div>

			 
		    	<div class="flex items-center mb-8">
		    		<label for="" class=" border rounded px-4 py-3 md:w-1/3">Created</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $product->created_at->diffForHumans() }}</h4>
		    	</div>
                <div class="flex items-center mb-8">
		    		<label for="" class=" border rounded px-4 py-3 md:w-1/3">Updated</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $product->updated_at->diffForHumans() }}</h4>
		    	</div>

		    	
		    </div>

		    <div class="md:ml-4 w-full md:w-1/2">
		    	
		    	<div class="w-full flex flex-wrap">
			    	@forelse($images as $image)

			    		<div class="w-full w-32 h-32 mr-3 flex flex-col items-start mb-6">
							<img  
								style="border-color: {{ $image->color}}"
								class="w-full h-full object-contain mb-5 rounded-lg border-2" src="{{ asset($image->media->image_url) }}" >
		        		</div>

			    	@empty

			    	@endforelse
		    	</div>
		    </div>
    	</div>
      	
    </div>
@endsection
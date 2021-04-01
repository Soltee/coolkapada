@extends('layouts.admin')

@section('content')
    <div class="w-full">

    	<div class="flex justify-between   mb-6">
       		
	       	<h3 class="text-gray-900 text-lg">{{ $product->name }}</h3>

       		<div class="flex items-center">

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
       	

    	<div class="my-8 flex flex-col md:flex-row">
    		<div class="w-full md:w-1/2">
    			<h5 class="mb-4 text-lg text-gray-800 px-2">General Info</h5>

	    		<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 md:w-1/3">Name</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $product->name  }}</h4>
		    	</div>
		    	<div class="flex items-center mb-6">
		    		<label for="" class=" border rounded px-4 py-3 md:w-1/3">Price</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">Rs {{ $product->price }}</h4>
		    	</div>
		    	<div class="flex items-center mb-8">
		    		<label for="" class=" border rounded px-4 py-3 md:w-1/3">Quantity</label>
		    		<h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $product->qty }}</h4>
		    	</div>

		    	<div class="w-full  my-6 flex flex-col px-4">
					<h4 class="mb-2">Color</h4>
					<div class="flex flex-row items-center">
						@forelse(explode(',', $product->colors) as $c)

							<label  class="custom_radio relative flex flex-col">
								
								<span  class="radio_btn mr-2 px-5 py-5 rounded-lg  border-2 border-white text-gray-900 cursor-pointer hover:border-gray-400" style="background-color: {{ $c }}"
								>
									
								</span>
								
							</label>
							
						@empty

						@endforelse
					</div>							
				</div>
			 
				<div class="w-full  my-6 flex flex-col px-4">
					<h4 class="mb-2">Size</h4>
					<div class="flex flex-row items-center">
						@forelse(explode(', ', $product->sizes) as $s)

							<label  class="custom_radio2 relative flex flex-col">
								
								<span  class="radio_btn2 mr-2 px-3 py-3 rounded-lg  border-2 border-white text-gray-900 cursor-pointer hover:border-gray-400"
								>
									{{ $s }}
								</span>
								
							</label>
							
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
		    	
		    	<div class="w-full sm:grid md:grid-cols-1 lg:grid-cols-2 sm:gap-4 md:gap-6 ">
			    	@forelse($images as $image)

			    		<div class="w-full sm:w-auto flex flex-col items-start mb-6">
				        	<img  class="w-full mb-5 rounded " src="{{ asset($image->image_url) }}" >
		        		</div>

			    	@empty

			    	@endforelse
		    	</div>
		    </div>
    	</div>
      	
    </div>
@endsection
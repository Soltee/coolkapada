@extends('layouts.admin')

@section('head')
	{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/nano.min.css"/> <!-- 'nano' theme --> --}}
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.css">
  	<script src="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.min.js"></script>
@endsection

@section('content')
    <div class="">
    	<div class=" mb-6">
     		<h4 class="text-md mb-6 text-gray-700">New Product</h4>
   			<form action="{{ route('admin.products.store') }}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
    			@csrf

    			<div class="flex justify-between flex-col md:flex-row">
	    			<div class="flex flex-col pr-2 w-2/3">
	    				<div class="flex flex-wrap mb-6">
	                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Product name') }}
	                        </label>

	                        <input id="name" type="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror " name="name" value="{{ old('name') }}"  autofocus placeholder="">

	                        @error('name')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>
	                    <div class="flex justify-between flex-wrap mb-6">
		                    <div class="flex flex-wrap">
		                        <label for="prev_price" class="block text-gray-700 text-sm font-bold mb-2">
		                            {{ __('Previous price') }}
		                        </label>

		                        <input id="prev_price" type="prev_price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('prev_price') border-red-500 @enderror " name="prev_price" value="{{ old('prev_price') }}"  autofocus placeholder="">

		                        @error('prev_price')
		                            <p class="text-red-500 text-xs italic mt-4">
		                                {{ $message }}
		                            </p>
		                        @enderror
		                    </div>
		                    <div class="flex flex-wrap">
		                        <label for="price" class="block text-gray-700 text-sm font-bold mb-2">
		                            {{ __('Price') }}
		                        </label>

		                        <input id="price" type="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('price') border-red-500 @enderror " name="price" value="{{ old('price') }}"  autofocus placeholder="">

		                        @error('price')
		                            <p class="text-red-500 text-xs italic mt-4">
		                                {{ $message }}
		                            </p>
		                        @enderror
		                    </div>
	                    </div>

	                    <div class="flex flex-wrap mb-6">
	                        <label for="qty" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Quantity') }}
	                        </label>

	                        <input id="qty" type="qty" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('qty') border-red-500 @enderror " name="qty" value="{{ old('qty') }}"  autofocus placeholder="">

	                        @error('qty')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>

	                    <div class="flex flex-wrap mb-6">
	                        <label for="sizes" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Sizes') }}
	                        </label>

	                        <div class="inline-block relative w-full">
							  <select name="sizes" class="block appearance-none w-full bg-white border-r-lg border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
							    <option value="XS">Extra Small</option>
							    <option value="S">Small</option>
							    <option value="M">Medium</option>
							    <option value="L">Large</option>
							    <option value="XL">Extra Large</option>
							    <option value="XS, S">Extra Small, Small</option>
							    <option value="XS, S, M">Extra Small, Small, Medium</option>
							    <option value="XS, S, M, L">Extra Small, Small, Medium, Large</option>
							    <option value="S, M, L">Small, Medium, Large</option>
							    <option value="XS, S, M, L, XL">Extra Small, Small, Medium, Large, Extra Large</option>
							  </select>
							  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
							    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
							  </div>
							</div>
	                        @error('sizes')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>
	                    <div class="flex flex-wrap mb-6">
	                        <label for="colors" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Colors') }}
	                        </label>
	                        <span class="color-picker "></span>
	                        <input id="colors" type="text" class="colorsP shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('colors') border-red-500 @enderror " name="colors" value="{{ old('colors') }}"  autofocus placeholder="">
	                        @error('colors')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>
	                    
	                    <div class="flex flex-col flex-wrap mb-6">
	                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Description') }}
	                        </label>
	                        <input id="description" value="{{ old('description') }}" type="hidden" name="description">
  							<trix-editor input="description"></trix-editor>
	                       

	                        @error('description')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>

	                     

						
	    			</div>
	    			<div class="flex flex-col pl-2 w-1/3">
	    			
	                    <div class="flex flex-wrap mb-6">
	                        <label for="files" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Product Images') }}
	                        </label>

	                        <input id="files" type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('files') border-red-500 @enderror " name="files[]" value="{{ old('files') }}"  autofocus placeholder="" multiple>

	                        @error('files')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>
	                    <div id="imagesProduct" class="grid grid-cols-2 gap-2 h-40 overflow-y-scroll mb-6">
	                    	
	                    </div>
	                    
	                    <div class="flex flex-wrap mb-6">
	                        
	                    	<label for="category" class="block text-gray-700 text-sm font-bold mb-2">
	                            {{ __('Category') }}
	                        </label>
	                        <div class="inline-block relative w-full">
							  <select name="category" class="block appearance-none w-full bg-white border-r-lg border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
							  	@forelse($categories as $category)
							    	<option value="{{ $category->id }}">{{ $category->name }}</option>
							    @empty
							    @endforelse
							  </select>
							  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
							    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
							  </div>
							</div>

	                        @error('category')
	                            <p class="text-red-500 text-xs italic mt-4">
	                                {{ $message }}
	                            </p>
	                        @enderror
	                    </div>

	                   	<button type="submit" class="px-3 py-3 bg-gray-900 hover:bg-gray-700 text-white  rounded-lg">Upload</button>


	    			</div>
	    		</div>
    		</form>

    	</div>
    	
    </div>
@endsection

@push('scripts')
	<script>
    		
		let readImages = document.getElementById('imagesProduct');

		document.getElementById('files').addEventListener('change', (e) => {
			if (e.target.files) {

            	for( var i = 0; i < e.target.files.length; i++ ){
		            var reader = new FileReader();
		            
		            reader.onload = function (e) {
		            	var img = document.createElement("img");
						img.src = e.target.result;
		            	readImages.appendChild(img);
		                // $('#blah').attr('src', e.target.result);
		            }
		            console.log(e.target.files[i]);
		            reader.readAsDataURL(e.target.files[i]);
		        }
	        }
		});

	</script>

@endpush
@extends('layouts.admin')

@section('head')
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.css">
	<script src="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.min.js"></script>
    <style>
        .custom_radio input:checked + .radio_btn{border: 3px solid green;}
	</style>
@endsection

@section('content')
    <div class="">
		<div class="">

			<form 
				method="POST" 
				action="{{ route('admin.products.update', $product->id) }}" 
				enctype="multipart/form-data">
				@csrf
				@method('PATCH')
		
				<div class="flex justify-between items-center">
					<div class="flex items-center">
	                    <a href="/admin/products/{{$product->id}}" class="text-xs font-thin hover:text-gray-900 mr-2 hover:font-bold  border-b border-transparent hover:border-black">
	                        {{$product->name}}
	                    </a>
	                    /
	                    <h3 class="ml-2 text-sm font-thin">Image </h3>
	                </div>
                
                    <button type="submit" class="px-3 py-3 bg-gray-900 hover:bg-gray-700 text-white  rounded-lg">Edit</button>

                </div>

				<div class="mt-6">
		
					
					<div class="mb-3 w-full">
						<x-label for="name" :value="__('Name')" />
		
						<input id="name" class="block border border-gray-300 py-2 px-3 rounded mt-1 w-full" type="text" name="name" value="{{ old('name') ?? $product->name }}"  />
					</div>
					<div class="mb-3 w-full">
						<x-label for="category" :value="__('Category')" />
						<div class="inline-block relative w-full">
							<select name="category" class="block appearance-none w-full bg-white border-r-lg border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
								@forelse($categories as $category)
									<option 
										value="{{ $category->id }}"
										{{ ($product->category->id === $category->id) ? 'selected' : '' }}

										>
											{{ $category->name }}
									</option>
								@empty
								@endforelse
							</select>
							<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
								<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
							</div>
							</div>
		
							
					</div>
					<div class="mb-3 w-full">
						<x-label for="description" value="Description" />
		
						<input id="description" class="bg-white hidden w-full" type="text" name="description" 
						value="{{ old('description') ?? $product->description }}"  />
						<trix-editor input="description"></trix-editor>
		
					</div>

					<!-- Cover Image -->
					<div class="flex  mb-6">
                        <div class="flex flex-wrap w-full">
                            <label for="files" class="block text-gray-700 text-sm font-bold mb-2">
                                {{ __('Cover') }} ( Optional )
                            </label>

                            <input id="cover" type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('cover') border-red-500 @enderror " name="cover" value="{{ old('cover') }}"  autofocus placeholder="">

                            @error('cover')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>
                    <div id="coverImage" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 overflow-y-scroll mb-6">
				      	<img class="w-16 h-16  rounded-lg object-cover" src="{{ asset( $product->media->image_url) }}">
                    </div>
                    
		
					
				</div>
			</form>
					
		</div>    	
    </div>
@endsection

@push('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function(){
            let allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

            let readImages = document.getElementById('coverImage');
            document.getElementById('cover').addEventListener('change', (e) => {
                if (e.target.files[0]) {
                    readImages.innerHTML = '';

                    for( var i = 0; i < e.target.files.length; i++ ){
                        const fsize = e.target.files[0].size;
                        const file = Math.round((fsize / 1024));
                        if (file >= 2048) {
                            swal('File size too big. Please select less than 2mb.');
                            return;
                        } 

                        const t = e.target.files[0].type.split('/').pop().toLowerCase();
                        if (t != "jpeg" && t != "jpg" && t != "png") {
                            swal('Only jpeg, jpg and png file.');
                            return;
                        } 

                        var reader = new FileReader();
                        
                        reader.onload = function (e) {
                            var img = document.createElement("img");
                            img.class ="h-64";
                            img.src = e.target.result;
                            readImages.appendChild(img);
                        }
                        reader.readAsDataURL(e.target.files[0]);

                    }
                
                }
            });

        });
    </script>

@endpush


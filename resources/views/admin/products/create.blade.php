@extends('layouts.admin')

@section('head')
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.css">
	<script src="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/tiny-slider.css">
    <style>
        .custom_radio input:checked + .radio_btn{border: 3px solid green;}
        
	</style>
@endsection

@section('content')
    <div class="">
    	<div class="">

			<form method="POST" action="/admin/products">
				@csrf
		
				<div class="flex justify-between items-center">
					<h4 class="text-md mb-3 text-gray-700">New Product</h4>
					<button type="submit" class="px-3 py-3 bg-gray-900 hover:bg-gray-700 text-white  rounded-lg mb-12">Upload</button>
		
				</div>
				
				<div class="">
		
					<!-- Email Address -->
					<div class="mb-3 w-full">
						<x-label for="name" :value="__('Name')" />
		
						<input id="name" class="block border border-gray-300 py-2 px-3 rounded mt-1 w-full" type="text" name="name" value="{{ old('name') }}"  />
					</div>
					<div class="mb-3 w-full">
						<x-label for="category" :value="__('Category')" />
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
		
							
					</div>
					<div class="mb-3 w-full">
						<x-label for="description" value="Description" />
		
						<input id="description" class="bg-white hidden w-full" type="text" name="description" 
						value="{{ old('description') }}"  />
						<trix-editor input="description"></trix-editor>
		
					</div>

					<!-- Email Address -->
					<div class="mb-3 w-full">
						<x-label for="media" :value="__('Cover')" />
						
						<livewire:admin.helpers.media />

					</div>
		
					
				</div>
			</form>
					
    	</div>
    	
    </div>
@endsection
{{-- 
@push('scripts')

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function(){

            document.getElementById('media').addEventListener('change', (e) => {
                if (e.target.files[0]) {
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
                }
            });

        });
	</script>

@endpush --}}
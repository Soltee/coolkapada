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

			<form method="POST" action="/admin/products">
				@csrf
		
				<div class="flex justify-between items-center">
					<div class="flex items-center">
						{{-- <a href="/admin/products/{{$product->id}}" class="text-md font-thin hover:text-gray-900 mr-3 hover:font-bold border-b hover:border-blue-500">
                        	{{$product->name}}
                    	</a>
 --}}
                    	<h4 class="text-md bg-gray-700 text-white mr-3 border rounded-lg px-2 py-1">1. Product</h4>
                    	<h4 class="text-md text-gray-700 mr-3">2. Image</h4>

					</div>
					<button type="submit" class="px-3 py-2 bg-gray-900 text-sm hover:bg-gray-700 text-white  rounded-lg ">Upload New Product</button>
		
				</div>
				
				<div class="mt-6">
		
					
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

					<!-- Cover Image -->
					<div class="mb-3 w-full">
						
						<livewire:admin.helpers.media from="products"/>

					</div>
		
					
				</div>
			</form>
					
		</div>    	
    </div>
@endsection

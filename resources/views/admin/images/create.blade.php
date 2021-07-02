@extends('layouts.admin')

@section('head')
	<style>
        .custom_radio input:checked + .radio_btn{border: 3px solid green;}
	</style>
@endsection

@section('content')
    <div class="w-full">
			
        {{-- <livewire:admin.product-image.create key="{{ now() }}" :product="$product" /> --}}

        <form method="POST" action="{{ route('product.image.store') }}">
            @csrf

            <div class="flex justify-between items-center mb-10">
                <div class="flex items-center">
                    <a href="/admin/products/{{$product->id}}" class="text-xs font-thin hover:text-gray-900 mr-2 hover:font-bold">
                        {{$product->name}}
                    </a>
                    /
                    <h3 class="ml-2 text-sm font-thin">Image </h3>
                </div>
                <button type="submit" class=" px-3 py-2 w-40 text-center text-gray-900 hover:bg-gray-900 hover:text-white cursor-pointer rounded-lg border border-gray-300" >
                    Upload
                </button>
            </div>

                <div class="flex flex-col">

                    <input type="hidden" name="_product" value="{{ $product->id }}">
                    <div class="mb-5 w-full">
                        <x-label for="color" :value="__('Color')" />

                        <input id="color" class="block border border-gray-300 py-2 px-3 rounded mt-1 w-full" type="text" name="color" value="{{ old('color') }}"  />
                        @error('color')
                            <p class="text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5 w-full">
                        @error('media')
                            <p class="text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    
                        <livewire:admin.helpers.media  from="productImage"/>
                    </div>

                    
                
                </div>
        </form>

   			    	
    </div>
@endsection

@extends('layouts.admin')

@section('head')
	<style>
        .custom_radio input:checked + .radio_btn{border: 3px solid green;}
	</style>
@endsection

@section('content')
    <div class="w-full">
			
        {{-- <livewire:admin.product-image.create key="{{ now() }}" :product="$product" /> --}}

        <form method="POST" action="{{ route('product.image.store') }}" enctype="multipart/form-data">
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

                    {{-- <div class="mb-5 w-full">
                        @error('media')
                            <p class="text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    
                        <livewire:admin.helpers.media  from="productImage"/>
                    </div>
 --}}
                    <div class="flex  mb-6">
                        <div class="flex flex-wrap w-full">
                            <label for="files" class="block text-gray-700 text-sm font-bold mb-2">
                                {{ __('Media') }}
                            </label>

                            <input id="media" type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('media') border-red-500 @enderror " name="media" value="{{ old('media') }}"  autofocus placeholder="">

                            @error('media')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>
                    <div id="imagesProduct" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 overflow-y-scroll mb-6">
                        
                    </div>
                    
                
                </div>
        </form>

   			    	
    </div>
@endsection

@push('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function(){
            let allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

            let readImages = document.getElementById('imagesProduct');
            document.getElementById('media').addEventListener('change', (e) => {
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

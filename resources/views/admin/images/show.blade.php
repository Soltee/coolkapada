@extends('layouts.admin')

@section('head')
	<style>
        .custom_radio input:checked + .radio_btn{border: 3px solid green;}
	</style>
@endsection

@section('content')
    <div class="w-full">
        <div class="mb-5">
		    <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a 
                      href="/admin/products" 
                      class="text-md text-gray-800 hover:opacity-70 border-b border-transparent hover:border-gray-900">Products</a>
                   <span class="px-2">/</span>
               
                    <a href="/admin/products/{{$product->id}}" class="text-md font-thin hover:text-gray-900 mr-3 hover:font-bold border-b hover:border-blue-500">
                        {{ \Str::limit($product->name, 6) }}
                    </a>
                    
                </div>

                <div class="flex items-center">
                    <!-- Image Color Edit -->
                    {{-- <div 
                        x-data="{ editImage : false }"
                        class="">
                        
                        <button 
                            x-on:click="editImage = !editImage"
                            type="submit" class=" px-3 py-2 text-center text-gray-900 hover:bg-gray-900 hover:text-white cursor-pointer rounded-lg border border-gray-300" >
                            Edit
                        </button> 

                        <div 
                            x-show.transition.50ms="editImage"
                            class="absolute inset-0 bg-gray-300 flex justify-center items-center">
                            <form method="POST" 
                                action="{{ route('product.image.update', $productImage->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="flex flex-col shadow-2xl">
                                    <input type="hidden" name="_product" value="{{ $product->id }}">
                                    <div class="flex justify-between items-center mb-5">
                                        <div class="flex items-center">
                                            <p 
                                                x-on:click="editImage = false"
                                                class="text-gray-700 font-thin text-sm cursor-pointer"> Close </p>
                                        </div>
                                        <button type="submit" class=" px-3 py-2 text-center text-gray-900 hover:bg-gray-900 hover:text-white cursor-pointer rounded-lg border border-gray-600" >
                                            Edit
                                        </button>

                                    </div>
                                    <div class="w-full">
                                        <x-label for="color" :value="__('Color')" />
                
                                        <input id="color" class="block border border-gray-300 py-2 px-3 rounded mt-1 w-full" type="text" name="_color" value="{{ old('color') ?? $productImage->color  }}"  />
                                        @error('_color')
                                            <p class="text-red-600 mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="media" value="">

                                    <livewire:admin.helpers.media from="image"/>
                                </div>

                            </form>

                                    
                        </div>


                    </div> --}}

                    <!-- Image Delete with Attributes -->
                    <div class="ml-3 flex flex-col">
                        <form method="POST" 

                            action="{{ route('product.image.destroy', $productImage->id) }}">
                            @csrf
                            @method('DELETE')
                            <div class="flex flex-col shadow-2xl">                            
                                <button type="submit" onClick="return confirm('Are you sure to remove?')">
                                    <svg 
                                        xmlns="http://www.w3.org/2000/svg"  
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" 
                                        class="feather feather-trash h-8 w-8 text-red-600 hover:opacity-80 cursor-pointer"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                <button/>
                            </div>

                        </form>

                    </div>
                </div>


            </div>
            <div class="flex ">
                <!-- imag e-->
                <div class="mb-5">
                    <img 
                        class="w-32 h-32  shadow-lg rounded-lg object-cover" 
                        src="{{ asset( $productImage->media->image_url) }}"
                        style="border:2px solid {{ $productImage->color  }}">

                </div>

                {{-- <div class="flex-1x">
                    <div class="flex flex-col">
                        <div class="mb-5 w-full">
                            <x-label for="color" :value="__('Color')" />
    
                            <input id="color" class="block border border-gray-300 py-2 px-3 rounded mt-1 w-full" type="text" name="_color" value="{{ old('color') }}"  />
                            @error('_color')
                                <p class="text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <livewire:admin.helpers.media from="image"/>
                    </div>
                            
                </div>
             --}}

            </div>

        </div>



        <!--- Image Attribute - Size, price  , QTy -->

        <livewire:admin.attribute.create key="{{ now() }}"  :productImage="$productImage"/> 

   			    	
    </div>
@endsection

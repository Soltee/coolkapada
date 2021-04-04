<div>
    <div
        x-data="{editProductImage:false}" 
        class="w-full mr-3 flex flex-col items-start mb-6">

        <div class="relative px-2">
            <img 
                x-on:click="editProductImage = !editProductImage"
                style="border-color: {{ $image->color}}"
                class=" w-32 h-32 object-contain mb-5  cursor-pointer
                    rounded-lg border-2 hover:opacity-70" 
                src="{{ asset($image->media->image_url) }}" >
                <div class="flex flex-col absolute top-0 right-0">
                    <svg 
                        wire:click="deleteProductImage({{$image->id}})"
                        xmlns="http://www.w3.org/2000/svg"  
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" 
                        class="feather feather-trash h-8 w-8 text-red-600 hover:opacity-80 cursor-pointer"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>

                </div>

        </div>

        <div
            x-show.transition.50ms="editProductImage"
            class="fixed h-screen inset-0 z-30 overflow-y-scroll bg-gray-300">
    
            <div class="px-6 py-4 flex flex-col">
                <div class="flex justify-between items-center items-center mb-6">
                    @if($message)
                        <p class="text-green-600 border border-green-600 px-2 py-2"> {{ $message }} </p>
                    @else
                        <p></p>
                    @endif

                    @if($published)
                        <button 
                            wire:click="toggleProductVisibility"
                            class="
                                  text-center px-6 py-2 rounded-lg text-white bg-gray-900 hover:bg-gray-700">
                            Unpublish {{ $product->name }}
                        </button>
                    @else
                        <button 
                            wire:click="toggleProductVisibility"
                            class="
                                  text-center px-6 py-2 rounded-lg text-white bg-gray-900 hover:bg-gray-700">
                            Publish {{ $product->name }}
                        </button>
                    @endif
                </div>
                
                @if($step === 1)
                    <form method="POST" wire:submit.prevent="editProductImage">
                        @csrf
                        <div class="flex flex-col">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <span
                                    x-on:click="editProductImage = false;" 
                                    class="font-thin hover:font-bold text-gray-900 mr-3 cursor-pointer">
                                    Back
                                </span>
                                <h3 class="ml-2 text-sm font-thin">Edit Image </h3>
                            </div>
                            <div class="flex items-center">
                                <button type="submit" class=" px-3 py-2 w-40 text-center t bg-gray-900 text-white cursor-pointer rounded-lg border border-gray-300 hover:bg-gray-700" >
                                    Update &  Skip
                                </button>
                                <button  
                                    wire:click="skiptoAttribute" 
                                    class=" px-3 py-2 w-40 text-center t bg-gray-900 text-white cursor-pointer rounded-lg border border-gray-300 hover:bg-gray-700" >
                                    Skip Step
                                </button>
                            
                        </div>

                        <div class="flex flex-col">
                            <div class="mb-5 w-full">
                                <x-label for="color" :value="__('Color')" />
        
                                <input id="color" class="block border border-gray-300 py-2 px-3 rounded mt-1 w-full" type="text" wire:model.defer="color" value="{{ old('color') }}"  />
                                @error('color')
                                    <p class="text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Image -->
                            <div
                                x-data="{openImages : @entangle('showImages')}" 
                                class="mb-3 w-full flex flex-wrap">

                                <div class="flex flex-col">
                                    <x-label for="media" value="Image" />
                                    <img 
                                        style="border-color: {{ $color }}"
                                        src="/{{ $media_url }}" 
                                        class="w-32 rounded border-2 object-contain" />
                                    <span 
                                        x-on:click="openImages = !openImages" 
                                        class="border border-gray-300 border border-gray-600 px-2 py-2 w-32 text-center mt-1 hover:bg-gray-900 cursor-pointer hover:text-white rounded">Choose Image</span>

                                </div>
                                
                                <div 
                                    x-show.transition.50ms="openImages"
                                    class="fixed inset-0 z-30 px-6 py-6 bg-gray-300">
                                    <livewire:admin.helpers.media from="products"/>
                                </div>
                            </div>

                        </div>
                        </div>
                    </form>

                @else
                <livewire:admin.attribute.create 
                    key="{{ now() }}"  
                    :productImage="$image"/> 
    
                @endif

            </div>
        </div>
            
    </div>

</div>

<div class="h-auto">
    <div class="flex justify-end items-center mb-6">
        @if($published)
            <button 
                wire:click="toggleProductVisibility"
                class="
                    w-32  text-center px-3 py-2 rounded-lg text-white bg-gray-900 hover:bg-gray-700">
                Unpublish {{ $product->name }}
            </button>
        @else
            <button 
                wire:click="toggleProductVisibility"
                class="
                    w-32  text-center px-3 py-2 rounded-lg text-white bg-gray-900 hover:bg-gray-700">
                Publish {{ $product->name }}
            </button>
        @endif
    </div>
    
    @if($step === 1)

        <form method="POST" wire:submit.prevent="saveImage">
            @csrf

            <div class="flex justify-between items-center mb-10">
                <div class="flex items-center">
                    <a href="/products/{{$product->id}}" class="text-xs font-thin hover:text-gray-900 mr-2 hover:font-bold">
                        {{$product->name}}
                    </a>
                    /
                    <h3 class="ml-2 text-sm font-thin">Image </h3>
                </div>
                <button type="submit" class=" px-3 py-2 w-40 text-center text-gray-900 hover:bg-gray-900 hover:text-white cursor-pointer rounded-lg border border-gray-300" >
                    Next Step
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

                    <div class="mb-5 w-full">
                        <livewire:admin.helpers.media  from="productImage"/>
                    </div>

                    
                
                </div>
        </form>

        <!-- Product Images -->
        <div class="flex justify-between items-center  mt-5 mb-2">
            <h3 class="text-sm font-thin">All Product Images </h3>
            @if($message)
                <p class="text-green-600 border px-2 py-2 border-green-600"> {{ $message }} </p>
            @endif
        </div>

        <div class=" flex flex-wrap items-center mb-16">
            @forelse($images as $img)
            <div class="flex flex-col mb-6 relative w-40 h-40 pr-2 mb-4 shadow">
                
                <img 
                    wire:click="nextStep({{$img->id}})"
                    class="w-full shadow-lg border-2 cursor-pointer hover:opacity-75 rounded-lg object-cover" 
                    src="{{ asset( $img->media->image_url) }}"
                    style="border-color: {{ $img->color }}">
                <svg 
                    wire:click="deleteImage({{ $img->id }})"
                    viewBox="0 0 24 24" 
                    fill="none" 
                    stroke="currentColor" 
                    stroke-width="1" stroke-linecap="round" stroke-linejoin="round" 
                    class="
                        absolute top-0 right-0 mr-3 h-8 w-8 text-red-600 hover:opacity-80 cursor-pointer"
                    ><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>

                    
            </div>
    
            @empty
            @endforelse
        </div>

    @else
         <livewire:admin.attribute.create key="{{ now() }}"  :productImage="$image"/> 
    @endif      

</div>

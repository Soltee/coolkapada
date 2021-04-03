<div>
    @if($message)
        <p class="text-green-600 mb-3"> {{ $message }} </p>
    @endif

    <form method="POST" wire:submit.prevent="saveAttribute">
        @csrf

        <div class="">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center">
                    <span 
                        class="cursor-pointer" 
                        wire:click="$emitUp('fromAttribute')">Back</span>
                    <p class="text-gray-700 ml-2 font-thin text-sm"> Attribute </p>
                </div>
                <div class="">
                    <button type="submit" 
                        class="
                            mt-6 px-2 py-2  w-32 bg-gray-900 hover:bg-gray-700 text-white text-center  rounded-lg">
                        Add
                    </button>
                </div>
                
            </div>

            <div class="flex mb-5 w-full">
                <div class="mb-3 w-full sm:w-1/3 pr-3">
                    <x-label for="size" :value="__('Size')" />
    
                    <input id="size" class="block border border-gray-300 py-2 px-3 rounded mt-1 w-full" type="text" wire:model.defer="size" value="{{ old('size') }}"  />

                    @error('size')
                        <p class="text-red-600 mt-1">{{ $message }}</p>
                    @enderror

                </div>
                <div class="mb-3 w-full sm:w-1/3 pr-3">
                    <x-label for="price" :value="__('Price')" />
    
                    <input id="price" class="block border border-gray-300 py-2 px-3 rounded mt-1 w-full" type="text" wire:model.defer="price" value="{{ old('price') }}"  />
                    @error('price')
                        <p class="text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3 w-full sm:w-1/3 pr-3">
                    <x-label for="quantity" :value="__('Quantity')" />

                    <input id="quantity" class="block border border-gray-300 py-2 px-3 rounded mt-1 w-full" type="text" wire:model.defer="quantity" value="{{ old('quantity') }}"  />

                    @error('quantity')
                        <p class="text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
        
            </div>

        </div>

    </form>

    <div class="mb-5">
        @forelse($attributes as $att)
        <div class="flex mb-5 w-full">
            <span class="mb-3 w-1/4 pr-3 border border-gray-300 py-2 px-3 rounded">
                {{$att->size}}
            </span>
            <span class="mb-3 w-1/4 pr-3 border border-gray-300 py-2 px-3 rounded">
                Rs {{$att->price}}
            </span>
            <span class="mb-3 w-1/4 pr-3 border border-gray-300 py-2 px-3 rounded">
                {{$att->quantity}}
            </span>
            <div class="mb-3 w-1/4">
                <svg 
                    wire:click="deleteAttribute({{ $att->id }})"
                    xmlns="http://www.w3.org/2000/svg"  
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" 
                    class="feather feather-trash h-8 w-8 text-red-600 hover:opacity-80 cursor-pointer"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>

            </div>
            
        </div>

        @empty
        @endforelse
    </div>

    <div class="flex justify-end items-center mt-6">
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
    
</div>

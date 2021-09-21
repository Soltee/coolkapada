<div>
    @if($message)
        <p class="text-green-600 mb-3"> {{ $message }} </p>
    @endif

    <form method="POST" wire:submit.prevent="saveAttribute">
        @csrf

        <div class="">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center">
                    <p class="text-gray-700font-thin text-sm"> Attribute </p>
                    
                </div>
                <button type="submit" class=" px-3 py-2 w-40 text-center text-gray-900 hover:bg-gray-900 hover:text-white cursor-pointer rounded-lg border border-gray-300" >
                    Add
                </button>

            </div>


            {{-- {{$image}} --}}
            <!-- form inputs -->
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

            <livewire:admin.attribute.show key="{{ now() }}"  
                :att="$att"
                :p="$product->id"
                :image="$image->id"/> 

        @empty
        @endforelse
    </div>

</div>

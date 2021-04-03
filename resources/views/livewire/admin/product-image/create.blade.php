<div class="h-auto">
    
    @if($step === 1)

        <form method="POST" wire:submit.prevent="saveImage">
            @csrf

            <h3 class="text-sm font-thin"> Product Image </h3>
            
                <div class="flex flex-col mt-3">
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

                    <button type="submit" class="mb-12 px-6 py-3 w-56 text-center text-gray-900 hover:bg-gray-900 hover:text-white cursor-pointer rounded-lg border border-gray-300" >
                        Next Step
                    </button>
        
                
                </div>
        </form>

    @else
         <livewire:admin.attribute.create key="{{ now() }}"  :productImage="$image"/> 
    @endif      

</div>

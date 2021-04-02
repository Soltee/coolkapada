<div>
    <form method="POST" wire:submit.prevent="store">
        @csrf

        @if($message)
            <p class="text-r=green-600"> {{ $message }} </p>
        @endif
        <div class="">
            <div class="mb-4 flex flex-col">
                <label for="image" class="mb-1">image</label>
                <input id=""
                    type="file" 
                    class="px-3 py-2 border rounded border-gray-300"
                    wire:model.defer="image" />
                @error('image') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4 flex flex-col">
                <label for="color" class="mb-1">Color</label>
                <input id=""
                    type="text" 
                    class="px-3 py-2 border rounded border-gray-300"
                    wire:model.defer="color" />
                @error('color') <span class="text-red-600">{{ $message }}</span> @enderror

            </div>

            <div class="mb-4 flex flex-col">
                <label for="size" class="mb-1">Size</label>
                <input id=""
                    type="text" 
                    class="px-3 py-2 border rounded border-gray-300"
                    wire:model.defer="size" />
                    @error('size') <span class="text-red-600">{{ $message }}</span> @enderror

            </div>

            <div class="mb-4 flex flex-col">
                <label for="price" class="mb-1">Price</label>
                <input id=""
                    type="text" 
                    class="px-3 py-2 border rounded border-gray-300"
                    wire:model.defer="price" />
                    @error('price') <span class="text-red-600">{{ $message }}</span> @enderror

            </div>
            <div class="mb-4 flex flex-col">
                <label for="quantity" class="mb-1">Quantity</label>
                <input type="text" 
                    class="px-3 py-2 border rounded border-gray-300"
                    wire:model.defer="quantity" />
                    @error('quantity') <span class="text-red-600">{{ $message }}</span> @enderror

            </div>

        </div>
        <button type="submit" class="w-full mt-8 px-8 py-3 rounded bg-gray-900 hover:opacity-75 text-white ">Upload</button>

    </form>        

</div>

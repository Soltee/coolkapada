<div 
    x-data="{ editProduct : false }"
    class="">
    <svg 
        x-on:click="editProduct = !editProduct;"
        xmlns="http://www.w3.org/2000/svg" 
        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" 
        class="h-8 w-8 cursor-pointer text-yellow-600"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>

    <!-- Edit -->

    <div
        x-show.transition.50ms="editProduct"
        class="fixed h-screen inset-0 z-30 overflow-y-scroll bg-gray-300">

        <div class="px-6 py-4">
            <form method="POST" wire:submit.prevent="editProduct">
                @csrf

                <div class="flex justify-between items-center">
                    <span
                        x-on:click="editProduct = false;" 
                        class="font-thin hover:font-bold text-gray-900 mr-3 cursor-pointer">Back</span>
            
                    <h4 class="text-md text-gray-700">{{$product->name}}</h4>
                    <button type="submit" class="px-3 py-3 bg-gray-900 hover:bg-gray-700 text-white  rounded-lg">Edit</button>

                </div>
                
                <div class="">
                    
                    
                    <div class="mb-3 w-full">
                        <x-label for="name" :value="__('Name')" />

                        <input id="name" class="block border border-gray-300 py-2 px-3 rounded mt-1 w-full" type="text" wire:model.defer="name" value="{{ old('name') ?? $name }}"  />
                        @error('name')
                            <p class="mt-2 text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 w-full">
                        <x-label for="cat" :value="__('Category')" />
                        <div class="inline-block relative w-full">
                            <select wire:model="category" class="block appearance-none w-full bg-white border-r-lg border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                @forelse($categories as $category)
                                    <option 
                                        {{ ($category === $category->id) ? 'selected' : '' }}
                                        value="{{ $category->id }}">
                                            {{ $category->name }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                            </div>
                        
                        @error('category')
                            <p class="mt-2 text-red-600">{{ $message }}</p>
                        @enderror
                    
                            
                    </div>
                    <div class="mb-3 w-full">
                        <x-label for="description" value="Description" />

                        <textarea id="description" 
                            class="bg-white w-full" 
                            wire:model.defer="description" 
                            value="{{ old('description') ?? $description }}  "
                            rows="5"
                            >

                        </textarea>
                        @error('description')
                            <p class="mt-2 text-red-600">{{ $message }}</p>
                        @enderror
                    

                    </div>

                    <div
                        x-data="{openImages : @entangle('showImages')}" 
                        class="mb-3 w-full flex flex-wrap">
                        <div class="flex flex-col">
                            <x-label for="media" value="Image" />
                            
                            <img src="/{{ $media_url }}" class="w-32 rounded  object-contain" />
                            <span 
                                x-on:click="openImages = !openImages" 
                                class="border border-gray-300 border border-gray-600 px-2 py-2 w-32 text-center mt-1 hover:bg-gray-900 cursor-pointer hover:text-white rounded">Choose Image</span>
                            @error('name')
                                <p class="mt-2 text-red-600">{{ $message }}</p>
                            @enderror
                        
                        </div>
                        
                        <div 
                            x-show.transition.50ms="openImages"
                            class="fixed inset-0 z-30 px-6 py-6 bg-gray-300">
                            <livewire:admin.helpers.media from="products"/>
                        </div>
                    </div>

                    
                </div>
            </form>
            
        </div>

    </div>

</div>

<div class="w-full flex flex-col md:flex-row">

    <!--- Left hand side -->
    <div class="w-full md:w-56">
        <div class="mr-0 md:mr-4">
            <div 
                class="md:hidden flex justify-between items-center relative"
                x-data="{ openDropDown: @entangle('showDropdown') }"
                >
                <h2 class="text-lg m-0">
                    Filters {{ $showDropdown }}
                </h2>
                <div>
                    <svg 
                        x-show.transition.50ms="!openDropDown" 
                        x-on:click="openDropDown = !openDropDown"
                        class="text-gray-900 h-10 w-10 cursor-pointer hover:opacity-70"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" ><polyline points="6 9 12 15 18 9"></polyline></svg>

                    <svg
                        x-show.transition.50ms="openDropDown"  
                        x-on:click="openDropDown = !openDropDown"
                        class="text-gray-900 h-10 w-10 cursor-pointer hover:opacity-70"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" ><polyline points="18 15 12 9 6 15"></polyline></svg>

                    <!-- Filters -->
                    <div 
                        x-show.transition.50ms="openDropDown"
                        class="mt-10 bg-gray-200 absolute inset-0 rounded-lg p-2 z-40 overflow-auto h-64">
                        <div class="mb-5">
                            <div class="flex justify-between">
                                <h3 class="text-lg font-semibold">
                                    Category
                                </h3>
                            </div>

                            <div class="" id="filter-section-mobile-1">

                                <div class="space-y-2">
                                    @forelse($categories as $cat)
                                        <label  
                                            {{-- x-on:click="openDropDown = !openDropDown" --}} 
                                            wire:click="filterByCategory"
                                            class="
                                                custom_radio relative flex flex-col"
                                            >
                                            <div 
                                            class="
                                                radio_btn mr-2 px-5 py-2 rounded-lg  border text-gray-900 cursor-pointer hover:border-blue-500 flex items-center justify-between
                                                    {{ ($cat->id === $category) ? 'border-blue-500' : '' }} 

                                                "
                                                >
                                                <input 
                                                    wire:model.defer="category" 
                                                    value="{{ $cat->id }}" 
                                                    type="radio"
                                                    {{ ($cat->id === $category) ? 'checked' : '' }}  
                                                    class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500"
                                                    >
                                            
                                                <span class="text-md">{{ $cat->name }}</span>
                                            </div>
                                        </label>
                                        
                                        
                                    @empty
                                    @endforelse
                                
                                </div>

                            </div>
                        </div>

                        <!-- Size -->
                        <div class="border-t border-gray-200 ">
                            <h3 class="">
                              Size
                            </h3>

                            <!-- Filter section, show/hide based on section state. -->
                            <div class="" 
                            >
                                <div class="space-y-2">
                                
                                    @forelse($sizes as $s)
                                        <label 
                                            {{-- x-on:click="openDropDown = !openDropDown" --}}  
                                            wire:click="filterBySize" 
                                            class="custom_radio relative flex flex-col">
                                            <div class="radio_btn mr-2 px-5 py-2 rounded-lg  border text-gray-900 cursor-pointer hover:border-blue-500 flex items-center justify-between
                                                {{ ($s['symbol'] === $size) ? 'border-blue-500' : '' }}
                                                "
                                                >
                                                <input 
                                                    wire:model.defer="size" 
                                                    value="{{ $s['symbol'] }}" 
                                                    type="radio"
                                                    {{ ($s['symbol'] === $size) ? 'checked' : '' }}  
                                                    class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500"
                                                    >
                                            
                                                <span class="text-md">{{ $s['name'] }}</span>
                                            </div>
                                        </label>

                                      
                                    @empty
                                    @endforelse


                                </div>
                            </div>

                        </div> 
                    </div>

                </div>  
            </div>

            <!-- Large Screen -->
            <div class="hidden md:block">
                <!-- Category  -->
                <div class="border-t border-gray-200 px-4 py-6">
                    <div class="flex justify-between">
                        <h3 class="-mx-2 -my-3">
                            Category
                        </h3>
                    </div>

                    <!-- Filter section, show/hide based on section state. -->
                    <div class="pt-6" id="filter-section-mobile-1">

                        <div class="space-y-2">
                            @forelse($categories as $cat)
                                <label  
                                    wire:click="filterByCategory"
                                    class="
                                        custom_radio relative flex flex-col"
                                    >
                                    <div 
                                    class="
                                        radio_btn mr-2 px-5 py-2 rounded-lg  border text-gray-900 cursor-pointer hover:border-blue-500 flex items-center justify-between
                                            {{ ($cat->id === $category) ? 'border-blue-500' : '' }} 

                                        "
                                        >
                                        <input 
                                            wire:model.defer="category" 
                                            value="{{ $cat->id }}" 
                                            type="radio"
                                            {{ ($cat->id === $category) ? 'checked' : '' }}  
                                            class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500"
                                            >
                                    
                                        <span class="text-md">{{ $cat->name }}</span>
                                    </div>
                                </label>
                                
                                
                            @empty
                            @endforelse
                        
                        </div>

                   </div>
                </div>

                <!-- Size -->
                <div class="border-t border-gray-200 px-4 py-6">
                    <h3 class="-mx-2 -my-3">
                      Size
                    </h3>

                        <!-- Filter section, show/hide based on section state. -->
                        <div class="pt-6" 
                        >
                            <div class="space-y-2">
                            
                                @forelse($sizes as $s)
                                    <label  
                                        wire:click="filterBySize" 
                                        class="custom_radio relative flex flex-col">
                                        <div class="radio_btn mr-2 px-5 py-2 rounded-lg  border text-gray-900 cursor-pointer hover:border-blue-500 flex items-center justify-between
                                            {{ ($s['symbol'] === $size) ? 'border-blue-500' : '' }}
                                            "
                                            >
                                            <input 
                                                wire:model.defer="size" 
                                                value="{{ $s['symbol'] }}" 
                                                type="radio"
                                                {{ ($s['symbol'] === $size) ? 'checked' : '' }}  
                                                class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500"
                                                >
                                        
                                            <span class="text-md">{{ $s['name'] }}</span>
                                        </div>
                                    </label>

                                  
                                @empty
                                @endforelse


                            </div>
                        </div>

                </div>    
            </div>

        </div>

    </div>
    
    <!--- Right hand side -->
    <div class=" md:ml-3 flex-1 flex flex-col w-full">
            
        <div class="flex  justify-between items-center  mb-3 w-full">
            <div class="flex items-center">
                <a href="/"><h4 class="text-md opacity-75 hover:opacity-100 font-light text-gray-900 mr-2">HOME</h4></a>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                <h4 class="text-lg font-bold text-gray-900 ">SHOP</h4>
            </div>
            
            <span class=" text-gray-900 ">
                @if($total > 0)
                    Showing {{ $first . ' - ' . $last }} of {{ $total }}
                @endif
            </span>
        </div>


        <div 
            x-data="{ openQuickView: false }"
            class="flex flex-col">

            <!-- Products -->
            <div class="w-full grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">

                @forelse($products as $product)

                    <div class="flex flex-col mb-6 shadow rounded-lg w-full">
                        <div 
                            class="imgBlock relative w-full  cursor-pointer w-full">
                            <div class="overflow-hidden">
                                <a class="" 
                                    href="{{ route('product', $product->slug)}}">
                                    <img  
                                        class="w-full mb-5 h-72 object-top object-fit rounded object-cover hover:opacity-70" 
                                        src="{{ asset($product->media->image_url) }}" 
                                        alt="{{ $product->slug }}">
                                </a>
                            </div>

                            <div>
                                <div
                                    class="quick_view absolute inset-0 flex justify-center items-center"
                                    >
                                        <span 
                                            class="rounded px-6 py-2 bg-gray-600 text-white hover:bg-gray-800 hover:text-white"
                                            >Quick View</span>

                                </div>
                            </div>


                        </div>
                        
                        <!-- Product Quick View -->
                        {{-- <div 
                            x-show="openQuickView"
                            class=" fixed inset-0 z-20 flex justify-center items-center">
                            <div 
                                x-on:click="openQuickView = !openQuickView"
                                class="absolute inset-0 bg-green-100 opacity-70"></div>
                            <div class="flex justify-center items-center shadow-xl rounded-lg">
                                <livewire:customer.product 
                                    :from="'single'"
                                    :url="'/product/'.$product->slug"
                                    :p="$product->id" 
                                    />
                            </div>
                        </div> --}}

                        <!-- Product Description -->
                        <div class="pb-3 px-3">

                            <div class="flex  justify-between items-center mb-2">
                                <a class="" href="{{ route('product', $product->slug)}}">
                                    <h2 class="hover:font-bold cursor-pointe text-thin text-gray-700">
                                        {{ $product->name }} 
                                    </h2>
                                </a>
                                <h4 class="text-lg font-semibold">
                                    RS {{ $product->min }} +
                                    NP 
                                </h4>

                            </div>

                            @if(!$product->attributes()->sum('quantity'))
                                <div class="flex items-center">
                                    <span class="font-bold text-red-600">Out of Stock</span>
                                </div>
                            @endif

                        </div>
                      
                    </div>

                @empty
                    <div class="flex flex-col items-center mb-8">

                        <p class="font-thin text-md text-red-600 text-center flex items-center w-full">
                            Oops! Empty.
                        </p>

                    </div>


                @endforelse

            </div>
                            

            <!-- Pagination -->

            @if ($products->hasPages())

                <div class="md:flex mb-12">
                    <div class="flex-initial mr-8">
                        {!! $products->links() !!}
                    </div>
                </div>

            @endif

        </div>
    </div>

</div>

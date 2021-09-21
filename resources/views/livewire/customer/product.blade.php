<div class="flex flex-col w-full relative">

    @if($from === 'single')


        <div class="flex flex-col md:flex-row">
            <div 
                class="imgBlock relative w-full  cursor-pointer w-full md:w-1/2">
                    <div class="overflow-hidden">
                        <a class="" href="{{ route('product', $p->slug)}}">
                            <img  class="w-full mb-5 h-72 object-top object-fit rounded object-cover hover:opacity-70 shadow" src="{{ asset($cover) }}" alt="{{ $p->slug }}">
                        </a>
                    </div>
                </div>

            <div class=" w-full md:w-1/2">
            <div class="ml-3">

                <a class="" href="{{ route('product', $p->slug)}}">
                    <h2 class="hover:font-bold cursor-pointer mt-3 text-thin text-gray-700">
                        {{ $p->name }} 
                    </h2>
                </a>
                @if($price)
                    <span class=" text-lg font-bold">
                        Rs {{ $price }} NP
                    </span>
                @else
                    <h4 class=" text-lg font-bold">
                        RS {{ $min }} +
                        {{-- @if($max) - {{ $max }} @endif  --}}
                        NP 
                    </h4>
                @endif

                @if($stock)

                
                    <form method="POST" wire:submit.prevent="store">
                        @csrf
                        <div class="w-full flex flex-col">

                            <!-- Color -->
                            <div class="w-full flex flex-row items-center mt-2">
                            
                            @forelse($images as $c)

                              <label  class="custom_radio relative flex flex-col">
                              <input 
                                class=" hidden z-0" 
                                type="radio"
                                {{ ($loop->first) ? 'checked' : '' }} 

                                wire:click="getAttributes({{$c->identifier_id}})"
                                value="{{ $c->color }}">
                                <span  class="radio_btn mr-2 px-4 py-4  rounded-full  border-2 border-white text-gray-900 cursor-pointer z-10" style="background-color: {{ $c->color }}"
                                >
                                  
                                </span>
                                
                              </label>

                              
                            @empty

                            @endforelse
                            </div>      
                            

                            <!-- Sizes -->
                            @if($attributes)
                                <div class=" mt-4 flex flex-row  flex-wrap items-center">
                                    @forelse($attributes as $a)
                                    <div>

                                        <label  class="custom_radio2 relative flex flex-col">
                                            <input 
                                                class="hidden" 
                                                type="radio"  
                                                wire:click="qty({{ $a->identifier_id }}, {{ $a->price }}, {{ $a->quantity}})"
                                                {{ ($loop->first) ? 'checked' : '' }} 
                                                wire:model.defer="size" 
                                                value="{{ $a->size }}">

                                            <span  
                                                class="radio_btn2 mr-2 px-3 py-2 hover:bg-gray-900 hover:text-white rounded  border-2 border-gray-300 text-gray-900 cursor-pointer hover:border-gray-400"
                                                >
                                                {{ $a->size }}
                                            </span>
                                            
                                        </label>

                                    </div>

                                    
                                    
                                    @empty 
                                    @endforelse
                                    
                                </div> 
                            @else
                                <div disabled class="mt-4 flex flex-wrap w-full opacity-70">
                                    @foreach($sizes as $s)

                                        <span  
                                            class="mr-2 px-3 py-2 rounded  border-2 border-white  text-gray-900 border-gray-200"
                                            >
                                            {{ $s }}
                                        </span>
                                    @endforeach
                                </div>
                        
                            @endif
                            <!-- Stock or Out of Stock -->
                            @if($price)    
                                @if($quantity > 0)
                                    <div class="mt-4 flex flex-col">
                                        <input 
                                            type="number" 
                                            wire:model="qty" 
                                            class="px-4 py-2 rounded border-1   w-full md:w-56 text-gray-900" value="1" 
                                            min="1"
                                            max="{{ $quantity }}"
                                            >
                                            
                                        @if($qty > $quantity)
                                            <p class="text-red-600 mt-2">Sorry! We donot have more than that right now.</p>
                                        @endif
                                    </div>

                                    <button type="submit" class="w-full md:w-56 mt-8 px-8 py-3 rounded bg-gray-900 hover:opacity-75 text-white ">Add To Bag</button>
                                    
                                @else
                                    <button disabled class="w-full md:w-56 mt-6 px-8 py-3" >Out of Stock</button>
                                @endif
                    
                            @endif

                            </div>
                        
                    </form>

                @else
                    <div class="flex items-center">
                        <span class="font-bold text-red-600">Out of Stock</span>
                    </div>
                @endif

            </div>
            </div>
        </div>


    @else              
    
        <div 
            class="imgBlock relative w-full  cursor-pointer">
            <div class="overflow-hidden">
                <a class="" href="{{ route('product', $p->slug)}}">
                    <img  class="w-full mb-5 h-72 object-top object-fit rounded object-cover hover:opacity-70 shadow" src="{{ asset($cover) }}" alt="{{ $p->slug }}">
                </a>
            </div>
        </div>

        <div class="">

            <h2 class="mt-3 text-thin text-gray-700">
                {{ $p->name }} 
            </h2>
            @if($price)
                <span class=" text-lg font-bold">
                    Rs {{ $price }} NP
                </span>
            @else
                <h4 class=" text-lg font-bold">
                    RS {{ $min }} +
                    {{-- @if($max) - {{ $max }} @endif  --}}
                    NP 
                </h4>
            @endif

            @if($stock)

            
                <form method="POST" wire:submit.prevent="store">
                    @csrf
                    <div class="w-full flex flex-col">

                        <!-- Color -->
                        <div class="w-full flex flex-row items-center mt-2">
                        
                        @forelse($images as $c)

                          <label  class="custom_radio relative flex flex-col">
                          <input 
                            class=" hidden z-0" 
                            type="radio"
                            {{ ($loop->first) ? 'checked' : '' }} 

                            wire:click="getAttributes({{$c->identifier_id}})"
                            value="{{ $c->color }}">
                            <span  class="radio_btn mr-2 px-4 py-4  rounded-full  border-2 border-white text-gray-900 cursor-pointer z-10" style="background-color: {{ $c->color }}"
                            >
                              
                            </span>
                            
                          </label>

                          
                        @empty

                        @endforelse
                        </div>		
                        

                        <!-- Sizes -->
                        @if($attributes)
                            <div class=" mt-4 flex flex-row  flex-wrap items-center">
                                @forelse($attributes as $a)
                                <div>

                                    <label  class="custom_radio2 relative flex flex-col">
                                        <input 
                                            class="hidden" 
                                            type="radio"  
                                            wire:click="qty({{ $a->identifier_id }}, {{ $a->price }}, {{ $a->quantity}})"
                                            {{ ($loop->first) ? 'checked' : '' }} 
                                            wire:model.defer="size" 
                                            value="{{ $a->size }}">

                                        <span  
                                            class="radio_btn2 mr-2 px-3 py-2 hover:bg-gray-900 hover:text-white rounded  border-2 border-gray-300 text-gray-900 cursor-pointer hover:border-gray-400"
                                            >
                                            {{ $a->size }}
                                        </span>
                                        
                                    </label>

                                </div>

                                
                                
                                @empty 
                                @endforelse
                                
                            </div> 
                        @else
                            {{-- <div disabled class="mt-4 flex flex-wrap w-full opacity-70">
                                @foreach($sizes as $s)

                                    <span  
                                        class="mr-2 px-3 py-2 rounded  border-2 border-white  text-gray-900 border-gray-200"
                                        >
                                        {{ $s }}
                                    </span>
                                @endforeach
                            </div> --}}
                    
                        @endif
                        <!-- Stock or Out of Stock -->
                        @if($price)    
                            @if($quantity > 0)
                                <div class="mt-4 flex flex-col">
                                    <input 
                                        type="number" 
                                        wire:model="qty" 
                                        class="px-4 py-2 rounded border-1   w-full md:w-56 text-gray-900" value="1" 
                                        min="1"
                                        max="{{ $quantity }}"
                                        >
                                        
                                    @if($qty > $quantity)
                                        <p class="text-red-600 mt-2">Sorry! We donot have more than that right now.</p>
                                    @endif
                                </div>

                                <button type="submit" class="w-full md:w-56 mt-8 px-8 py-3 rounded bg-gray-900 hover:opacity-75 text-white ">Add To Bag</button>
                                
                            @else
                                <button disabled class="w-full md:w-56 mt-6 px-8 py-3" >Out of Stock</button>
                            @endif
                
                        @endif

                        </div>
                    
                </form>

            @else
                <div class="flex items-center">
                    <span class="font-bold text-red-600">Out of Stock</span>
                </div>
            @endif

        </div>

    @endif

 
</div>

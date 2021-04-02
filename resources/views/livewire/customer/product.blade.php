<div class="flex flex-col w-full">
    	
    <h2 class="mt-3 text-thin text-gray-700">
        {{ $p->name }}
    </h2>
    @if($price)
        <span class="mt-3 text-lg font-bold">
            Rs {{ $price }} NP
        </span>
    @else
        <h4 class="mt-3 text-lg font-bold">
            RS {{ $min }} - {{ $max }} NP
        </h4>
    @endif

    <form method="POST" wire:submit.prevent="store">
        @csrf
        <div class="w-full flex flex-col">

            <!-- Color -->
            <div class="w-full flex flex-row items-center mt-6">
            
            @forelse($images as $c)

              <label  class="custom_radio relative flex flex-col">
              <input 
                class=" hidden z-0" 
                type="radio"
                wire:click="attributes({{ $c->id }})"  
                {{ ($loop->first) ? 'checked' : '' }} 
                wire:model.defer="color" value="{{ $c->color }}">
                <span  class="radio_btn mr-2 px-4 py-4  rounded-full  border-2 border-white text-gray-900 cursor-pointer z-10" style="background-color: {{ $c->color }}"
                >
                  
                </span>
                
              </label>

              
            @empty

            @endforelse
            </div>		
            
            <!-- Sizes -->
            @if($attributes)
                <div class=" mt-6 flex flex-row  flex-wrap items-center">
                    @forelse($attributes as $a)
                    <div>

                        <label  class="custom_radio2 relative flex flex-col">
                            <input 
                                class="hidden" 
                                type="radio"  
                                wire:click="qty({{ $a->id }}, {{ $a->price }}, {{ $a->quantity}})"
                                {{ ($loop->first) ? 'checked' : '' }} 
                                wire:model.defer="size" 
                                value="{{ $a->size }}">

                            <span  
                                class="radio_btn2 mr-2 px-3 py-2 hover:bg-gray-900 hover:text-white rounded  border-2 border-gray-200 text-gray-900 cursor-pointer hover:border-gray-400"
                                >
                                {{ $a->size }}
                            </span>
                            
                        </label>

                    </div>

                    
                    
                    @empty 
                    @endforelse
                    
                </div> 
            @else
                <div class="mt-6 flex flex-wrap w-full">
                    @foreach($sizes as $s)

                        <span  
                            class="mr-2 px-3 py-2 rounded  border-2 border-white text-gray-900 border-gray-200"
                            >
                            {{ $s }}
                        </span>
                    @endforeach
                </div>
        
            @endif
            <!-- Stock or Out of Stock -->
            @if($price)    
                @if($quantity > 0)
                        <div class="mt-6">
                            <input type="number" wire:model.defer="qty" class="px-4 py-4 md:py-2 rounded border-1 border-c-light-gray  w-full md:w-56 text-gray-900" value="1" min="1" max="{{ $quantity }}">
                            <span class="text-gray-700 font-thin text-xs mt-2">*Optional</span>
                        </div>

                    <button type="submit" class="w-full md:w-56 mt-8 px-8 py-3 rounded bg-gray-900 hover:opacity-75 text-white ">Add To Bag</button>
                    
                @else
                    <button class="w-full md:w-56 mt-6 px-8 py-3" >Out of Stock</button>
                @endif
    
            @else

                <button disabled class="w-full md:w-56 mt-6 px-8 py-3 rounded  bg-gray-700 cursor-auto text-white ">Add To Bag</button>


            @endif

            </div>
        
    </form>

 
</div>

<li class="py-6 flex">
    <div class=" w-24 h-24 border border-gray-200 rounded-md overflow-hidden">
        <a href="/product/{{ $slug }}">
            <img  class="rounded-lg w-32 h-32 object-center object-contain  hover:opacity-75" src="{{ asset($image) }}" >
        </a>
    </div>

    <div class="ml-4 flex-1 flex flex-col">
        <div>
            <div class="flex justify-between text-base font-medium text-gray-900">
              <div class="flex flex-col">
                <a href="/product/{{ $slug }}" class="hover:opacity-60">
                  {{ $name }} 
                </a>

                <div class="flex items-center">
                    <span  
                        class="mr-2 rounded-full h-6 w-6" style="background-color: {{ $color }}"
                            >          
                    </span>
                    <span  
                        class="mr-2 rounded text-center border border-gray-300 px-2 py-1 text-xs"
                            > 
                        {{ $size }}         
                    </span>
                </div>
              </div>
              <p class="ml-4">
                Rs {{ $price * $quantity }} 
              </p>
            </div>
        </div>

        <div class="flex-1 flex items-end justify-between text-sm">
            <div class="flex flex-col">
                <p class="text-gray-500">
                  Price : {{ $price }}
                </p>
                <p class="text-gray-500">
                  Qty : {{ $quantity }}
                </p>
            </div>

            <div class="flex">
              <button 
                wire:click="removeItem" 
                class="font-medium text-red-400 hover:text-red-500">Remove</button>
            </div>
        </div>
    </div>
</li>
            
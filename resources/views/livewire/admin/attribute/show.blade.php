 <div>
    @if($message)
        <p class="text-green-600 mb-3"> {{ $message }} </p>
    @endif

    
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
                    wire:click="deleteAttribute"
                    xmlns="http://www.w3.org/2000/svg"  
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" 
                    class="feather feather-trash h-8 w-8 text-red-600 hover:opacity-80 cursor-pointer"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>

            </div>
            
    </div>

   
</div>

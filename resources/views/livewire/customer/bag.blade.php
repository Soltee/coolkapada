<li
    x-data="{ shopBag : false }"
    class="list-none mr-4 mb-3 md:mb-0"
    >
    <div class="flex items-center cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" 
            x-on:click="shopBag = !shopBag" 
            class="w-6 h-6 mr-1 {{ 
                (Route::currentRouteName() == 'bag') ? 'font-bold text-white md:text-gray-900' : 'text-white md:text-gray-900' }}" 
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
       
        <span
            x-on:click="shopBag = !shopBag"
            class="{{ (Route::currentRouteName() == 'bag') ? 'font-bold text-white md:text-gray-900' : 'text-white md:text-gray-900' }}" 
            >
            {{ $total_qty }}</span>

    </div>

    <!-- Livewire Shoping shopBag -->
    <div 
        x-show.transition.50ms="shopBag"
        class="z-30 fixed inset-0 flex justify-end">
        <div class="hidden md:block absolute left-0 top-0 bottom-0 md:w-1/2 flex flex-col bg-white h-screen bg-gray-100 opacity-70 py-6 px-4 sm:px-6">
        </div>
        <div class="absolute right-0 top-0 bottom-0 md:w-1/2 flex flex-col bg-white rounded-l shadow-lg h-screen overflow-y-scroll overflow-x-auto py-6 px-4 sm:px-6">
            
            <div class="z-40 flex justify-between items-center">
                <h5 class="p-0 m-0 text-gray-800 text-lg">Bag</h5>
                <svg 
                    x-on:click="shopBag = !shopBag" 
                    class="h-6 w-6 cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>


            <div
                >
                
                <!-- If Total > 0 -->
                <div>
                    
                    @if($total_qty > 0)
                        <div class="border-t border-gray-200 mt-4">
                            <div 
                                class="">
                                <ul role="list" class=" divide-gray-200">

                                @forelse($items as $item)
                                    
                                    <livewire:customer.partials.item 
                                        :i="$item"
                                        wire:key="{{ $loop->index }}"
                                        />

                                @empty 

                                @endforelse
                            </ul>


                        </div>

                        <div class="border-t border-gray-200 mt-4">
                            <div class="flex justify-between text-base font-medium text-gray-900">
                              <p>Subtotal</p>
                              <p>RS {{ $sub }} </p>
                            </div>
                            <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                            <div class="mt-6">
                              <a href="/checkout" class="flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-gray-900 hover:opacity-80">Checkout</a>
                            </div>
                            <div class="mt-6 flex justify-center text-sm text-center text-gray-500">
                              <p>
                                or <a href="/bag" class="text-gray-600 font-medium hover:opacity-80">Shopping Bag<span aria-hidden="true"> &rarr;</span></a>
                              </p>
                            </div>
                        </div>

                    @else 

                        <div class="border-t border-gray-200 mt-4">
                            <p class="mt-0.5 text-xl text-red-400">Oops! 
                            </p>
                            <p class="text-sm text-red-400">My shopping bag is empty.</p>

                            <div class="flex justify-between text-base font-medium text-gray-900 mt-3">
                              <p>Subtotal</p>
                              <p>RS 0 </p>
                            </div>
                        
                            <div class="mt-6">
                              <a href="/shop" class="flex justify-center items-center px-6 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-gray-800 hover:bg-gray-700">Let me buy some products.</a>
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>
</li>           
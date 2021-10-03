<div class="flex flex-col md:flex-row">

    <div class="w-64"> 
        <!-- Review Form --->
        @auth
            <div class="w-full"> 
                @if (session()->has('message'))
                    <p class="text-xl text-gray-600 md:pr-16">
                        {{ session('message') }}
                    </p>
                @endif
                <form wire:submit.prevent="rate">

                    <div class="w-full">
                        <div class="flex space-x-1 rating">
                            <label for="star1">
                                <input hidden wire:model="rating" type="radio" id="star1" name="rating" value="1" />
                                <svg class="cursor-pointer  w-8 h-8 @if($rating >= 1 ) text-yellow-500 @else text-gray-300 @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            </label>
                            <label for="star2">
                                <input hidden wire:model="rating" type="radio" id="star2" name="rating" value="2" />
                                <svg class="cursor-pointer  w-8 h-8 @if($rating >= 2 ) text-yellow-500 @else text-gray-300 @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            </label>
                            <label for="star3">
                                <input hidden wire:model="rating" type="radio" id="star3" name="rating" value="3" />
                                <svg class="cursor-pointer  w-8 h-8 @if($rating >= 3 ) text-yellow-500 @else text-gray-300 @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            </label>
                            <label for="star4">
                                <input hidden wire:model="rating" type="radio" id="star4" name="rating" value="4" />
                                <svg class="cursor-pointer  w-8 h-8 @if($rating >= 4 ) text-yellow-500 @else text-gray-300 @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            </label>
                            <label for="star5">
                                <input hidden wire:model="rating" type="radio" id="star5" name="rating" value="5" />
                                <svg class="cursor-pointer  w-8 h-8 @if($rating >= 5 ) text-yellow-500 @else text-gray-300 @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            </label>
                        </div>
                        <div class="my-5">
                            <textarea wire:model.lazy="comment" 
                                class="w-full px-4 py-3 border border-2 rounded-lg focus:border-blue-500 focus:outline-none
                                    @error('comment') border-red-400 @enderror"

                                 placeholder="Comment.."></textarea>
                            @error('comment')
                                <p class="mt-1 text-red-500">{{ $message }}</p>
                            @enderror
                            
                        </div>
                    </div>
                    <div class="w-full">
                        <button 
                            type="submit" 
                            class="w-full px-3 py-2 font-medium text-white bg-gray-800 hover:bg-gray-900 rounded-lg">
                                {{ $selectedId ? 'Edit' : 'Save' }}
                        </button>
                        
                    </div>
                </form>

            </div>

        @else

            <div class="w-full">
                <div class="mb-8 text-gray-600">
                    You need to login in order to be able to rate the product! <a href="/login"
                    class="text-blue-700 text-lg ml-2 hover:text-blue-800 hover:font-semibold-" 
                >Login</a>
            
                </div>
            </div>

        @endauth
    </div>
        
    <div class="md:ml-3 flex-1">
        <!-- Loading -->
        <!-- Content --->
        <div class="mt-6 md:mt-0 mb-6 flex flex-col">
            @forelse ($reviews as $review)

                <div 
                    class="
                        flex col-span-1 shadow-md px-2 py-2 mb-6
                        {{ ($selectedId == $review->id) ? 'bg-gray-300 opacity-75 disabled' : '' }}
                    "
                    >
                    <div class="relative flex-shrink-0 w-12 h-12 text-left">
                        <img
                            class="rounded-full w-full" 
                            src="https://ui-avatars.com/api/?name={{ $review->customer->first_name }}" >
                    </div>
                    <div class="relative px-4 leading-6 text-left">
                        <div class="box-border text-lg font-medium text-gray-600">
                            {{ $review->comment }}
                        </div>
                        <div class="box-border mt-3 text-lg font-semibold text-indigo-900 uppercase">
                            @for ($i = 0; $i < $review->rating; $i++)
                                ⭐
                            @endfor

                        </div>

                        @auth
                        @if(auth()->guard('customer')->user()->id === $review->customer_id)
                            <button 
                                wire:click="selectToEdit('{{$review->id}}')"
                                type="button"
                                class="px-5 mt-2 py-1 rounded-lg bg-red-400 hover:bg-red-500 text-white" 
                                >
                                Edit
                            </button>
                        @endif
                        @endauth
                    </div>
                </div>

            @empty
            <div class="flex col-span-1">
                <div class="relative px-4 mb-16 leading-6 text-left">
                    <div class="box-border text-lg font-medium text-gray-600">
                        No reviews.
                    </div>
                </div>
            </div>
            @endforelse

        </div>

        <!--- Pagination -->
        @if ($reviews->hasPages())

            <div class="flex justify-center items-center">
                {!! $reviews->links() !!}
            </div>

        @endif
    </div>
</div>


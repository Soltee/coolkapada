<div>
    <div class="flex flex-wrap px-3">
        @forelse($medias as $media)
            <div class="w-full sm:1/4 md:w-1/5 lg:w-1/6 mb-6 mr-3">
                <label  class="custom_radio relative flex flex-col">
                    <input 
                        class=" hidden z-0" 
                        type="radio"
                        name="media"
                        name="media" value="{{ $media->id }}">
                                              
                    <img class="radio_btn w-full shadow-lg hover:opacity-75 border border-transparent hover:border-green-600 rounded-lg object-cover" src="{{ asset( $media->image_url) }}">
                </label>

            </div>
        @empty
        @endforelse
                
        
    </div>

    <div class="mt-4 flex justify-center items-center">

        @if($medias->previousPageUrl())
            <span wire:click="previousPage" class="px-2 py-2 text-gray-900 hover:bg-gray-900 hover:text-white cursor-pointer rounded" >
                Prev
            </span>
        @endif
        @if($medias->nextPageUrl())
            <span wire:click="nextPage" class="px-2 py-2 text-gray-900 hover:bg-gray-900 hover:text-white cursor-pointer rounded" >
                Next
            </span>
        @endif

    </div>

</div>

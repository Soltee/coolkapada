<div>
    <div class="flex justify-between items-center mb-3">
        <div class="flex">
            <span
                wire:click="goBack" 
                class="font-thin hover:font-bold text-gray-900 mr-3 cursor-pointer">Back</span>
            <x-label for="Image" :value="__('Image')" />
        </div>
        <div class="lex justify-end items-center">

            @if($medias->previousPageUrl())
                <span wire:click="previousPage" class="px-6 py-2 mr-3 text-gray-900 hover:bg-gray-900 hover:text-white cursor-pointer rounded-lg border border-gray-300" >
                    Prev
                </span>
            @endif
            @if($medias->nextPageUrl())
                <span wire:click="nextPage" class="px-6 py-2 text-gray-900 hover:bg-gray-900 hover:text-white cursor-pointer rounded-lg border border-gray-300" >
                    Next
                </span>
            @endif
    
        </div>
    
    </div>

    <div class="flex flex-wrap px-3">
        @forelse($medias as $media)
            <div class="w-full sm:w-32 mb-6 mr-3">
                <label  class="custom_radio relative flex flex-col">
                    <input 
                        class=" hidden z-0" 
                        type="radio"
                        name="media"
                        value="{{ $media->id }}">
                                              
                    <img 
                        wire:click="passMedia({{ $media->id }})"
                        class="radio_btn w-full shadow-lg hover:opacity-75 border border-transparent hover:border-green-600 rounded-lg object-cover cursor-pointer" 
                        src="{{ asset( $media->image_url) }}">
                </label>

            </div>
        @empty
        @endforelse
                
        
    </div>

    
</div>

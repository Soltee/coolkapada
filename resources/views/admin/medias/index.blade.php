@extends('layouts.admin')

@section('content')
    <div class="w-full">
        <div class="mb-6">
            <div class="flex items-center mb-6">
               <a 
                  href="/admin/dashboard" 
                  class="text-md text-gray-800 hover:opacity-70 border-b border-transparent hover:border-gray-900">Dashboard</a>
               <span class="px-2">/</span>
               <h1 class="text-md font-semibold text-gray-800 ">Medias</h1>

            </div>
            
            <form method="POST" action="/admin/medias" enctype="multipart/form-data">
                @csrf
                <div class="flex  mb-6">
                    <div class="flex flex-col w-full">
                        <label for="files" class="block text-gray-700 text-sm font-bold mb-2">
                            {{ __('Photos') }}
                        </label>

                        <input id="files" type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('files') border-red-500 @enderror " name="files[]" value="{{ old('files') }}"  autofocus required="" placeholder="" multiple>

                        @error('files')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror

                        <button type="submit" class="w-full mt-4 px-8 py-2 rounded bg-gray-900 hover:opacity-75 text-white ">Upload</button>
                    </div>

                </div>
                <div id="imagesProduct" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 overflow-y-scroll mb-6">
                    
                </div>

            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-5">
            @forelse($medias as $media)
                <div class="flex flex-col mb-6 relative">
				    <img class="w-full shadow-lg hover:opacity-75 rounded-lg object-cover" src="{{ asset( $media->image_url) }}">
			     	<div class="flex flex-col absolute top-0 right-0">
                        <form id="media-delete-form" action="{{ route('media.destroy', $media->id) }}" method="POST" class="">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onClick="return confirm('Are you sure?')">
                                <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash h-8 w-8 text-red-600 hover:opacity-80 cursor-pointer"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>

                            </button>
                        </form>
						
                     </div>
                </div>
		
            @empty
            @endforelse
                    
			
		</div>

        <div class="my-6">
            {{ $medias->links() }}
        </div>
	</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function(){
            let allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

            let readImages = document.getElementById('imagesProduct');
            document.getElementById('files').addEventListener('change', (e) => {
                if (e.target.files) {
                    readImages.innerHTML = '';
                    for( var i = 0; i < e.target.files.length; i++ ){
                        const fsize = e.target.files.item(i).size;
                        const file = Math.round((fsize / 1024));
                        if (file >= 2048) {
                            swal('File size too big. Please select less than 2mb.');
                            return;
                        } 

                        const t = e.target.files.item(i).type.split('/').pop().toLowerCase();
                        if (t != "jpeg" && t != "jpg" && t != "png") {
                            swal('Only jpeg, jpg and png file.');
                            return;
                        } 

                        var reader = new FileReader();
                        
                        reader.onload = function (e) {
                            var img = document.createElement("img");
                            img.class ="h-64";
                            img.src = e.target.result;
                            readImages.appendChild(img);
                        }
                        reader.readAsDataURL(e.target.files[i]);

                        }
                
                }
            });

        });
    </script>

@endpush
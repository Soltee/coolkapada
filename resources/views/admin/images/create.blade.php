@extends('layouts.admin')

@section('head')
	{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/nano.min.css"/> <!-- 'nano' theme --> --}}
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.css">
  	<script src="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.min.js"></script>
@endsection

@section('content')
    <div class="">
    	<div class=" mb-6">
			
			<livewire:admin.product-image.create :product="$product->id" />
   			
    	</div>
    	
    </div>
@endsection

{{-- @push('scripts')
	<script>
    		
		let readImage = document.getElementById('imageProduct');

		document.getElementById('file').addEventListener('change', (e) => {
			var reader = new FileReader();
                    
			reader.onload = function (e) {
				readImage.src = e.target.result;
			}
			reader.readAsDataURL(e.target.files[0]);
		});

	</script>

@endpush --}}
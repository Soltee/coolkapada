@extends('layouts.app')
@section('head')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/tiny-slider.css">

	<style>
		.custom_radio input:checked + .radio_btn{
			border: 2px solid black;
			/*padding: 24px;*/
		}
		.custom_radio2 input:checked + .radio_btn2{border: 2px solid black;}

		/* [2] Transition property for smooth transformation of images */
		.img-hover-zoom img {
		  transition: transform .5s ease;
		}

		/* [3] Finally, transforming the image when container gets hovered */
		.img-hover-zoom:hover img {
		  /*transform: scale(1.05);*/
		  opacity: 0.8;
		}	
		.imgBlock{transition: transform 0.3s ease-in-out;}
		.imgBlock:hover img{opacity: 0.7;}
		.imgBlock:hover  .quick_view {
			/*visibility: initial;*/
			/*visibility: initial;*/
		}
		.addBtn{visibility: hidden;}

		.quick_view{visibility: hidden;}

	</style>
@endsection
@section('content')
	<div class="px-6  py-3 w-full flex flex-col md:flex-row justify-between">
			<livewire:customer.shop 

				/>
 	</div>
@endsection
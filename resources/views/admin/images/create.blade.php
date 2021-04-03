@extends('layouts.admin')

@section('head')
	<style>
        .custom_radio input:checked + .radio_btn{border: 3px solid green;}
	</style>
@endsection

@section('content')
    <div class="w-full">
			
		<livewire:admin.product-image.create :product="$product->id" />
   			    	
    </div>
@endsection

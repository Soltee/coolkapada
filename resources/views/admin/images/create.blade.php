@extends('layouts.admin')

@section('head')
	<style>
        .custom_radio input:checked + .radio_btn{border: 3px solid green;}
	</style>
@endsection

@section('content')
    <div class="w-full">
			
        <livewire:admin.product-image.create key="{{ now() }}" :product="$product" />
   			    	
    </div>
@endsection

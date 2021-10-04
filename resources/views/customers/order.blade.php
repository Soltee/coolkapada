@extends('layouts.app')

@section('content')
    <div
        class="px-6  flex flex-col my-6">
        <div class="flex justify-between items-center">
            <div class="flex items-center my-4">
                <a href="/dashboard"><h4 class="text-md opacity-75 hover:opacity-100 font-light text-gray-900 mr-2 hover:text-gray-900 hover:text-lg">Dashboard</h4></a>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>

                <h4 class="text-lg font-bold text-gray-900 ">{{ $order->created_at->diffForHumans() }}</h4>
            </div>

            <div class="flex justify-center items-center">
                    
                {{-- <a class="px-2 py-2 text-center hover:text-blue-600 text-blue-500" href="/invoice/{{ $order->id }}"> Download Invoice </a> --}}
            </div>

        </div>

        <div class="flex flex-col md:flex-row justify-between   mb-6">
            <div class="flex items-start flex-col w-full mb-2 md:mb-0">
                
                <div class="flex items-center w-full">
                    <label for="" class=" border rounded-l px-4 py-3 w-1/2 md:w-auto">Status</label>
                    @if($order->is_paid)
                        <button class="border px-4 py-3 text-white bg-green-600 rounded-r">Completed</button>
                    @else
                        <button class="border px-4 py-3 text-white bg-yellow-600 rounded-r">On your way</button>
                    @endif
                </div>
            </div>

            <div class="flex md:items-center flex-col md:flex-row">
                <div class="flex items-center mr-3 w-full  mb-2 md:mb-0">
                    <label for="" class=" border rounded px-4 py-3 w-1/2 ">Total</label>
                    <span class="border rounded px-4 py-3 font-bold w-48 text-center text-lg ">Rs {{ $order->grand_total   }}</span>
                </div>
        
            </div>

            
        </div>
        

        <div class="my-8 flex flex-col md:flex-row">
            <div class="w-full md:w-1/3">
                <h5 class="mb-4 text-lg text-gray-800 px-2">General Info</h5>
                <div class="flex items-center mb-6">
                    <label for="" class=" border rounded px-4 py-3 md:w-1/3">Name</label>
                    <h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $order->first_name  . ' ' . $order->last_name }}</h4>
                </div>
                <div class="flex items-center mb-6">
                    <label for="" class=" border rounded px-4 py-3 md:w-1/3">Email</label>
                    <h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $order->email }}</h4>
                </div>
                <div class="flex items-center mb-8">
                    <label for="" class=" border rounded px-4 py-3 md:w-1/3">Phone Number</label>
                    <h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $order->phone_number }}</h4>
                </div>
                
            

                <h5 class="mb-4 text-lg text-gray-800 px-2">Billing</h5>
                <div class="flex items-center mb-6">
                    <label for="" class=" border rounded px-4 py-3 md:w-1/3">City</label>
                    <h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $order->city }}</h4>
                </div>
                <div class="flex items-center mb-6">
                    <label for="" class=" border rounded px-4 py-3 md:w-1/3">Street Address</label>
                    <h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $order->street_address }}</h4>
                </div>
                <div class="flex items-center mb-6">
                    <label for="" class=" border rounded px-4 py-3 md:w-1/3">House Number</label>
                    <h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $order->house_number }}</h4>
                </div>
                <div class="flex items-center mb-8">
                    <label for="" class=" border rounded px-4 py-3 md:w-1/3">Created</label>
                    <h4 class="border rounded px-4 py-3 font-bold text-lg flex-1">{{ $order->created_at->diffForHumans() }}</h4>
                </div>

                
            </div>

            <div class="md:ml-4 w-full md:w-2/3">
                
                <div class="flex flex-col border border-gray-400 rounded my-6">
                    <div class="flex justify-between items-center mb-4 px-3 pt-3">
                        <h5 class="text-gray-800 text-md">SubTotal</h5>
                        <span class="text-gray-800 text-md">Rs {{ $order->sub_total }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-4 px-3 ">
                        <h5 class="text-gray-800 text-md">Discount</h5>
                        <span class="text-gray-800 text-md">Rs {{ $order->discount }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-4 px-3 ">
                        <h5 class="text-gray-800 text-md">Shipping</h5>
                        <span class="text-gray-800 text-md">Rs 0</span>
                    </div>
                    <div class="flex justify-between items-center mb-4 border-t border-gray-400 pt-3 px-3">
                        <h5 class="text-gray-800 text-lg">Total</h5>
                        <span class="text-gray-800 text-xl font-bold">Rs {{ $order->grand_total }}</span>
                    </div>
                </div>

                <div class="w-full sm:grid md:grid-cols-2 lg:grid-cols-3 sm:gap-4 md:gap-6 ">
                    @forelse($items as $item)

                        <div class="w-full sm:w-auto flex flex-col items-start mb-6">
                            <div 
                                class="imgBlock relative w-full  cursor-pointer">
                                <div class="overflow-hidden">
                                    <img  class="w-full mb-5 rounded hover:opacity-75" src="{{ asset($item->image_url) }}" >
                                </div>
        


                            </div>
                            <div class="flex flex-col items-start justify-between w-full">
                                <h5 class="mb-3 text-lg text-c-dark-gray">{{ $item->name }}</h5>
                                <div class="flex items-center mb-3 p-3">
                                    <span class="mr-3">
                                        {{ $item->price }} * {{ $item->qty }}
                                    </span>
                                    <span class="font-bold border-1 border-c-light-gray ">
                                        
                                      Rs {{ $item->price * $item->qty }}
                                    </span>
                                </div>
                            </div>
                            
                        </div>

                    @empty

                    @endforelse
                </div>

            </div>
        </div>

		
            
    </div>
@endsection
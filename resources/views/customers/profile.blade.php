@extends('layouts.app')

@section('content')
    <div
        class="px-6 flex flex-col my-6">

        <div class="flex items-center my-4">
            <a href="{{ route('dashboard') }}"
                class="pb-3 mr-4 font-medium text-md border-b-2  hover:border-c-light-blue hover:font-bold "
                >
                    Orders
            </a>
            <button 
                class="pb-3 mr-4 font-medium text-md border-b-2 border-c-light-blue font-bold">
                    Profile
            </button>
        </div>

        <div
            class=" w-full   px-5 rounded mt-2">
        
            <div class="">
                <form action="{{ route('customer.reset', $auth->id) }}" method="POST" accept-charset="utf-8">
                    
                    @csrf
                    @method('PATCH')
                    

                    <div class="flex justify-between items-center mb-4">
                        <p
                            class="pb-3 mr-4 font-medium text-md  "
                            >
                                Change Info
                        </p>
                        <button type="submit" class="bg-gray-900 hover:opacity-75  text-gray-100 font-bold py-3 px-3 rounded focus:outline-none focus:shadow-outline">
                            {{ __('Change') }}
                        </button>

                       
                    </div>
                   
                    <input id="type" type="hidden" name="type" value="other">

                    <div class="flex flex-wrap mb-6">
                        <label for="first_name" class="block text-gray-900 text-sm font-bold mb-2">
                            {{ __('First name') }}:
                        </label>

                        <input id="first_name" type="text" class="border border-gray-500 px-3 py-3 rounded w-full @error('first_name')  border-c-red @enderror" name="first_name" value="{{ $auth->first_name }}" required autocomplete="first_name" autofocus>

                        @error('first_name')
                            <p class="text-c-red text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="flex flex-wrap mb-6">
                        <label for="last_name" class="block text-gray-900 text-sm font-bold mb-2">
                            {{ __('Last name') }}:
                        </label>

                        <input id="last_name" type="text" class="border border-gray-500 px-3 py-3 rounded w-full @error('last_name')  border-c-red @enderror" name="last_name" value="{{ $auth->last_name }}" required autocomplete="last_name" autofocus>

                        @error('last_name')
                            <p class="text-c-red text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <label for="email" class="block text-gray-900 text-sm font-bold mb-2">
                            {{ __('E-Mail Address') }}:
                        </label>

                        <input id="email" type="email" class="border border-gray-500 px-3 py-3 rounded w-full @error('email') border-c-red @enderror" name="email" value="{{ $auth->email }}" required autocomplete="email" disabled>

                        @error('email')
                            <p class="text-c-red text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <label for="password" class="block text-gray-900 text-sm font-bold mb-2">
                            {{ __('Password') }}:
                        </label>

                        <input id="password" type="password" class="border border-gray-500 px-3 py-3 rounded w-full @error('password') border-c-red @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <p class="text-c-red text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap mb-8">
                        <label for="password-confirm" class="block text-gray-900 text-sm font-bold mb-2">
                            {{ __('Confirm Password') }}:
                        </label>

                        <input id="password-confirm" type="password" class="border border-gray-500 px-3 py-3 rounded w-full" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </form>
            </div>

        </div>

		
            
    </div>
@endsection
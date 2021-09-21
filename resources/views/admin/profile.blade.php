@extends('layouts.admin')

@section('content')
   <div>
      <form action="{{ route('admin.update', $auth->id) }}" method="POST" accept-charset="utf-8">
                     
         @csrf
         @method('PATCH')
         

         <div class="flex justify-between items-center mb-6">
            <div class="flex items-center">
               <a 
                  href="/admin/dashboard" 
                  class="text-md text-gray-800 hover:opacity-70 border-b border-transparent hover:border-gray-900">Dashboard</a>
               <span class="px-2">/</span>
               <h1 class="text-md text-gray-800 font-semibold ">Change Password</h1>

            </div>
             
            <button type="submit" class="bg-gray-900 hover:opacity-75  text-gray-100 font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
               {{ __('Change') }}
            </button>

            
         </div>
      

         <div class="flex flex-wrap mb-6">
            <label for="email" class="block text-gray-900 text-sm font-bold mb-3">
               {{ __('Email') }}: <span class="px-2 py-2 rounded bg-gray-300 text-gray-900">Disabled</span>
            </label>

            <input disabled id="email" type="email" class="border border-gray-100 px-3 py-3 text-gray-500 rounded w-full @error('email') border-red-600 @enderror" name="email" value="{{ $auth->email }}" required autocomplete="email">

            @error('email')
               <p class="text-red-600 text-xs italic mt-4">
                     {{ $message }}
               </p>
            @enderror
         </div>

         <div class="flex flex-wrap mb-6">
            <label for="password" class="block text-gray-900 text-sm font-bold mb-2">
               {{ __('Password') }}:
            </label>

            <input id="password" type="password" class="border border-gray-500 px-3 py-3 rounded w-full @error('password') border-red-600 @enderror" name="password" required autocomplete="new-password">

            @error('password')
               <p class="text-red-600 text-xs italic mt-4">
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
@endsection
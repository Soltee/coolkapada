@extends('layouts.guest')

@section('content')
    <x-auth-card>
        <x-slot name="logo">
            <a href="/" class="bg-gray-900">
                <img 
                    class="h-16 w-24"
                    src="/img/ck_logo.svg" alt="Coolkapada Logo">
            </a>
        </x-slot>

        <!-- Validation Errors -->
        {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- First Name -->
            <div>
                <x-label for="first" :value="__('Firstname')" />

                <x-input id="first" class="block mt-1 w-full border border-transparent @error('first_name')  @enderror" type="text" name="first_name" :value="old('first_name')" required  />
            </div>
             <!-- Lasts Name -->
             <div class="mt-4">
                <x-label for="last" :value="__('Lastname')" />

                <x-input id="last" class="block mt-1 w-full border border-transparent @error('last_name')  @enderror" type="text" name="last_name" :value="old('last_name')" required  />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full border border-transparent @error('email')  @enderror" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full border border-transparent @error('password')  @enderror"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>
            <div class="g-recaptcha mt-4 w-full" data-sitekey="{{ env('RECAPTCHA_V2_SITE_KEY') }}"></div>

            <div class="flex flex-col items-center justify-end mt-4">
                <x-button class="ml-4 px-3 py-3 w-full text-center mb-2">
                    {{ __('Register') }}
                </x-button>

                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                
            </div>
        </form>
    </x-auth-card>

@endsection
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

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full shadow-md" type="email" name="email" value="{{ old('email') ?? 'test@gmail.com' }}" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full shadow-md"
                                type="password"
                                name="password"
                                value="{{ old('password') ?? '11111111' }}"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="g-recaptcha mt-4 w-full" data-sitekey="{{ env('RECAPTCHA_V2_SITE_KEY') }}"></div>


            <div class="flex flex-col items-center justify-center mt-4">
                <x-button class="ml-3 px-3 py-3 w-full mb-2">
                    {{ __('Log in') }}
                </x-button>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                        {{ __("Haven't registered yet?") }}
                    </a>
                @endif

                
            </div>
        </form>
    </x-auth-card>

@endsection
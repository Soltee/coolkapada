<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

        <!-- Styles -->
        <link rel="stylesheet" href="/css/app.css">
        @yield('head')
        <style>
            input.checked + .radio_btn{border 2px solid blue;}
            .radio_btn {
                border: 1px solid gray !important;
            }

        </style>
        <!-- Scripts -->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="bg-gray-100">
            @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])            
            
            <!-- Page Content -->
            <main>
                @yield('content')

                {{-- {{ $slot }} --}}
            </main>
        </div>

        @stack('scripts')
        

    </body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
        @yield('head')
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style type="text/css">
            .spinner {
                margin: 100px auto;
                width: 50px;
                height: 40px;
                text-align: center;
                font-size: 10px;
            }

            .spinner>div {
                background-color: #6886c5;
                height: 100%;
                width: 6px;
                display: inline-block;

                -webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;
                animation: sk-stretchdelay 1.2s infinite ease-in-out;
            }

            .spinner .rect2 {
                -webkit-animation-delay: -1.1s;
                animation-delay: -1.1s;
            }

            .spinner .rect3 {
                -webkit-animation-delay: -1.0s;
                animation-delay: -1.0s;
            }

            .spinner .rect4 {
                -webkit-animation-delay: -0.9s;
                animation-delay: -0.9s;
            }

            .spinner .rect5 {
                -webkit-animation-delay: -0.8s;
                animation-delay: -0.8s;
            }

            @-webkit-keyframes sk-stretchdelay {

                0%,
                40%,
                100% {
                    -webkit-transform: scaleY(0.4)
                }

                20% {
                    -webkit-transform: scaleY(1.0)
                }
            }

            @keyframes sk-stretchdelay {

                0%,
                40%,
                100% {
                    transform: scaleY(0.4);
                    -webkit-transform: scaleY(0.4);
                }

                20% {
                    transform: scaleY(1.0);
                    -webkit-transform: scaleY(1.0);
                }
            }

        </style>
        <!-- Scripts -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
        {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
        @livewireStyles
    </head>
    <body>
        @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

        <!-- Header -->
        <header id="header">
            <div class="w-full px-6 py-4 lg:max-w-screen-2xl flex justify-between">
                <!-- Left Side -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="text-lg md:text-xl font-semibold text-gray-900 mr-4">
                        {{ config('app.name') }}
                    </a>

                    <!-- Large Screen Search-->
                    <form id="search" class="hidden md:block" method="GET" action="/shop">
                        @csrf
                        <div class="flex relative mr-6 ">
                            
                            <div class="absolute left-0 top-0 mt-1 ml-2 text-purple-lighter">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search w-6 h-6 text-gray-200"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                          
                            </div>
                            <input 
                                type="text" 
                                id="keyword" 
                                name="keyword" 
                                value="{{ request()->keyword }}" 
                                class=" rounded-lg w-full lg:w-56  border border-gray-300 pl-10 py-1 pr-3" placeholder="Search by name...">
                        </div>
                          
                    </form>
                    
                </div>

                <!-- Right -Side -->
                <div 
                    class="flex items-center">
                    <li class="list-none mr-4">
                        <a class="hover:font-bold text-md font-thin {{ 
                            (Route::currentRouteName() == 'welcome') ? 'font-bold' : 'text-gray-900'
                        }}" href="/">Home</a>
                    </li> 
                    <li class="list-none mr-4">
                        <a class="hover:font-bold text-md font-thin {{ 
                            (Route::currentRouteName() == 'shop') ? 'font-bold' : 'text-gray-900'
                        }}" href="/shop">Shop</a>
                    </li>
                    
                    <!-- Shopping Bag -->
                    <livewire:customer.bag />

                    @auth('customer')
                           
                        <div  x-data="{ lgmenu : false }" class="hidden md:block relative">
                            <svg
                                x-on:click="lgmenu = !lgmenu" 
                                class="cursor-pointer w-6 h-6 text-gray-900 hover:opacity-75 ml-3 md:ml-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lgmenu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line>
                            </svg>
                                <ul 
                                    x-on:click.away="lgmenu = false;"
                                    x-show.transition.50ms="lgmenu"
                                    class="absolute right-0 top-0 mt-12 bg-gray-900 right-0 m-0 flex flex-col items-start px-4 py-3 rounded w-auto z-30">

                                        <li class="list-none mb-3">
                                            <a class="hover:opacity-75 mr-3  text-md font-thin text-white {{ 
                                                (Route::currentRouteName() == 'dashboard') ? 'opacity-75' : ''
                                            }}" href="/dashboard">Dashboard</a>
                                        </li> 
                                        <li class="list-none ">
                                                <a  href="{{ route('logout') }}" class="hover:opacity-75 mr-3  text-md font-thin text-white" 
                                                onclick="
                                                    event.preventDefault();
                                                    if(confirm('Are you sure?')){
                                                     document.getElementById('logout-form').submit();
                                                    }
                                                ">
                                                    
                                                    Logout
                                                </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                </ul>
                        </div>
                    
                    @else

                        <li class="border-l border-gray-300 list-none">
                            <a  
                                class="hover:font-bold  font-thin no-underline py-2 rounded-lg text-gray-900 {{ 
                                (Route::currentRouteName() == 'login') ? 'opacity-75' : ''
                                }}" 
                                href="{{ route('login') }}"
                            >
                                {{ __('MY ACCOUNT') }}
                            </a>
                        </li>

                    @endauth

                    <!-- Small Screens Links-->
                    @auth('customer')
                    <div  x-data="{ menu : false }" class="md:hidden relative">
                        <svg
                            x-on:click="menu = !menu" 
                            xmlns="http://www.w3.org/2000/svg" class="cursor-pointer w-8 h-8 text-gray-900 hover:opacity-75 ml-3 md:ml-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                        <ul 
                            x-show.transition.50ms="menu"
                            x-on:click.away="menu = false"
                            class="md:hidden absolute right-0 top-0 mt-12 bg-gray-900 right-0 m-0 flex flex-col items-start  px-4 py-3 w-auto z-30">
                            <!-- Mobile User Auth COntrol -->
                            @auth('customer')
                                <li class="list-none mb-3">
                                    <a class="hover:opacity-75 mr-3  text-md font-thin text-white {{ 
                                        (Route::currentRouteName() == 'dashboard') ? 'opacity-75' : ''
                                    }}" href="/dashboard">Dashboard</a>
                                </li> 
                                <li class="list-none mb-3">
                                    <a class="hover:opacity-75 text-md text-white font-thin {{ 
                                        (Route::currentRouteName() == 'welcome') ? 'opacity-75' : 'text-white'
                                    }}" href="/">Home</a>
                                </li> 
                                <li class="list-none mb-3">
                                    <a class="hover:opacity-75 text-md text-white font-thin {{ 
                                        (Route::currentRouteName() == 'shop') ? 'opacity-75' : 'text-white'
                                    }}" href="/shop">Shop</a>
                                </li>
                                    
                                <li class="list-none">
                                        <a  href="{{ route('logout') }}" class="hover:opacity-75 mr-3  text-md font-thin text-white" 
                                        onclick="
                                            event.preventDefault();
                                            if(confirm('Are you sure?'))
                                            {
                                                document.getElementById('logout-form').submit();
                                            }
                                        ">
                                            
                                            Logout
                                        </a>
                                </li>
                                
                                
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    {{ csrf_field() }}
                                </form>
                                    
                                @endauth

                                
                        </ul>
                    </div>
                    @endauth

                </div>
            </div>

            <!-- Small Screen Search -->
            <form id="search" class="mb-4 md:hidden w-full px-6" method="GET" action="/shop">
                @csrf
                <div class="flex relative  w-full">
                    
                    <div class="absolute left-0 top-0 mt-2 ml-4 text-purple-lighter">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search w-6 h-6 text-gray-200"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                  
                    </div>
                    <input type="text" id="keyword" name="keyword" 
                        value="{{ request()->keyword }}" class="  rounded-lg w-full  border border-gray-300 pl-12 py-2 pr-3" placeholder="Search by name...">
                </div>
                  
            </form>
        </header>
       
        <!-- Content -->
        <div class="font-sans text-gray-900 antialiased">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer id="footer" class="bg-white ">
     
            <div  class=" flex flex-col px-6 py-6">
                <!-- Social Medias -->
                <div class="flex flex-col md:flex-row items-center justify-center mb-4">
                    <h2 class="mb-3 md:mb-0 md:mr-6 text-xl font-bold">
                        REACH US ON
                    </h2>
                        <ul class="m-0 flex items-center">
                            <a href="https:://twitch.com" class="bg-gray-300  rounded-full hover:opacity-60 p-3 mr-4 ">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter w-6 h-6 text-gray-900"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                            </a>
                            <a href="https:://facebook.com" class="bg-gray-300  rounded-full hover:opacity-60 p-3 mr-4 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" ><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                            </a>
                            <a href="https:://instagram.com" class="bg-gray-300  rounded-full hover:opacity-60 p-3 mr-4 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" ><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                            </a>
                        </ul>
                </div>

                <!-- Menus -->
                <ul class="m-0 flex flex-col md:flex-row md:justify-center my-6 md:items-center">
                    <li class="list-none mb-3 md:mb-0">
                        <a href="/" 
                            class="mr-4 text-lg mr-3 text-gray-900 border-b border-transparent hover:border-gray-900
                            {{ Route::currentRouteName() == 'welcome' ? 'border-b border-gray-900' : ''}}"
                            >
                            Home
                        </a>
                    </li>
                    <li class="list-none mb-3 md:mb-0">
                        <a href="/shop" 
                            class="mr-4 text-lg mr-3 text-gray-900 border-b border-transparent hover:border-gray-900
                            {{ Route::currentRouteName() == 'shop' ? 'border-b border-gray-900' : ''}}
                            ">
                            Shop
                        </a>
                    </li>
                    <li class="list-none mb-3 md:mb-0">
                        <a href="/dashboard" 
                            class="mr-4 text-lg mr-3 text-gray-900 border-b border-transparent hover:border-gray-900
                            {{ Route::currentRouteName() == 'dashboard' ? 'border-b border-gray-900' : ''}}
                            ">
                            My Account
                        </a>
                    <li class="list-none mb-3 md:mb-0">
                        <a href="/faqs#about-us" class="mr-4 text-lg mr-3 text-gray-900 border-b border-transparent hover:border-gray-900">
                            About Us
                        </a>
                    </li>
                    <li class="list-none mb-3 md:mb-0">
                        <a href="/faqs#shipping" class="mr-4 text-lg mr-3 text-gray-900 border-b border-transparent hover:border-gray-900">
                            Shipping & Delivery
                        </a>
                    </li>
                    <li class="list-none mb-3 md:mb-0">
                        <a href="/faqs#privacy" class="mr-4 text-lg mr-3 text-gray-900 border-b border-transparent hover:border-gray-900">
                            Privacy Policy
                        </a>
                    </li>
                    <li class="list-none mb-3 md:mb-0">
                        <a href="/faqs" 
                            class="mr-4 text-lg mr-3 text-gray-900 border-b border-transparent hover:border-gray-900
                            {{ Route::currentRouteName() == 'faqs' ? 'border-b border-gray-900' : ''}}

                            ">
                            FAQs
                        </a>
                    </li>

                </ul>

                <!-- Copyright  & Links -->
                
                <hr class="text-gray-900 w-full my-5 text-c-lighter-black">
        
                <div class="flex justify-center items-center 
                     ">
                    <div class="mr-3">
                        <span class="text-gray-900 text-xs text-c-light-gray">&copy; 2020 All Right Reserved.</span>
                    </div>

                    <a data-scroll href="#header" class="cursor-pointer">
                        <svg class="h-8 w-8 p-2 text-white font-semibold bg-gray-900 hover:bg-gray-900 rounded-full" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9 3.828L2.929 9.899 1.515 8.485 10 0l.707.707 7.778 7.778-1.414 1.414L11 3.828V20H9V3.828z" /></svg>
                    </a>
                   
                </div>
            </div>

        </footer>

        <!-- Scripts -->
        <script src="{{ asset('js/smooth-scroll.polyfill.min.js') }}"></script>
        @livewireScripts
        @stack('scripts')
        <script>
        
            document.addEventListener('DOMContentLoaded', function(){
                const observer = window.lozad();
                observer.observe();
                var scroll = new SmoothScroll('a[href*="#"]',{
                    speed: 400
                });



            });
        </script>
    </body>
</html>

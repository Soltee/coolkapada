<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="shortcut icon" type="image/jpg" href="/img/ck_logo.svg"/>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.9.0/dist/cdn.min.js" ></script>
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
                        <svg class="h-10" viewBox="0 0 97 22">
                          <defs>
                            <style>
                              .cls-1 {
                                fill: #f86f15;
                                font-size: 20px;
                                font-family: AdobeArabic-Bold, Adobe Arabic;
                                font-weight: 700;
                              }

                              .cls-2, .cls-3 {
                                fill: none;
                                stroke: #f86f15;
                              }

                              .cls-3 {
                                stroke-linecap: round;
                                stroke-linejoin: round;
                              }
                            </style>
                          </defs>
                          <g id="CC" transform="translate(-611 -86)">
                            <text id="coolkapada" class="cls-1" transform="translate(638 101)"><tspan x="0" y="0">coolkapada</tspan></text>
                            <g id="Symbol_1_1" data-name="Symbol 1 – 1" transform="translate(-437.5 -303.5)">
                              <line id="Line_1" data-name="Line 1" class="cls-2" y2="12" transform="translate(1071.5 394.5)"/>
                            </g>
                            <g id="shopping-cart" transform="translate(610 87)">
                              <circle id="Ellipse_14" data-name="Ellipse 14" class="cls-3" cx="1" cy="1" r="1" transform="translate(6.5 17.5)"/>
                              <circle id="Ellipse_15" data-name="Ellipse 15" class="cls-3" cx="1" cy="1" r="1" transform="translate(13.5 17.5)"/>
                              <path id="Path_29" data-name="Path 29" class="cls-3" d="M1.5,1.5h3l2,11c.145.792.254,1.015,1,1h8c.746.015.855-.208,1-1l1-7H4.5"/>
                            </g>
                          </g>
                        </svg>

                        {{-- <img 
                            
                            src="/img/ck_logo.svg" alt="Coolkapada Logo">
 --}}
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
                    x-data="{isOpenMenu:false}"
                    class="md:hidden">
                    <!-- Small Screen -->

                    <svg 
                        x-show.transition.50ms="isOpenMenu"
                        x-on:click="isOpenMenu = !isOpenMenu"
                        class="cursor-pointer block md:hidden h-6 w-6 hover:opacity-60 text-gray-900 object-cover object-center" fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" ><path d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    <svg 
                        x-show.transition.50ms="!isOpenMenu" 
                        x-on:click="isOpenMenu = !isOpenMenu"
                        class="cursor-pointer block md:hidden h-6 w-6 hover:opacity-60 text-gray-900 object-cover object-center" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                          <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                        </svg>

                    <div 
                        x-show.transition.50ms="isOpenMenu"
                        class="z-10 md:hidden absolute top-0 mt-12 right-0 bg-white w-48 px-6 py-6 rounded-tl rounded-bl">

                        @include('components.nav-menu')


                    </div>

                </div>
    
                @include('components.nav-menu')

            </div>

            <!-- Small Screen Search -->
            <form id="search" class="mb-3 md:hidden w-full px-6" method="GET" action="/shop">
                @csrf
                <div class="flex relative  w-full">
                    
                    <div class="absolute left-0 top-0 mt-1 ml-2 text-purple-lighter">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search w-6 h-6 text-gray-200"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                  
                    </div>
                    <input type="text" id="keyword" name="keyword" 
                        value="{{ request()->keyword }}" class="  rounded-lg w-full  border border-gray-300 pl-10 py-1 pr-3" placeholder="Search by name...">
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
                <div class="flex flex-col md:flex-row items-center justify-center">
                    <h2 class="mb-3 md:mb-0 md:mr-6 text-xl font-bold text-gray-900">
                        REACH US ON
                    </h2>
                        <ul class="m-0 flex items-center">
                            <a href="https:://twitch.com" class="border brder-transparent hover:border-gray-900  rounded-full  p-1 mr-4 ">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter w-6 h-6 text-gray-900"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                            </a>
                            <a href="https:://facebook.com" class="border border-transparent hover:border-gray-900  rounded-full p-1 mr-4 ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" ><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                            </a>
                            <a href="https:://instagram.com" class="border border-transparent hover:border-gray-900  rounded-full  p-1 mr-4 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" ><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                            </a>
                        </ul>
                </div>

                <!-- Menus -->
                <ul class="m-0 flex flex-col md:flex-row md:justify-center my-2 md:items-center">
                    <li class="list-none mb-3 md:mb-0">
                        <a href="/" 
                            class="mr-4 text-md mr-3 text-gray-900 border-b border-transparent hover:border-gray-900
                            {{ Route::currentRouteName() == 'welcome' ? 'border-b border-gray-900' : ''}}"
                            >
                            Home
                        </a>
                    </li>
                    <li class="list-none mb-3 md:mb-0">
                        <a href="/shop" 
                            class="mr-4 text-md mr-3 text-gray-900 border-b border-transparent hover:border-gray-900
                            {{ Route::currentRouteName() == 'shop' ? 'border-b border-gray-900' : ''}}
                            ">
                            Shop
                        </a>
                    </li>
                    <li class="list-none mb-3 md:mb-0">
                        <a href="/dashboard" 
                            class="mr-4 text-md mr-3 text-gray-900 border-b border-transparent hover:border-gray-900
                            {{ Route::currentRouteName() == 'dashboard' ? 'border-b border-gray-900' : ''}}
                            ">
                            My Account
                        </a>
                    <li class="list-none mb-3 md:mb-0">
                        <a href="/faqs#about-us" class="mr-4 text-md mr-3 text-gray-900 border-b border-transparent hover:border-gray-900">
                            About Us
                        </a>
                    </li>
                    <li class="list-none mb-3 md:mb-0">
                        <a href="/faqs#shipping" class="mr-4 text-md mr-3 text-gray-900 border-b border-transparent hover:border-gray-900">
                            Shipping & Delivery
                        </a>
                    </li>
                    <li class="list-none mb-3 md:mb-0">
                        <a href="/faqs#privacy" class="mr-4 text-md mr-3 text-gray-900 border-b border-transparent hover:border-gray-900">
                            Privacy Policy
                        </a>
                    </li>
                    <li class="list-none mb-3 md:mb-0">
                        <a href="/faqs" 
                            class="mr-4 text-md mr-3 text-gray-900 border-b border-transparent hover:border-gray-900
                            {{ Route::currentRouteName() == 'faqs' ? 'border-b border-gray-900' : ''}}

                            ">
                            FAQs
                        </a>
                    </li>

                </ul>

                <!-- Copyright  & Links -->
                
                <hr class="text-gray-900 w-full my-2 text-c-lighter-black">
        
                <div class="flex justify-center items-center 
                     ">
                    <div class="mr-3">
                        <span class="text-gray-900 text-xs text-c-light-gray">&copy; 2022 All Right Reserved.</span>
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

                console.log(document.getElementById("cartBox"))
                document.getElementById("cartIcon").addEventListener('mouseover' ,() => {
                    console.log("click")
                    document.getElementById('cartBox').classList.toggle("hidden")
                })




            });
        </script>
    </body>
</html>

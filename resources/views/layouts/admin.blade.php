<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        @yield('head')
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- Scripts -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

        <!-- Content -->
        @auth('admin')
            <div class="flex flex-col md:flex-row px-3 md:px-0 py-3 md:py-0">
                <!-- Navigation-->
                <div id="menus" class="fixed h-screen hidden md:block  left-0 top-0 px-6 py-6 md:py-6 bg-gray-900 z-10 md:z-0 md:px-3  flex flex-col w-full md:w-32">
                    
                    <li class="list-none mb-3">
                        <a class="text-white pr-3 text-lg    border-transparent hover:opacity-80 {{ Route::currentRouteName() == 'admin.dashboard' ? ' underline' : ''}}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                   
                    
                </div>
                <div class="w-32 hidden md:block"></div>

                <div class="md:ml-4 flex-1 px-3 py-3 md:py-6">
                    <nav class="mb-4">
                        <div class="flex items-center justify-between md:justify-end">
                            <svg
                               id="menuIcon"
                                xmlns="http://www.w3.org/2000/svg" class="md:hidden cursor-pointer w-8 h-8 text-blue-500 hover:opacity-75 " viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lgmenu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>


                            <div class="flex items-center text-right">
                                <div  x-data="{ lgmenu : false }" class="hidden md:block relative">
                                    <svg
                                        x-on:click="lgmenu = !lgmenu" 
                                        class="cursor-pointer w-8 h-8 text-gray-900 hover:opacity-75 ml-3 md:ml-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lgmenu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line>
                                    </svg>
                                        <ul 
                                            x-show.transition.50ms="lgmenu"
                                            class="absolute right-0 top-0 mt-12 bg-gray-900 right-0 m-0 flex flex-col items-start px-4 py-3 rounded w-40 z-30">
         
                                                <li class="list-none mb-3">
                                                    <a class="hover:underline text-md text-white font-thin" href="/">Back to Site</a>
                                                </li> 
                                                <li class="list-none mb-3">
                                                    <a class="hover:underline text-md text-white font-thin {{ 
                                                        (Route::currentRouteName() == 'admin.profile') ? 'underline' : 'text-white'
                                                    }}" href="/admin/profile">
                                                    Profile
                                                    </a>
                                                </li>
                                                
                                                <li class="list-none ">
                                                    <a href="{{ route('admin.logout') }}"
                                                        class="no-underline hover:underline text-md text-white"
                                                        onclick="event.preventDefault();
                                                            if(confirm('Are you sure?'))
                                                            {
                                                                document.getElementById('logout-form').submit();
                                                            }
                                                        ">
                                                            {{ __('Logout') }}
                                                        </a>

                                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
                                                        {{ csrf_field() }}
                                                    </form>

                                                </li>
                                        </ul>
                                </div>
                                
                                
                            </div>
                        </div>
                    </nav>

                    @yield('content')
                </div>

            </div>
        

        @else
            <div class="min-h-screen w-full">
                @yield('auth')
            </div>
        @endauth
        
        <!-- Scripts -->
        <script src="{{ asset('js/smooth-scroll.polyfill.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/iamdustan-smoothscroll/0.4.0/smoothscroll.min.js"></script>
        @stack('scripts')
        <script>
        
            document.addEventListener('DOMContentLoaded', function(){
                const observer = window.lozad();
                observer.observe();
                var scroll = new SmoothScroll('a[href*="#"]',{
                    speed: 400
                });



                const links = document.querySelectorAll(".page-header ul a");

                for (const link of links) {
                link.addEventListener("click", clickHandler);
                }

                function clickHandler(e) {
                e.preventDefault();
                const href = this.getAttribute("href");
                const offsetTop = document.querySelector(href).offsetTop;

                scroll({
                    top: offsetTop,
                    behavior: "smooth"
                });
                }


            });
        </script>
    </body>
</html>

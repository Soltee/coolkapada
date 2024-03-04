<div class="hidden md:block md:flex md:items-center">
    <li class="list-none mr-4 mb-3 md:mb-0">
        <a class="hover:font-bold text-md font-thin {{ 
            (Route::currentRouteName() == 'welcome') ? 'font-bold text-gray-900' : 'text-gray-900'
        }}" href="/">Home</a>
    </li> 
    <li class="list-none mr-4 mb-3 md:mb-0">
        <a class="hover:font-bold text-md font-thin {{ 
            (Route::currentRouteName() == 'shop') ? 'font-bold text-gray-900' : 'text-gray-900'
        }}" href="/shop">Shop</a>
    </li>
    
    <!-- Shopping Bag -->
    <livewire:customer.bag />

    @auth('customer')
           
        <div  x-data="{ lgmenu : false }" class="hidden md:block relative">
            <svg
                x-on:click="lgmenu = !lgmenu" 
                class="cursor-pointer w-6 h-6 text-gray-900 hover:opacity-60 ml-3 md:ml-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lgmenu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
                <ul 
                    x-on:click.away="lgmenu = false;"
                    x-show.transition.50ms="lgmenu"
                    class="absolute right-0 top-0 mt-12 bg-gray-900 right-0 m-0 flex flex-col items-start px-4 py-3 rounded w-auto z-30">

                        <li class="list-none mb-3 mb-3 md:mb-0">
                            <a class="hover:opacity-60 mr-3  text-md font-thin text-white {{ 
                                (Route::currentRouteName() == 'dashboard') ? 'opacity-60' : ''
                            }}" href="/dashboard">Dashboard</a>
                        </li> 
                        <li class="list-none ">
                                <a  href="{{ route('logout') }}" class="hover:opacity-60 mr-3  text-md font-thin text-white" 
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
                (Route::currentRouteName() == 'login') ? 'opacity-60' : ''
                }}" 
                href="{{ route('login') }}"
            >
                {{ __('ACCOUNT') }}
            </a>
        </li>

    @endauth

</div>


<!-- Small Screens Links-->
<div  x-data="{ menu : false }" class="md:hidden relative">
    <svg
        x-on:click="menu = !menu" 
        xmlns="http://www.w3.org/2000/svg" class="cursor-pointer w-8 h-8 text-gray-900 hover:opacity-60 " viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
    <ul 
        x-show.transition.50ms="menu"
        x-on:click.away="menu = false"
        class="md:hidden absolute right-0 top-0 mt-12 bg-gray-900 right-0 m-0 flex flex-col items-start  px-4 py-3 w-auto z-30 rounded">
        <!-- Mobile User Auth COntrol -->
        <li class="list-none mb-3">
                <a class="hover:opacity-60 text-md text-white font-thin {{ 
                    (Route::currentRouteName() == 'welcome') ? 'opacity-60' : 'text-white'
                }}" href="/">Home</a>
            </li> 
            <li class="list-none mb-3">
                <a class="hover:opacity-60 text-md text-white font-thin {{ 
                    (Route::currentRouteName() == 'shop') ? 'opacity-60' : 'text-white'
                }}" href="/shop">Shop</a>
            </li>

            <!-- Shopping Bag -->
            <livewire:customer.bag />

        @auth('customer')
            
            <li class="list-none mt-2 mb-3">
                <a class="hover:opacity-60 mr-3  text-md font-thin text-white {{ 
                    (Route::currentRouteName() == 'dashboard') ? 'opacity-60' : ''
                }}" href="/dashboard">Dashboard</a>
            </li> 

            <li class="list-none">
                    <a  href="{{ route('logout') }}" class="hover:opacity-60 mr-3  text-md font-thin text-white" 
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
                
        @else

        <li class="list-none">
            <a  
                class=" font-thin no-underline py-2 rounded-lg text-white {{ 
                (Route::currentRouteName() == 'login') ? 'opacity-60' : ''
                }}" 
                href="{{ route('login') }}"
            >
                {{ __('ACCOUNT') }}
            </a>
        </li>

        @endauth

            
    </ul>
</div>

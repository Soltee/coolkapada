@extends('layouts.app')
@section('head')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/tiny-slider.css">
    <style>
        .custom_radio input:checked + .radio_btn{border: 2px solid #347474;}
        .custom_radio2 input:checked + .radio_btn2{border: 2px solid #347474;}
        .imgBlock:hover img{opacity: 0.8; transform: scale(1.2);}

        #heroImage {
        /*clip-path: polygon(0 25%, 100% 0, 100% 100%, 0% 100%);*/
        }
        .tns-controls {display: hidden;}
        @media screen and (max-width: 620px){
        .tns-controls{
        display: block;
        position: absolute;
        right: 0;
        top: 0;
        display: flex;justify-content: flex-end;
        margin: 0 4px 0 0;
        }}
    </style>
@endsection

@section('content')   

    <div class="">

        <!-- Hero Section -->
        <div class="relative">
          <img data-src="/img/hero3.jpg" class="lozad h-96  object-cover object-top  w-full hero mt-3" alt="">

          <div class="absolute bottom-0 left-0 right-0 bg-gray-900 px-6 py-4 mt-12 max-w-lg mx-auto flex items-center rounded-tl rounded-tr">
            <p class="text-lg text-center text-white">
              With a vision to empower women, Coolkapada has been set up currently in Pokhara, providing various ranges of apparels and lingerie.
            </p>
          </div>
        </div>
        
        <!-- Latest Arrivals -->
        <div class="relative flex flex-col justify-between my-8 px-6 ">
          <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg text-gray-900 font-semibold  relative">New Arrivals</h3>
            <div class="">
              <a href="/shop" class="border-b border-gray-600 hover:border-black">View more</a>
            </div>
          </div>
            <div class="  
                arrivals hover:cursor-move           
              ">
              @forelse($new as $p)
                <div class="flex flex-col items-center">
                  <div 
	        					class="imgBlock relative w-full  cursor-pointer">
	        					<div class="overflow-hidden">
			        				<a class="" href="{{ route('product', $p->slug)}}">
				        				<img  class="w-full mb-5 rounded object-cover hover:opacity-70 shadow" src="{{ asset($p->image_url) }}" alt="{{ $p->slug }}">
				        			</a>
				        		</div>
			        			@if($p->prev_price)	        				
			        				<span class="bg-red-600 text-center rounded-lg text-white p-3 absolute top-0 right-0">{{ $p->price_level() }}% off</span>
			        			@endif
			        	

                </div>

                <a href="/product/{{ $p->slug }}">
                  <h4 class="text-md font-semibold mt-4 text-c-light-black">{{ $p->name }}</h4>
                </a>

                  <form method="POST" action="{{ route('bag.store') }}">
                      @csrf
                      <input type="text" class="hidden" name="generateId" value="{{ $p->id }}">
                 
                      {{-- <a href="/product/{{ $p->slug }}">
                        <img src="{{ asset($p->image_url) }}" class="w-full sm:48 md:h-56 first:h-64  object-cover rounded object-top hero hover:" alt="">
                      </a> --}}
                      

                      <!-- Colors & Sizes-->
                      <div class="w-full px-3  my-2 flex flex-col">
                        {{-- <h4 class="mb-2">Color</h4> --}}
                        <div class="flex flex-row items-center">
                          @forelse(explode(',', $p->colors) as $c)
        
                            <label  class="custom_radio relative flex flex-col">
                              <input class="hidden" type="radio"  
                              {{ ($loop->first) ? 'checked' : '' }} 
                              name="color" value="{{ $c }}">
                              <span  class="radio_btn mr-2 px-3 py-3 rounded-full  border-2 border-white text-gray-900 cursor-pointer" style="background-color: {{ $c }}"
                              >
                                
                              </span>
                              
                            </label>
                            
                          @empty
        
                          @endforelse
                        </div>							
                      </div>
                    
                      <div class="w-full  my-3 flex flex-col">
                        {{-- <h4 class="mb-2">Size</h4> --}}
                        <div class="flex flex-row items-center">
                          @forelse(explode(', ', $p->sizes) as $s)
        
                            <label  class="custom_radio2 relative flex flex-col">
                              <input class="hidden" type="radio"  
                              {{ ($loop->first) ? 'checked' : '' }}  
                              name="size" value="{{ $s }}">
                              <span  class="radio_btn2 mr-2 px-3 py-2 rounded-lg  border-2 border-white text-gray-900 cursor-pointer hover:border-gray-400"
                              >
                                {{ $s }}
                              </span>
                              
                            </label>
                            
                          @empty
        
                          @endforelse
                        </div>							
                      </div>

                      @if($p->qty > 1)
                        
                        <button type="submit" class="w-full my-4 px-8 py-4 rounded bg-gray-900 hover:opacity-75 text-white ">Add To Bag</button>
                          
                      @else
                        <button class="w-full my-4 px-8 py-4" >Out of Stock</button>
                      @endif
                
                  </form>
                
                </div>
              @empty
                  <p class="ext-lg text-gray-900 font-semibold text-center">No products yet.</p>

              @endforelse
            </div>
        </div>
       
        <!--- Newsletter -->
        <div class="mt-24 px-6  bg-gray-900">
            <div class="max-w-2xl mx-auto rounded py-8  md:px-6 flex flex-col items-center">
              <div class="flex flex-col mb-3 w-full">
                <h2 class="text-white z-20 text-xl md:text-2xl mb-2 font-bold">Join Our Newsletter</h2>
                <p class="text-md text-white">Latest news and updates in your inbox.</p>
              </div>

      
              <div class="mt-4 max-w-2xl w-full flex flex-row items-center justify-center">
                <input id="news_email" type="email"  class="focus:outline-none w-full bg-white rounded  px-3 py-3 pr-24 sm:mb-0 border"  placeholder="Enter your email" >
                <button id="news_btn" class="focus:outline-none w-40   bg-gray-900 hover:opacity-75 rounded uppercase text-white font-bold tracking-wide py-3 px-3 md:px-6 text-center cursor-pointer"
                  style="margin-left:-10.1rem;">Join Now</button>
             </div>
                
              </p>
            </div>

        </div>
        

    </div>
    
@endsection

@push('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function(){

        var slider2 = tns({
            container: '.arrivals',
            items: 1,
            responsive: {
            640: {
                edgePadding: 20,
                gutter: 12,
                items: 1
            },
            700: {
                // gutter: 30
            },
            900: {
                items: 2,
                gutter: 20
            },
            1200: {
                items: 3
            }
            },
            controls : false,
            // controlsPosition: top,
            controlsText : [
                '<svg class="w-8 h-8 md:hidden text-gray-900" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.05 9.293L6.343 10 12 15.657l1.414-1.414L9.172 10l4.242-4.243L12 4.343z"/></svg>', 
                '<svg class="w-8 h-8 md:hidden text-gray-900" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>'
            ],
            mouseDrag : true,
            arrowKeys: true
        });

        let news_email = document.getElementById('news_email');
        const news_btn = document.getElementById('news_btn');
        const messageOutput = document.getElementById('messageOutput');
        news_btn.addEventListener('click', (e) =>{
            // e.preventDefault();

            let formData = new FormData();

            formData.append('email', news_email.value);

            axios.post(`/newsletter`,
                formData,
                {
                    headers: {
                        'Content-Type': 'application/json',
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": document.head.querySelector('meta[name="csrf-token"]').content
                    }
                }
            ).then((res) => 
                { 
                    if(res.status === 201){
                        swal('Horray!', 'Your email has been aded to the list.', 'success');
                        news_email.value = '';
                    
                    } else {
                        swal("Oops!", "There was some server problem.Try again later.", "error");
                    } 

                }
            ).catch((error) => 
                {

                    let errors       = error.response.data.errors;    
                    if(errors){
                        if(errors.email){
                            swal("Oops!", `${errors.email[0]}`, "error");
                        }
                    }

            });
        });
    });

    </script>

@endpush
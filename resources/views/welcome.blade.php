@extends('layouts.app')
@section('head')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/tiny-slider.css">
    <style>
        .custom_radio input:hover + .radio_btn{border: 2px solid green;}
        .custom_radio input:checked + .radio_btn{border: 2px solid green;}
        .custom_radio2 input:checked + .radio_btn2{
          border: 2px solid rgb(17, 24, 39);
          background-color: rgb(17, 24, 39);
          color: #fff;
        }
        .hero {
            border-bottom-right-radius: 200px;
        }


        .womenwear-banner {

            border-bottom-left-radius: 200px;

        }
        .imgBlock:hover img{opacity: 0.7; }
        /* .tns-controls {display: hidden;} */
        .tns-controls{ text-align: center}

        .men-banner {
            transform: rotateY(180deg);
            border-bottom-left-radius: 200px;
        }
        #menwear-section {
            background-color: #C2D9AD;
            border-bottom-right-radius: 200px;
        }
    </style>
@endsection

@section('content')   

    <div class="">

        <!-- Hero Section -->
        <div class="relative flex flex-col items-start md:items-center ">
          <img data-src="/img/banner2.webp" class="lozad h-96  object-cover object-left  w-full hero " alt="">

          <!-- <div class="absolute bottom-0 left-0 right-0 bg-gray-900 px-8 py-8 max-w-xl mx-auto flex flex-col md:items-center rounded-tl rounded-tr">
            <h1 class="text-3xl md:text-4xl font-bold text-white uppercase">
              Express your Intention
            </h1>
            <p class=" font-medium text-lg md:justify-center md:text-center text-white">
              Wide varieties of clothes right at your doorstep.
            </p>
          </div> -->
        </div>
        
        <!-- Latest Arrivals -->
        <div class="relative flex flex-col justify-between my-8 px-6 ">
          <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg text-gray-900 font-semibold  relative">New Arrival</h3>
            <div class="">
              <a href="/shop" class="border-b border-gray-600 hover:border-black hover:opacity-70">View more</a>
            </div>
          </div>
            <div 
              class="  
                grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6
              ">
              @forelse($new as $product)
                <div class="flex flex-col mb-6 ">
                
                  <livewire:customer.product 
                    :p="$product->id" 
                    url="/"
                    :from="'welcome'"/>

                </div>
              @empty

                  <p class="ext-lg text-gray-900 font-semibold text-center">
                     Oops! We have low stocks right now.</p>

              @endforelse
            </div>
        </div>

        <div class="relative flex flex-col justify-between my-8 px-6 ">
            <div class="w-full">
                <img src="/img/banner1.webp" class="womenwear-banner w-full h-84 md:h-auto object-left object-cover " alt="">
            </div>
        </div>

        <!-- Men Wear Arrivals -->
        <div  class="relative flex flex-col justify-between my-12 px-6 ">
            <div class="flex flex-col md:flex-row">
           

            <div 
              class="w-full md:w-1/2  
                grid grid-cols-1 gap-6 md:h-screen
                overflow-y-auto 
              ">
              @forelse($new as $product)
                <div class="flex flex-col mb-6 md:h-auto">
                
                  <livewire:customer.product 
                    :p="$product->id" 
                    url="/"
                    :from="'welcome'"/>

                </div>
              @empty

                  <p class="ext-lg text-gray-900 font-semibold text-center">
                     Oops! We have low stocks right now.</p>

              @endforelse
            </div>

             <div id="menwear-section"  class="w-full md:w-1/2">
                <img src="/img/menwear.webp" class="men-banner h-screen   object-cover " alt="">
            </div>
        </div>

        </div>
       
        <!--- Newsletter -->
        <div class="mt-24 px-6  bg-gray-900 relative">
            <div class="w-full rounded py-12  md:px-6 flex flex-col items-left">
              <div class="flex flex-col mb-3 md:w-2/3">
                <h2 class="text-white z-20 text-xl md:text-4xl mb-2 font-bold">Join Our Newsletter</h2>
                <p class="text-md text-white">Latest news and updates in your inbox.</p>
              </div>

      
              <div class="mt-4 md:w-2/3 flex flex-row items-left justify-center">
                <input id="news_email" type="email"  class="focus:outline-none w-full bg-white rounded  px-3 py-4 pr-24 sm:mb-0 border"  placeholder="Enter your email" >
                <button id="news_btn" class="focus:outline-none w-40 my-2 mr-6 md:mr-12  bg-gray-900 hover:opacity-75 rounded uppercase text-white font-bold tracking-wide py-3 px-3 md:px-6 text-center cursor-pointer"
                  style="margin-left:-10.1rem;">Join Now</button>
             </div>
                
              </p>
            </div>

            <img src="/img/newsletter.png" class="h-80 hidden md:block  absolute right-10 bottom-0" />

        </div>
        

    </div>
    
@endsection

@push('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function(){
        
        //Newsletter
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
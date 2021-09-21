<div class="">
		<div class="flex justify-between md:justify-start items-center mb-2 w-full px-6 py-2">
			<a href="/shop"><h4 class="text-sm opacity-75 hover:opacity-100 font-light text-gray-900 mr-2">SHOP</h4></a>
			<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
			<a href="/bag">
			  <h4 class="text-sm opacity-75 hover:opacity-100 font-light text-gray-900 mr-2">BAG</h4>
			</a>
			<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
			<h4 class="text-md font-semibold text-gray-900 ">CHECKOUT</h4>        
		  
		</div>
  
		<div class="px-6 flex flex-col lg:flex-row justify-center my-4 w-full">

			<div class="w-full lg:w-1/2 md:mr-8">
				<form method="POST" action="{{ route('checkout.store') }}">   
					@csrf		

					<input id="total_amt" type="hidden" name="_amt" value="{{  $total }}">

						<div class="flex flex-col border border-lighter-black rounded-lg p-3 mb-4">
							<h3 class="mt-2 mb-3">
								<span class="mr-2 border px-3 py-2 border-gray-400 rounded-full text-md text-gray-900">1</span> 
								<span class="text-md text-gray-900 font-semibold">Personal Info</span>
							</h3>

							<div class="mt-5 mb-3">
								<div class="flex flex-col lg:flex-row items-center mb-4">
									<div class="w-full lg:w-1/2 lg:mr-2 flex flex-col mb-4 md:mb-0">
										<label for="first_name" class="mb-2 text-c-lighter-black text-sm">First name</label>
										@if($auth)
											<input type="text" name="first_name" value="{{ old('first_name') ?? $auth->first_name }}" class="px-6 py-3 rounded-lg border border-gray-300 @error('first_name') border-red-500  @enderror" placeholder="Shraddha">
										@else
											<input type="text" name="first_name" value="{{ old('first_name') ?? ''  }}" class="px-6 py-3 rounded-lg border border-gray-300 @error('first_name') border-red-500  @enderror" placeholder="Shraddha">

										@endif

										<div class="md:hidden mb-2  flex flex-col">
											@error('first_name')
												<p class="text-red-600">{{ $message }}</p>
											@enderror
										</div>
										
									</div>
									<div class="w-full lg:w-1/2  lg:ml-2 flex flex-col mt-4 md:mt-0">
										<label for="last_name" class="mb-2 text-c-lighter-black text-sm">Last name</label>
										@if($auth)

											<input type="text" name="last_name" value="{{ old('last_name') ?? $auth->last_name }}" class="px-6 py-3 rounded-lg border border-gray-300 @error('last_name') border-red-500  @enderror" placeholder="Shrestha">
										@else
											<input type="text" name="last_name" value="{{ old('last_name') ?? '' }}" class="px-6 py-3 rounded-lg border border-gray-300 @error('last_name') border-red-500  @enderror" placeholder="Shrestha">

										@endif

										<div class="md:hidden mb-2  flex flex-col">
											@error('last_name')
												<p class="text-red-600">{{ $message }}</p>
											@enderror
										</div>
									</div>
								</div>
								<div class="hidden md:block md:flex  md:flex-row md:items-center mb-6">
									<div class="md:w-1/2 md:mr-2 flex flex-col">
										@error('first_name')
											<p class="text-red-600">{{ $message }}</p>
										@enderror
									</div>
									<div class="md:hidden mb-2  flex flex-col">
										@error('last_name')
											<p class="text-red-600">{{ $message }}</p>
										@enderror
									</div>
								</div>
								<div class="flex flex-col mb-4">
									<label for="email" class="mb-2 text-c-lighter-black text-sm">Email</label>
									@if($auth)
										<input type="email" name="email" value="{{ old('email') ?? $auth->email }}" class="px-6 py-3 rounded-lg border border-gray-300 @error('email') border-red-500  @enderror" placeholder="shraddha@gmail.com">

									@else
										<input type="email" name="email" value="{{ old('email') ?? '' }}" class="px-6 py-3 rounded-lg border border-gray-300 @error('email') border-red-500  @enderror" placeholder="shraddha@gmail.com">

									@endif

									<div class="hidden md:block w-full mt-3">
										@error('email')
											<p class="text-red-600">{{ $message }}</p>
										@enderror
									</div>
								</div>
								<div class="flex flex-col mb-4">
									<label for="phone_number" class="mb-2 text-c-lighter-black text-sm">Phone number</label>
									<div class="flex items-center">
										<span class="p-3 w-16 border border-lighter-black rounded-lg w-auto">+977</span>
										<input type="number" name="phone_number"  value="{{ (old('phone_number')) ?? ''  }}" class="px-6 py-3 rounded-lg border w-48 border-lighter-black  @error('phone_number') border-red-500  @enderror" placeholder="980*******">
									</div>
									<div class=" w-full mt-3">
										@error('phone_number')
											<p class="text-red-600">{{ $message }}</p>
										@enderror

									</div>
								</div>
							</div>		    			
						</div>

						<div class="flex flex-col border border-lighter-black rounded-lg p-3 mb-4">
							<h3 class="mt-2 mb-3">
								<span class="mr-2 border px-3 py-2 border-gray-400 rounded-full text-md text-gray-900">2</span>
								<span class="text-md text-gray-900 font-semibold">Billing Info</span>
							</h3>

							<div class="mt-5 mb-3">
								<div class="mb-4 flex flex-col">
									<label for="city" class="mb-2 text-c-lighter-black text-sm">City</label>
									<select name="city" class="px-4 py-3 rounded-lg">
										<option class="" value="pokhara">Pokhara</option>
									</select>
								</div>
								<div class="box-content flex  flex-col lg:flex-row lg:items-center mb-4">
									<div class="lg:w-1/2 lg:mr-2 flex flex-col mb-4 lg:mb-0">
										<label for="street_address" class="mb-2 text-c-lighter-black text-sm">Full Street(Tol) Address</label>
										<input type="text" name="street_address" value="{{ old('street_address') ?? '' }}" class="px-6 py-3 rounded-lg border border-gray-300 @error('street_address') border-red-500  @enderror" placeholder="Birauta, 17 Smaj Ghar">
										<div class="md:hidden mb-2  flex flex-col">
											@error('street_address')
												<p class="text-red-600">{{ $message }}</p>
											@enderror
										</div>
									</div>
									<div class="lg:w-1/2  lg:ml-2 flex flex-col">
										<label for="house_number" class="mb-2 text-c-lighter-black text-sm">House Number</label>
										<input type="number" name="house_number" class="px-6 py-3 rounded-lg border border-gray-300 @error('house_number') border-red-500  @enderror" placeholder="4598" value="{{ old('house_number') ?? '' }}">	
										<div class="md:hidden mb-2  flex flex-col">
											@error('house_number')
												<p class="text-red-600">{{ $message }}</p>
											@enderror
										</div>
									</div>
								</div>

								<div class="hidden md:block md:flex  md:flex-row md:items-center mb-4">
									<div class="md:w-1/2 md:mr-2 flex flex-col">
										@error('street_address')
											<p class="text-red-600">{{ $message }}</p>
										@enderror
									</div>
									<div class="md:w-1/2 md:mr-2 flex flex-col">
										@error('house_number')
											<p class="text-red-600">{{ $message }}</p>
										@enderror
									</div>
								</div>
								
							</div>
				
						</div>

						<div  class=" flex flex-col border border-lighter-black rounded-lg p-3 mb-4">
							<h3 class="mt-2 mb-3">
								<span class="mr-2 border px-3 py-2 border-gray-400 rounded-full text-md text-gray-900">3</span> 
								<span class="text-md text-gray-900 font-semibold">Payment Info</span>
							</h3>

							<div class="mt-5 mb-2">
								<div class="flex flex-col">
									<label  class="custom_radio relative flex flex-col">
										<div class="radio_btn mr-2 px-5 py-3 rounded-lg  border text-gray-900 cursor-pointer hover:border-blue-500 flex items-center @error('payment_method') border-red-500  @enderror">
											<input 
												class="mr-3" 
												type="radio"
												checked  
												{{-- {{ old('payment_method') ? 'checked' : '' }}  --}}
												name="payment_method" value="cash-on-delivery">
										
											{{-- <svg xmlns="http://www.w3.org/2000/svg" class="rounded-full p-1 border svg   w-8 h-8  hover:text-green-600 mr-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> --}}
											<span class="text-md">Cash on Delivery</span>
										</div>
									</label>
									
									<!--Khalti-->
									<label id="payment-button"  class="mt-3 group custom_radio relative flex flex-col">
										<div class="radio_btn mr-2 px-5 py-3 rounded-lg  border hover:border-blue text-gray-900 cursor-pointer hover:border-blue-500 flex items-center @error('payment_method') border-red-500  @enderror">
											<input 
												class="mr-3" 
												type="radio"
												  
												name="payment_method" value="_khalti">
										
											<span class="text-md">Khalti Payment</span>
										</div>
									</label>

									<!-- khalti Payload -->
									<div id="khaltiPayload"></div>
									
									<!--- Khalti Model -->
									<div id="khaltiModel" class="hidden z-50 inset-0 fixed flex flex-col items-center justify-center">
										<div class="bg-gray-300 max-w-4xl flex flex-col rounded-lg px-4 py-4 shadow-lg" >
											<div class="flex justify-between items-end">
												<div class="item active " style=" cursor: pointer;">
													<img class="w-6 h-6" src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/icons/mywallet.svg" >
													<span class="font-bold">Khalti Wallet</span>
												</div>
												<img id="closeCross" src="{{ asset('/img/close.svg') }}" alt="" class="flex justify-end w-4 cursor-pointer h-4" >
											</div>
												
											<div>
											<!-- Initiation Form -->
											<div id="initiateConfirmForm">
												<div class="mt-3">
													<div class="flex flex-col mb-4">

														<label for="house_number" class="mb-2 text-c-lighter-black text-sm">Mobile Number <span class="text-red-600">*</span></label>
														<input id="customerNumber" type="number" name="house_number" class="px-6 py-2 rounded-lg border border-gray-300 " placeholder="9806678901" value="">	
														
													</div>
													<div class="flex flex-col">
														<label for="house_number" class="mb-2 text-c-lighter-black text-sm">Transaction Pin <span class="text-red-600">*</span></label>
														<input id="customerPin" type="number" name="house_number" class="px-6 py-2 rounded-lg border border-gray-300 " placeholder="1234" value="">	
													</div>

													<div class="hidden flex flex-col mb-4">
														<label for="house_number" class="mb-2 text-c-lighter-black text-sm">Confirmation Code <span class="text-red-600">*</span></label>
														<input id="confirmCode" type="number" name="house_number" class="px-6 py-2 rounded-lg border border-gray-300 " placeholder="9806678901" value="">
														
													</div>

													<div id="initiateConfirmFormBtn" class="px-6 py-2 mt-6 mb-1 mx-6 w-full rounded bg-gray-900 hover:opacity-75 text-white text-lg cursor-pointer">Send Now</div>

												</div>
											</div>

											
											</div>
										</div>
									</div>



								</div>
								
							</div>

						</div>
						
						<div id="payBtn" class="fixed z-20 bottom-0 left-0 right-0 px-6 md:px-0 w-full md:relative md:hidden  md:flex m mb-8 d:justify-end mb-4">
							<button  type="submit" class="px-10 py-4  w-full rounded bg-gray-900 hover:opacity-75 text-white text-lg cursor-pointer">Pay Now | Rs {{ $total }}</button>
						</div>
						<div  class="hidden md:block z-20 bottom-0 left-0 right-0 px-6 md:px-0 w-full md:relative md:static  md:flex m mb-8 d:justify-end mb-4">
							<button  type="submit" class="px-10 py-4 mx-6 w-full rounded bg-gray-900 hover:opacity-75 text-white text-lg cursor-pointer">Pay Now | Rs {{ $total }}</button>
						</div>
				</form>
				
			</div>
			
			<div class="w-full  lg:w-1/2  p-5 bg-gray-300 rounded">
				<div 
					x-data="{ cart : true }"
					class="mt-4">
					<div class="flex justify-between items-center mb-6">
						<h4 class="text-lg text-gray-800 ">Order Summary ( {{ \Cart::getTotalQuantity() }} )</h4>

						<svg
							x-on:click="cart = !cart" 
							xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-800 font-bold cursor-pointer" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
					</div>
					<div
						x-show.transition.50ms="cart" 
						class="mb-16">
					@forelse($cartCollection as $item)
						<div class="flex flex-col md:flex-row mb-5">

					<img  class="image rounded w-40 mr-3" src="{{ asset($item->attributes->image_url) }}" alt="{{ $item->attributes->image_url }}">

							<div class="flex flex-col my-4 md:w-1/2 ">
								<div class="flex flex-col items-start mb-3">
									<h3 class="flex flex-col text-gray-800 text-lg mb-4" >
										<span class=""> {{ $item->name }}</span> 
									</h3>
									<div class="flex items-center">
										<span class="text-sm text-gray-800 text-lg mr-5">{{ $item->quantity }}</span>
										<span class="text-xl font-bold text-gray-800">Rs {{ $item->quantity * $item->price }}</span>
									</div>
								</div>
								
									
							</div>
						</div>
					@empty
					@endforelse
					</div>


					<!-- Order Details -->
					<div class="flex flex-col border border-gray-400 rounded my-6">
						<div class="flex justify-between items-center mb-4 px-3 pt-3">
							<h5 class="text-gray-800 text-md">SubTotal</h5>
							<span class="text-gray-800 text-md">Rs {{ $sub }}</span>
						</div>
						<div class="flex justify-between items-center mb-4 px-3 ">
							<h5 class="text-gray-800 text-md">Discount</h5>
							<span class="text-gray-800 text-md">Rs 0</span>
						</div>
						<div class="flex justify-between items-center mb-4 px-3 ">
							<h5 class="text-gray-800 text-md">Shipping</h5>
							<span class="text-gray-800 text-md">Free</span>
						</div>
						<div class="flex justify-between items-center mb-4 border-t border-gray-400 pt-3 px-3">
							<h5 class="text-gray-800 text-lg">Grand Total</h5>
							<span class="text-gray-800 text-xl font-bold">Rs {{ $total }}</span>
						</div>
					</div>
				</div>
			
			</div>
		</div>
	</div>
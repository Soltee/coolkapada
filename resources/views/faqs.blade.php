@extends('layouts.app')
@section('content')   

    <div class="px-6  py-3 w-full max-w-3xl mx-auto">

        <!--  -->
        <div class="flex justify-between items-center mb-4 w-full">
            <div class="flex items-center">
              <a href="/"><h4 class="text-md opacity-75 hover:opacity-100 font-light text-gray-900 mr-2">HOME</h4></a>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
              <h4 class="text-lg font-bold text-gray-900 ">FAQs</h4>
            </div>
            
            <span class=" text-gray-900 ">
            </span>
        </div>


        <div class="flex flex-col ">
            
            <!-- About -->
            <div  id="about-us" class="mb-5 flex flex-col justify-center items-start">
                <h3 class="m-0  py-2 text-gray-900 font-black text-lg">About Us</h3>
                <div class="mt-2">
                    <p class="text-gray-800 font-md">
                        Cool Kapada is the Pokhara leading quick-to-market apparel and lifestyle brand. It has been accepted by many customers for quality and affordablilty.
                    </p>

                </div>
            </div>

            <!-- Shipping & Delivery -->
            <div id="shipping" class="mb-5 flex flex-col justify-center items-start">
                <h3 class="m-0  py-2 text-gray-900 font-black text-lg">Shipping & Delivery</h3>
                <div class="mt-2">
                    <p class="text-gray-800 font-md">
                        Currently, Our store only ships inside Pokhara Valley which is <strong>free of charge</strong> right at your doorstep. </p>

                    <p class="text-gray-800 font-md mt-2">
                        So, we encourge to <strong>fill the address and all other information correctly</strong>, because we are not liable for the errors made by the errors.
                    </p>
                    
                </div>
            </div>


            <!-- Refund / Cancellation / Return -->
            <div class="mb-5 flex flex-col justify-center items-start">
                <h3 class="m-0  py-2 text-gray-900 font-black text-lg">Return Policy</h3>
                <div class="mt-2">
                    <p class="text-gray-800 font-md mb-2" >
                        We encourage the Buyer to <strong>review the listing</strong> before making the purchase decision. In case Buyer orders a wrong item, Buyer shall not be entitled to any return/refund.
                    </p>

                </div>
            </div>

            <!-- DO not sell info -->
            <div id="donot-sell">
                <h3 class="m-0  py-2 text-gray-900 font-black text-lg">Do not sell My Info</h3>

                <div class="mt-2">
                    <p class="text-gray-800 font-md mb-2">

                        <strong>Access or update your account information.</strong> If you have registered for an account with us, you may review and update certain personal information in your account profile by logging into the account.
                    </p>
                    <p class="text-gray-800 font-md mb-2">

                        <strong>Opt out of marketing communications.</strong> You may opt out of marketing-related emails by following the opt-out or unsubscribe instructions located at the bottom of the email. You may continue to receive service-related and other non-marketing emails. If you receive marketing text messages from us, you may opt out of receiving further marketing text messages from us by replying STOP to our marketing message.
                    </p>

                    <p class="text-gray-800 font-md mb-2">

                        <strong>Cookies.</strong> Most browsers let you remove and/or stop accepting cookies from the websites you visit. To do this, follow the instructions in your browser’s settings. For more details, see the “Your Choices” section of our Cookie Policy.'</p>
                
                    <p class="text-gray-800 font-md mb-2">

                        <strong>Advertising Choices.</strong> You may opt-out of interest-based advertising. See the “Your Choices” section of our Cookie Policy for more information.
                    </p>
                    <p class="text-gray-800 font-md mb-2">

                        <strong>Do Not Track.</strong> Some Internet browsers may be configured to send “Do Not Track” signals to the online services that you visit. We currently do not respond to “Do Not Track” or similar signals. To find out more about “Do Not Track,” please visit http://www.allaboutdnt.com.
                    </p>
                    <p class="text-gray-800 font-md mb-2">

                        <strong>Privacy settings and location data.</strong> Users of our App can disable our access to their device’s precise geolocation in their mobile device settings.
                    </p>
                    <p class="text-gray-800 font-md mb-2">

                        Choosing not to share your personal information. If you do not provide information that we need to provide the Service, we may not be able to provide you with the Service or certain features. We will tell you what information you must provide to receive the Service when we request it.
                    </p>
                    <p class="text-gray-800 font-md mb-2">

                        <strong>Third-party platforms or social media networks.</strong> If you choose to create an account through or connect the Service with another third-party platform, you may have the ability to limit the information that we may obtain from the third-party at the time you log in to the Service using the third-party’s authentication service or otherwise connect your account. You may also be able to control your settings through the third-party’s platform or service after you have connected your accounts.
                    </p>
                </div>

            </div>

            <!-- Privacy Policy -->
            <div id="privacy" class="mb-5 flex flex-col justify-center items-start">
                <h3 class="m-0  py-2 text-gray-900 font-black text-lg">Privacy Policy</h3>
                <div class="mt-2">

                    <p class="text-gray-800 font-semibold ">
                        THIS AGREEMENT CONTAINS AN ARBITRATION AGREEMENT AND CLASS ACTION WAIVER THAT WAIVE YOUR RIGHT TO A COURT HEARING OR JURY TRIAL OR TO PARTICIPATE IN A CLASS ACTION. ARBITRATION IS MANDATORY AND THE EXCLUSIVE REMEDY FOR ANY AND ALL DISPUTES UNLESS SPECIFIED BELOW OR IF YOU OPT-OUT. YOU MUST REVIEW THIS DOCUMENT IN ITS ENTIRETY BEFORE ACCESSING, USING, OR BUYING ANY PRODUCT THROUGH THE WEBSITE.
                    </p>
                    <p class="text-gray-800 font-md mt-2">
                        All purchases made through the Website are subject to our acceptance. This means that we may refuse to accept or may cancel any transaction, in our sole discretion, and without liability to you or any third party. The Website does not permit orders from dealers, wholesalers, or other customers who intend to resell items offered on the Website. Fashion Nova expressly conditions its acceptance of your order on your agreement to these Terms, and to all additional terms and conditions that are provided to you on the Website that govern your purchase of certain Products. By ordering Products through the Website, you agree to provide true, accurate, current, and complete information. Fashion Nova reserves the right without prior notice to discontinue or change specifications and prices on Products offered on and outside of the site without incurring any obligation to you. Prices and availability are subject to change without prior notice, and Fashion Nova reserves the right to revoke any offer to correct any errors, inaccuracies, or omissions.

                    </p>

                    <h3 class="mt-5 font-bold">CHILDREN</h3>

                    <p class="text-gray-800 font-md mt-2">
                    The Service is not intended for use by children under 18 years of age, and we do not knowingly collect information about children under age 16 through the Service. If we learn that we have collected personal information of a child without the consent of the child’s parent or guardian as required by law, we will delete it.</p>


                </div>
            </div>


        </div>

        

    </div>
    
@endsection


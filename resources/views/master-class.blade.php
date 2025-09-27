@extends('layouts.app')
@extends('layouts.header')
@section('content')
<section class="py-12 ">
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

            <!-- Left Side - Image -->
            <div>
                <img src="{{ asset('images/2.jpg') }}"
                     alt="Remote Work Master Class"
                     class="rounded-xl  shadow-md  w-full h-60 object-cover">
            </div>

            <!-- Right Side - Content -->
            <div>
                <h2 class="text-3xl md:text-4xl font-semibold text-gray-800 mb-4" style="font-family: 'Times New Roman', serif;">
                   Financial Freedom Master Class
                </h2>

                <!-- Price -->
                  <div class="inline-block relative px-4 py-2">
  <!-- Date text -->
  <span class="relative z-10 text-xl font-bold text-gray-900">KES 3,000</span>

  <!-- Scratchy background layers -->
  <span class="absolute inset-0 -skew-x-12 bg-yellow-300 opacity-60"></span>
  <span class="absolute inset-0 skew-x-12 bg-yellow-400 opacity-50 translate-y-1"></span>
  <span class="absolute inset-0 rotate-3 bg-yellow-200 opacity-50 -translate-y-1"></span>
  <span class="absolute inset-0 -rotate-6 bg-yellow-300 opacity-40 translate-x-1"></span>
</div>
   <div class="inline-block relative px-4 py-2">
  <!-- Date text -->
  <span class="relative z-10 text-xl font-bold text-gray-900">Limited slots</span>

  <!-- Scratchy background layers -->
  <span class="absolute inset-0 -skew-x-12 bg-yellow-300 opacity-60"></span>
  <span class="absolute inset-0 skew-x-12 bg-yellow-400 opacity-50 translate-y-1"></span>
  <span class="absolute inset-0 rotate-3 bg-yellow-200 opacity-50 -translate-y-1"></span>
  <span class="absolute inset-0 -rotate-6 bg-yellow-300 opacity-40 translate-x-1"></span>
</div>


                <!-- Short Description -->
                <p class="text-lg text-gray-700 font-medium mb-4">
                    The session will be a richly immersive two-hour experience.
                </p>

                <!-- Full Description -->
                <p class="text-gray-600 leading-relaxed mb-6">
                   Ready to take control of your financial future? Join our exclusive Master Class designed for individuals and professionals looking to master wealth management, smart investing, and financial planning. Whether you’re starting your journey or aiming to refine your expertise, don’t miss this chance to gain practical strategies — register today!
                </p>

                <!-- Call to Action Button -->

            </div>
        </div>
    </div>
    <div class="max-w-6xl mx-auto px-6 lg:px-12 grid grid-cols-1 md:grid-cols-2 gap-12 items-start my-12 relative">
    
    <!-- Left Side - Service Details -->
    <div>
       
            <h2 class="text-3xl font-bold text-gray-900 mb-6 inline-block pb-2 relative">
  <span class=" border-b-4 border-yellow-700">What's in this</span> service
</h2>

<!-- Decorative icons container -->
<div class="relative inline-block ml-4 flex flex-col">
  <span class="block w-12 h-12 bg-yellow-300 rounded-lg mb-2"></span>
  <div class="flex">
    <span class="block w-8 h-8 bg-yellow-600 rounded-lg mr-2"></span>
    <span class="block w-8 h-8 bg-yellow-600 rounded-lg "></span>
  </div>
</div>

       
       
       
      

        <ul class="space-y-5 text-gray-700 list-disc list-inside marker:text-yellow-700">
            <li>
               Practical Budgeting.
            </li>
            <li>
                Setting & Achieving Financial Goals.
            </li>
            <li>
                Growing Your Income.
            </li>
            <li>
               Paying Off Debts & Mobile Loans.
            </li>
              <li>
               Wealth Creation & Passive Income.
            </li>
              <li>
             Saving & Investment Options.
            </li>
              <li>
             Free Budget Template.
            </li>
        </ul><br>
       <div class="relative inline-block ml-4 flex flex-col">
  <span class="block w-12 h-12 bg-yellow-300 rounded-lg mb-2"></span>
  <div class="flex">
    <span class="block w-8 h-8 bg-yellow-600 rounded-lg mr-2"></span>
    <span class="block w-8 h-8 bg-yellow-600 rounded-lg "></span>
  </div>
</div>
    </div>

    <!-- Right Side - Info & Purchase -->
    <div>
        <p class="text-gray-700 leading-relaxed mb-6">
           Whether you’re an experienced professional seeking to sharpen your financial strategies or someone eager to gain a strong foundation in money management, our Master Class is designed to equip you with the essential tools, insights, and practical guidance needed to build lasting wealth and financial confidence.
        </p>

        <!-- Purchase Button -->
        <a href="/purchase" 
           class="inline-block w-full text-center bg-gray-900 text-white font-semibold px-6 py-3 rounded-lg shadow hover:bg-gray-800 transition mb-6">
           Register Now
        </a>

        <!-- Disclaimer -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-sm text-gray-700 flex items-start">
            <span class="flex items-center justify-center w-6 h-6 bg-yellow-100 rounded-full mr-3 text-yellow-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
            <p>Please note that all payments for services are non-refundable once processed.</p>
        </div>
    </div>

</div>

</section>
@endsection

@extends('layouts.app')
@extends('layouts.header')
@section('content')
<section class="relative">
  <!-- Background -->
  <div class="absolute inset-0">
    <img src="{{ asset('images/texture1.jpg') }}" 
         alt="Financial Services" 
         class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black/40"></div> <!-- Overlay -->
  </div>

  <!-- Content Wrapper -->
  <div class="relative z-10 container mx-auto px-6 py-20 lg:py-32 flex flex-col items-center text-center">
    
    <!-- Heading -->
    <h2 class="text-5xl md:text-5x font-bold  text-black">
      Professional Financial Services
    </h2>

    <!-- Subtext -->
    <p class="mt-4 text-lg md:text-xl text-gray-700 max-w-2xl">
  We provide trusted financial solutions designed for <span class="font-semibold">Individuals</span>, 
  <span class="font-semibold">Businesses</span>, <span class="font-semibold">Companies</span>, and 
  <span class="font-semibold">Chamas</span> — helping you save, invest, and grow with confidence.
</p>


  </div>

  <!-- Bottom Wave -->
  <div class="absolute bottom-0 w-full overflow-hidden leading-none">
    <svg class="relative block w-full h-40" xmlns="http://www.w3.org/2000/svg" 
         viewBox="0 0 1440 320" preserveAspectRatio="none">
      <path fill="#f9f7f4" fill-opacity="1" 
            d="M0,256 C360,80 1080,400 1440,160 L1440,320 L0,320 Z">
      </path>
    </svg>
  </div>
</section>

<section  x-data="{ activeTab: 'individual-1' } ">
    <div class="max-w-7xl mx-auto ">
        

  <!-- Tabs -->
        <div class="grid grid-cols-4 mt-8 rounded-lg shadow overflow-hidden bg-white">
    <!-- Individual -->
    <button @click="activeTab = 'individual-1'" 
        :class="activeTab === 'individual-1' ? 'text-[#924c2e] border-b-2 border-[#924c2e]' : 'text-gray-600'" 
        class="flex items-center justify-center gap-2 py-4 font-semibold hover:bg-gray-50">
        <!-- User icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 1115 0v.75H4.5v-.75z" />
        </svg>
        Individual
    </button>

    <!-- Business -->
    <button @click="activeTab = 'business'" 
        :class="activeTab === 'business' ? 'text-[#924c2e] border-b-2 border-[#924c2e]' : 'text-gray-600'" 
        class="flex items-center justify-center gap-2 py-4 font-semibold hover:bg-gray-50">
        <!-- Briefcase icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 6V4.5a1.5 1.5 0 011.5-1.5h3A1.5 1.5 0 0115 4.5V6m6 0H3m18 0v12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18V6m18 0H3" />
        </svg>
        Business
    </button>

    <!-- Company -->
    <button @click="activeTab = 'company'" 
        :class="activeTab === 'company' ? 'text-[#924c2e] border-b-2 border-[#924c2e]' : 'text-gray-600'" 
        class="flex items-center justify-center gap-2 py-4 font-semibold hover:bg-gray-50">
        <!-- Office building icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21h18M5 21V9a2 2 0 012-2h2a2 2 0 012 2v12M13 21V5a2 2 0 012-2h2a2 2 0 012 2v16" />
        </svg>
        Company
    </button>

    <!-- Chama -->
    <button @click="activeTab = 'chama'" 
        :class="activeTab === 'chama' ? 'text-[#924c2e] border-b-2 border-[#924c2e]' : 'text-gray-600'" 
        class="flex items-center justify-center gap-2 py-4 font-semibold hover:bg-gray-50">
        <!-- Users group icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19a6 6 0 00-12 0M21 19a6 6 0 00-12 0M12 11a3 3 0 110-6 3 3 0 010 6zm6-3a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        Chama
    </button>
</div>


        <!-- Content -->
        <div class="mt-6  p-6 rounded-lg shadow">
            <!-- Individual -->
            <div x-show="activeTab === 'individual-1'">
            
               
            @include('partials.individual-1')
            </div>


            <!-- Business -->
            <div x-show="activeTab === 'business'">
                
                @include('partials.business')
            </div>

            <!-- Company -->
            <div x-show="activeTab === 'company'">
               
                @include('partials.company')
            </div>

            <!-- Chama -->
            <div x-show="activeTab === 'chama'">
               
                @include('partials.chama')
            </div>
        </div>
    </div>
</section>
@endsection
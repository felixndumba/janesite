@extends('layouts.app')
@extends('layouts.header')
<section class="py-12 bg-[#f9f7f4] pt-32" x-data="{ activeTab: 'individual-1' } " data-aos="zoom-in-right" data-aos-delay="200" data-aos-duration="1000">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Heading -->
        <h2 class="text-3xl font-bold text-[#924c2e] text-center">Professional Financial Services</h2>
        <p class="text-gray-600 mt-2 text-center">
            Comprehensive financial solutions tailored for individuals, businesses, and investment groups
        </p>

        <!-- Tabs -->
        <div class="grid grid-cols-4 mt-8 rounded-lg shadow overflow-hidden bg-white">
            <button @click="activeTab = 'individual-1'" 
                :class="activeTab === 'individual-1' ? 'text-[#924c2e] border-b-2 border-[#924c2e]' : 'text-gray-600'" 
                class="flex items-center justify-center gap-2 py-4 font-semibold hover:bg-gray-50">
                Individual
            </button>

            <button @click="activeTab = 'business'" 
                :class="activeTab === 'business' ? 'text-[#924c2e] border-b-2 border-[#924c2e]' : 'text-gray-600'" 
                class="flex items-center justify-center gap-2 py-4 font-semibold hover:bg-gray-50">
                Business
            </button>

            <button @click="activeTab = 'company'" 
                :class="activeTab === 'company' ? 'text-[#924c2e] border-b-2 border-[#924c2e]' : 'text-gray-600'" 
                class="flex items-center justify-center gap-2 py-4 font-semibold hover:bg-gray-50">
                Company
            </button>

            <button @click="activeTab = 'chama'" 
                :class="activeTab === 'chama' ? 'text-[#924c2e] border-b-2 border-[#924c2e]' : 'text-gray-600'" 
                class="flex items-center justify-center gap-2 py-4 font-semibold hover:bg-gray-50">
                Chama
            </button>
        </div>

        <!-- Content -->
        <div class="mt-6 bg-white p-6 rounded-lg shadow">
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
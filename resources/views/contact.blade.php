@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center  py-12 px-4"
data-aos="zoom-in-left" data-aos-delay="400" data-aos-duration="1200">
    <div class="relative max-w-6xl ml-10 w-full   overflow-hidden grid grid-cols-1 md:grid-cols-2">

        <!-- Left Side: Image with Social Icons -->
        <div class="relative flex flex-col justify-between ">
            <img src="{{ asset('images/texture.jpg') }}" alt="Contact" class="w-full h-130 object-cover">

            <!-- Social Media Icons at bottom of image -->
           
        </div>

        <!-- Right Side: Contact Form (overlay style, taller than image) -->
        <div class="relative flex flex-col justify-center px-6 py-12">
            
            <!-- Creative Intro Message -->
     <div class="mb-6  p-5  ">
    <p class="font-[Figtree] text-lg text-gray-800 leading-relaxed tracking-wide mb-4">
        <i class="fas fa-comments text-blue-500 mr-2"></i>
        Connect with us today—we’re here to provide answers, guidance, and the support you or your business deserves.
    </p>

    <ul class="font-[Figtree] text-gray-700 space-y-3">
        <li>
            <i class="fas fa-envelope text-blue-500 mr-2"></i>
            <strong>Email:</strong> 
            <a href="mailto:janendichui@gmail.com" class="text-blue-600 hover:underline">
                janendichu@gmail.com
            </a>
        </li>
        <li>
            <i class="fas fa-phone text-blue-500 mr-2"></i>
            <strong>Call:</strong> 
            <span class="text-gray-800">+254 702 531 073</span> <!-- Replace with your real number -->
        </li>
    </ul>
</div>

@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif



            <!-- Contact Form Card -->
            <div class="relative lg:-ml-20 bg-blue-50 shadow-lg p-8 mt-1 w-full max-w-md mx-auto">

                
                <!-- Contact Title -->
                <h2 class="text-5xl font-bold text-gray-800 mb-6 text-center">Contact</h2>

                <!-- Form -->
                <form method="POST" action="{{ route('contact.send') }}" class="space-y-4">
                    @csrf
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">YOUR NAME  <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" required 
                            class="w-full p-3 border  focus:ring focus:ring-blue-300">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">YOUR EMAIL <span class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email" required 
                            class="w-full p-3 border  focus:ring focus:ring-blue-300">
                    </div>

                    <!-- Subject -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700">SUBJECT</label>
                        <input type="text" name="subject" id="subject" 
                            class="w-full p-3 border  focus:ring focus:ring-blue-300">
                    </div>

                    <!-- Message -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700">MESSAGE</label>
                        <textarea name="message" id="message" rows="5" required
                            class="w-full p-3 border  focus:ring focus:ring-blue-300"></textarea>
                    </div>

                    <!-- Submit -->
                    <div>
                        <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 transition">
                            SEND MESSAGE
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.header')

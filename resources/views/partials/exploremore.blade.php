<section class="relative w-full h-[400px] md:h-[500px] bg-gray-200"
data-aos="zoom-in-right" data-aos-delay="200" data-aos-duration="1000">
    <!-- Background Images -->
    <div class="absolute inset-0 flex">
        <!-- Left Image -->
        <div class="w-1/2">
            <img src="{{ asset('images/2.jpg') }}" 
                 alt="African Adventure Left" 
                 class="w-full h-full object-cover">
        </div>
        <!-- Right Image -->
        <div class="w-1/2">
            <img src="{{ asset('images/2.jpg') }}" 
                 alt="African Adventure Right" 
                 class="w-full h-full object-cover">
        </div>
    </div>

    <!-- Overlay with Middle Content -->
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="bg-[#a04f3f]/95 text-white px-10 py-12 rounded-xl text-center max-w-xl shadow-lg">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-4">
                Start Your Transformational Journey!
            </h2>
            <p class="mb-6 text-lg opacity-90">
                Discover clarity, confidence, and purpose with Jane’s personalized coaching.
            </p>
            <a href="{{ route('explore') }}" 
               class="inline-block bg-white text-[#a04f3f] font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-gray-100 transition-all">
                Explore More
            </a>
        </div>
    </div>
</section>

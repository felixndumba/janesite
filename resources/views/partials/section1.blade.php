<section 
   data-aos="zoom-in-left" data-aos-delay="400" data-aos-duration="1200"
    class="relative py-24 px-6 bg-cover bg-center" 
    style="background-image: url('{{ asset('images/.jpg') }}');"

>
    <!-- Gradient Overlay - Using #a04f3f with opacity to dim background image -->
    <div class="absolute inset-0 bg-gradient-to-r from-[#a04f3f]/90 via-[#a04f3f]/80 to-[#a04f3f]/70"></div>

    <!-- Content -->
    <div class="relative max-w-7xl mx-auto grid md:grid-cols-2 items-center gap-16">

        <!-- Left Content -->
        <div data-aos="zoom-in-right" data-aos-delay="200" data-aos-duration="1000">
            <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6 tracking-tight text-white">
                Guiding You to Financial<br><span class="text-white">Freedom & Growth</span>
            </h1>

            <p class="text-lg mb-8 leading-relaxed text-white">
                Discover the power of smart financial planning. With tailored advice and hands-on mentorship, we empower individuals and businesses to thrive.
            </p>
            <a href="{{ url('/contact') }}"
               class="inline-block bg-white text-black font-semibold px-8 py-3 rounded-full shadow-md hover:scale-105 hover:bg-gray-100 transition-all duration-300 ease-in-out">
                ENQUIRIES
            </a>
        </div>

        <!-- Right Image (Circular) -->
        <div class="flex justify-center" >
            <div class="relative w-80 h-80 md:w-96 md:h-96 overflow-hidden rounded-full shadow-xl border-[10px] border-[#f9f7f4]">
                <img src="{{ asset('images/.jpg') }}" alt="Hero Image" class="object-cover w-full h-full" />
            </div>
        </div>

    </div>
</section>

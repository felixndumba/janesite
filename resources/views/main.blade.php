@extends('layouts.app')
@extends('layouts.header')


@section('content')
<main >
    <!-- Hero Section -->
    <section class="  py-24 px-6">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 items-center gap-16">

            <!-- Left Content -->
            <div data-aos="zoom-in-right" data-aos-delay="200" data-aos-duration="1000">
                <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6 tracking-tight">
                    Guiding You to Financial<br><span class="text-black">Freedom & Growth</span>
                </h1>
                <p class="text-lg mb-8 text leading-relaxed">
                    Discover the power of smart financial planning. With tailored advice and hands-on mentorship, we empower individuals and businesses to thrive.
                </p>
                <a href="{{ url('/services') }}"
                   class="inline-block bg-[#8D3405] text-white font-semibold px-8 py-3 rounded-full shadow-md hover:scale-105 hover:bg-gray-100 transition-all duration-300 ease-in-out">
                    View Our Services
                </a>
            </div>

            <!-- Right Image -->
            <div class="flex justify-center" data-aos="zoom-in-left" data-aos-delay="400" data-aos-duration="1200">
                <div class="relative w-80 h-80 md:w-96 md:h-96 overflow-hidden rounded-full shadow-xl border-[10px] border-[#f8dab2]">
                    <img src="{{ asset('images/2.jpg') }}" alt="Hero Image" class="object-cover w-full h-full" />
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @php
            $defaultTitle = 'Thedi Advisors | Professional Financial Advisors';
            $defaultDescription = 'Thedi Advisors provides expert consulting and advisory services in Kenya. Build sustainable wealth with confidence.';

            $pageTitle = trim($__env->yieldContent('title'));
            $pageDescription = trim($__env->yieldContent('meta_description'));

            $finalTitle = $pageTitle !== '' ? $pageTitle : $defaultTitle;
            $finalDescription = $pageDescription !== '' ? $pageDescription : $defaultDescription;

            $canonicalUrl = trim($__env->yieldContent('canonical_url'));
            $canonicalHref = $canonicalUrl !== '' ? $canonicalUrl : url()->current();

            $ogImage = trim($__env->yieldContent('og_image'));
            $ogImageHref = $ogImage !== '' ? $ogImage : asset('images/jane1.jpg');
        @endphp

        <meta name="description" content="{{ $finalDescription }}">
        <link rel="canonical" href="{{ $canonicalHref }}">
        <title>{{ $finalTitle }}</title>


        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ $finalTitle }}">
        <meta property="og:description" content="{{ $finalDescription }}">
        <meta property="og:url" content="{{ $canonicalHref }}">
        <meta property="og:image" content="{{ $ogImageHref }}">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $finalTitle }}">
        <meta name="twitter:description" content="{{ $finalDescription }}">
        <meta name="twitter:image" content="{{ $ogImageHref }}">

        {{-- Basic SEO defaults --}}
        <meta name="robots" content="index,follow">

        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialias bg-[#f9f7f4]">

        @include('layouts.header')

                <!-- Page Heading -->
                @isset($header)
                        <div class="w-full mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="pt-24  pb-40 bg-[#f9f7f4]">
                   @yield('content')
                </main>
                 <footer class="bg-[#f9f7f4]" >
                @include('layouts.footer')
            </footer>


<a href="https://calendly.com/janendichu1/free_discovery_call"
   target="_blank"
   class="fixed bottom-20 right-6 bg-[#a04f3f] text-white font-semibold px-4 py-2 rounded-full shadow-lg hover:bg-[#8b3f30] transition-all z-50">
   Book a Free  Call
</a>


<a href="{{ route('services') }}"
   class="fixed bottom-6 right-6 bg-[#a04f3f] text-white font-semibold px-4 py-2 rounded-full shadow-lg hover:bg-[#8b3f30] transition-all z-50">
   View Our Services
</a>

@include('partials.paymentmodal')
@include('partials.paymentmodal1')
@include('partials.paymentmodal_delivery')

</body>
</html>


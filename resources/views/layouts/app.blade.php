<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'janendichu') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- AOS Library -->
       
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'], buildDirectory: true)


    </head>
    <body  class="bg-gray-50">

    <!-- Sidebar -->
   

    <body class="font-sans antialias bg-[#f9f7f4]">
        
                <!-- Page Heading -->
                @isset($header)
                    <header class="  shadow">
                       @include('layouts.header')

                        <div class="w-full mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="bg=bg-[#FFF8E7] pb-40">
                   @yield('content')
                </main>
                 <footer >
                @include('layouts.footer')
            </footer>
            </div>

            
        </div>
        <script>
    AOS.init({
        duration: 1200,
        once: true,
        mirror: true
    });
</script>
<a href="https://calendly.com/janendichu1/financial-planning"
   target="_blank"
   class="fixed bottom-20 right-6 bg-[#a04f3f] text-white font-semibold px-5 py-3 rounded-full shadow-lg hover:bg-[#8b3f30] transition-all z-50">
   Book a Free Discovery Call
</a>


<a href="{{ route('services') }}"
   class="fixed bottom-6 right-6 bg-[#a04f3f] text-white font-semibold px-5 py-3 rounded-full shadow-lg hover:bg-[#8b3f30] transition-all z-50">
   View Our Services
</a>

@include('partials.paymentmodal')


</body>

</div>

        
</html>

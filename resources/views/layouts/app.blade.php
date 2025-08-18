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

        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js']) 
       

    </head>
    <body class="font-sans antialias bg-[#f9f7f4]">
        <div class="min-h-screen  ">
           

            <!-- Page Heading -->
            @isset($header)
                <header class="  shadow">
                   @include('layouts.header')

                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div> 
                </header>
            @endisset

            <!-- Page Content -->
            <main class="bg=bg-[#FFF8E7]">
               @yield('content')
            </main>
            <footer>
                @include('layouts.footer')
            </footer>
        </div>
        <script>
    AOS.init({
        duration: 1200,
        once: true,
    });
</script>
<a href="#services"
   class="fixed bottom-6 right-6 bg-[#a04f3f] text-white font-semibold px-5 py-3 rounded-full shadow-lg hover:bg-[#8b3f30] transition-all z-50">
   View Our Services
</a>

@include('partials.paymentmodal')

        
</html>

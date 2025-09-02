<!-- Navbar & Menu -->
<div x-data="{ menuOpen: false }" class="relative z-100">

    <!-- Header Wrapper -->
    <header 
        class="fixed top-0 left-0 right-0 z-50 bg-[#f9f7f4] shadow-md border-b border-gray-100 transition-transform duration-700 ease-in-out origin-top-left"
    >
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-center h-24">

                <!-- Logo -->
                <div class="flex-shrink-0">
                    <img src="{{ asset('images/jnn.png') }}" alt="Logo" class="h-14 w-auto">
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-6 text-base font-semibold text-gray-800">
                    <a href="/" class="relative group block px-4 py-2 {{ request()->is('/') ? 'text-[#a04f3f]' : 'text-gray-800' }} hover:text-[#b25d4c]">
                        Home
                        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-[#a04f3f] transition-all duration-300 group-hover:w-full {{ request()->is('/') ? 'w-full' : '' }}"></span>
                    </a>
                    <a href="{{ url('/#about') }}" class="relative group block px-4 py-2 text-gray-800 hover:text-[#a04f3f]">
                        Meet Jane
                        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-[#a04f3f] transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{ route('services') }}" class="relative group block px-4 py-2 text-gray-800 hover:text-[#a04f3f]">
                        Services
                        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-[#a04f3f] transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{ url('/#partners') }}" class="relative group block px-4 py-2 text-gray-800 hover:text-[#a04f3f]">
                        Partners
                        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-[#a04f3f] transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{ url('/#faqs') }}" class="relative group block px-4 py-2 text-gray-800 hover:text-[#a04f3f]">
                        Faqs
                        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-[#a04f3f] transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{ url('/#reviews') }}" class="relative group block px-4 py-2 text-gray-800 hover:text-[#a04f3f]">
                        Reviews
                        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-[#a04f3f] transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="{{ route('contact') }}" class="relative group block px-4 py-2 {{ request()->routeIs('contact') ? 'text-[#a04f3f]' : 'text-gray-800' }} hover:text-[#a04f3f]">
                        Contact Me
                        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-[#a04f3f] transition-all duration-300 group-hover:w-full {{ request()->routeIs('contact') ? 'w-full' : '' }}"></span>
                    </a>
                </nav>

                <!-- Menu Button -->
                <button @click="menuOpen = !menuOpen" 
                        class="flex items-center space-x-2 text-gray-800 font-semibold focus:outline-none ml-4 z-50">
                    <span x-show="!menuOpen">Menu</span>
                    <span x-show="menuOpen" class="text-[#f58220] text-3xl font-bold">&times;</span>
                    <div x-show="!menuOpen" class="flex flex-col space-y-1">
                        <span class="block w-6 h-0.5 bg-gray-800"></span>
                        <span class="block w-6 h-0.5 bg-gray-800"></span>
                        <span class="block w-6 h-0.5 bg-gray-800"></span>
                    </div>
                </button>
            </div>
        </div>
    </header>

    <!-- Quick Links Overlay -->
    <div x-show="menuOpen"
         x-transition:enter="transition duration-500 ease-out"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition duration-300 ease-in"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed top-24 left-0 right-0 h-[65vh] bg-[#f9f7f4] z-50 flex flex-col items-start justify-start space-y-6 text-black text-xl font-semibold px-8 overflow-y-auto"
         style="backdrop-filter: none;">

        <a href="/" @click="menuOpen = false" class="w-full py-3 px-4 rounded hover:bg-[#b25d4c] hover:text-white {{ request()->is('/') ? 'bg-[#b25d4c] text-white' : '' }}">Home</a>
        <a href="{{ url('/#about') }}" @click="menuOpen = false" class="w-full py-3 px-4 rounded hover:bg-[#b25d4c] hover:text-white {{ request()->is('about') ? 'bg-[#b25d4c] text-white' : '' }}">Meet Jane</a>
        <a href="{{ route('services') }}" @click="menuOpen = false" class="w-full py-3 px-4 rounded hover:bg-[#b25d4c] hover:text-white {{ request()->routeIs('services') ? 'bg-[#b25d4c] text-white' : '' }}">Services</a>
        <a href="{{ url('/#partners') }}" @click="menuOpen = false" class="w-full py-3 px-4 rounded hover:bg-[#b25d4c] hover:text-white {{ request()->is('partners') ? 'bg-[#b25d4c] text-white' : '' }}">Partners</a>
        <a href="{{ url('/#faqs') }}" @click="menuOpen = false" class="w-full py-3 px-4 rounded hover:bg-[#b25d4c] hover:text-white {{ request()->is('faqs') ? 'bg-[#b25d4c] text-white' : '' }}">Faqs</a>
        <a href="{{ url('/#reviews') }}" @click="menuOpen = false" class="w-full py-3 px-4 rounded hover:bg-[#b25d4c] hover:text-white {{ request()->is('reviews') ? 'bg-[#b25d4c] text-white' : '' }}">Reviews</a>
        <a href="{{ route('contact') }}" @click="menuOpen = false" class="w-full py-3 px-4 rounded hover:bg-[#b25d4c] hover:text-white {{ request()->routeIs('contact') ? 'bg-[#b25d4c] text-white' : '' }}">Contact Me</a>
   
    </div>
</div>

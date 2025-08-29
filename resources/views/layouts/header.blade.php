<!-- Navbar & Menu -->
<div x-data="{ menuOpen: false }" class="relative z-50">

    <!-- Main Page Content Wrapper (tilts when menu opens) -->
    <div 
        :class="menuOpen 
            ? 'transform rotate-3 -translate-x-24 translate-y-12 scale-95 transition-transform duration-700 ease-in-out' 
            : 'transform transition-transform duration-700 ease-in-out'"
        class="relative z-30 bg-white"
    >
        <!-- Navbar -->
        <div class="fixed top-0 left-0 right-0 z-50 bg-[#f9f7f4] shadow-md border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex justify-between items-center h-24">

                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <img src="{{ asset('images/jnn.png') }}" alt="Logo" class="h-14 w-auto">
                    </div>

                    <!-- Desktop Navigation -->
                   <!-- Desktop Navigation -->
<nav class="hidden md:flex items-center space-x-6 text-base font-semibold text-gray-800">
    <a href="/" 
       class="relative group {{ request()->is('/') ? 'text-[#a04f3f]' : 'text-gray-800' }} hover:text-[#b25d4c]">
        Home
        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-[#a04f3f] transition-all duration-300 group-hover:w-full {{ request()->is('/') ? 'w-full' : '' }}"></span>
    </a>
    <a href="#about" 
       class="relative group text-gray-800 hover:text-[#a04f3f]">
        Meet Jane
        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-[#a04f3f] transition-all duration-300 group-hover:w-full"></span>
    </a>
    <a href="#services" 
       class="relative group text-gray-800 hover:text-[#a04f3f]">
        Services
        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-[#a04f3f] transition-all duration-300 group-hover:w-full"></span>
    </a>
    <a href="#partners" 
       class="relative group text-gray-800 hover:text-[#a04f3f]">
        Partners
        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-[#a04f3f] transition-all duration-300 group-hover:w-full"></span>
    </a>
    <a href="#faqs" 
       class="relative group text-gray-800 hover:text-[#a04f3f]">
        Faqs
        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-[#a04f3f] transition-all duration-300 group-hover:w-full"></span>
    </a>
    <a href="#reviews" 
       class="relative group text-gray-800 hover:text-[#a04f3f]">
        Reviews
        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-[#a04f3f] transition-all duration-300 group-hover:w-full"></span>
    </a>
    <a href="{{ route('contact') }}" 
       class="relative group {{ request()->routeIs('contact') ? 'text-[#a04f3f]' : 'text-gray-800' }} hover:text-[#a04f3f]">
        Contact Me
        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-[#a04f3f] transition-all duration-300 group-hover:w-full {{ request()->routeIs('contact') ? 'w-full' : '' }}"></span>
    </a>
</nav>

                    <!-- Menu Button -->
                    <button @click="menuOpen = !menuOpen" 
                            class="flex items-center space-x-2 text-gray-800 font-semibold focus:outline-none ml-4 z-50">
                        <span>Menu</span>
                        <div class="flex flex-col space-y-1">
                            <span class="block w-6 h-0.5 bg-gray-800"></span>
                            <span class="block w-6 h-0.5 bg-gray-800"></span>
                            <span class="block w-6 h-0.5 bg-gray-800"></span>
                        </div>
                    </button>
                </div>
            </div>
        </div>


    </div>

    <!-- Overlay Side Menu -->
    <div 
        x-show="menuOpen" 
        x-transition:enter="transition duration-500 ease-out"
        x-transition:enter-start="opacity-0 -translate-x-full"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition duration-300 ease-in"
        x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 -translate-x-full"
        class="fixed inset-y-0 left-0 w-2/3 md:w-1/3 bg-white shadow-2xl z-40 flex flex-col items-start justify-center space-y-6 px-12 text-2xl font-bold text-gray-800"
    >
        <a href="{{ route('contact') }}" @click="menuOpen=false">Contact Me</a>
        <a href="#reviews" @click="menuOpen=false">Reviews</a>
        <a href="#faqs" @click="menuOpen=false">Faqs</a>
        <a href="#partners" @click="menuOpen=false">Partners</a>
        <a href="#services" @click="menuOpen=false">Services</a>
        <a href="#about" @click="menuOpen=false">Meet Jane</a>
        <a href="/" @click="menuOpen=false">Home</a>
    </div>

</div>

<!-- Alpine.js -->
<script src="//unpkg.com/alpinejs" defer></script>

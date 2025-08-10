<footer class=" text-gray-700 border-t pt-10">
    <div class="max-w-7xl mx-auto px-6 md:px-10 grid grid-cols-1 md:grid-cols-4 gap-10">
        <!-- Logo & Message -->
        <div>
            <div class="flex items-center space-x-3 mb-4">
                <img src="{{ asset('images/jane20.jpg') }}" alt="Logo" class="w-12 h-12 object-contain rounded-full">
                <span class="text-xl font-bold text-[#a04f3f]">Financial Advisor</span>
            </div>
            <p class="text-sm text-gray-600">
                Empowering individuals and businesses across Kenya with expert financial strategies and personalized support. Your growth, our goal.
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h3 class="text-md font-semibold text-[#a04f3f] mb-3">Quick Links</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="/" class="hover:text-[#a04f3f]">Home</a></li>
                <li><a href="/services" class="hover:text-[#a04f3f]">Services</a></li>
                <li><a href="/about" class="hover:text-[#a04f3f]">About</a></li>
                <li><a href="/contact" class="hover:text-[#a04f3f]">Contact</a></li>
            </ul>
        </div>

        <!-- Contact Info -->
        <div>
            <h3 class="text-md font-semibold text-[#a04f3f] mb-3">Contact Us</h3>
            <ul class="text-sm space-y-2">
                <li>Email: <a href="mailto:info@janeadvisory.com" class="hover:text-[#a04f3f]">info@janeadvisory.com</a></li>
                <li>Phone: <a href="tel:+254712345678" class="hover:text-[#a04f3f]">+254 702531073</a></li>
                <li>Location: Nairobi, Kenya</li>
            </ul>
        </div>

        <!-- Social Media -->
        <div>
            <h3 class="text-md font-semibold text-[#a04f3f] mb-3">Follow Me on Social</h3>
            <div class="flex space-x-4 text-[#a04f3f] text-xl">
                
                
               
                <a href="#"><i class="fab fa-instagram hover:text-[#6b3b31] transition"></i></a>
                 <a href="#"><i class="fab fa-tiktok hover:text-[#6b3b31] transition"></i></a>
                 <a href="#"><i class="fab fa-linkedin hover:text-[#6b3b31] transition"></i></a>
            </div>
        </div>
    </div>

    <!-- Bottom -->
    <div class="mt-10 border-t text-center text-sm py-6 text-gray-500">
        © {{ now()->year }} Jane Ndichu. All rights reserved.
        Powered by feltechnologies.
    </div>
</footer>

@extends('layouts.app')
@extends('layouts.header')
<div class="relative  text-grey/20">
    <!-- Background Image with Gradient Overlay -->
   <div class="absolute inset-0">
    <!-- Background Image with blur -->
    <img src="{{ asset('images/texture.jpg') }}" 
         alt="Financial Advisory" 
         class="w-full h-full object-cover ">
</div>
    <!-- Content Wrapper -->
    <div class="relative z-10 container mx-auto px-6 py-20 lg:py-32 flex flex-col lg:flex-row items-center">
        <!-- Text Section -->
        <div class="lg:w-1/2 text-center lg:text-left">
            <span class="uppercase tracking-wider text-grey/20 font-semibold">Smart Finance & Solutions</span>
            <h1 class="mt-4 text-4xl lg:text-5xl font-extrabold leading-tight">
                Secure Your Future <br> With Our Financial Solutions
            </h1>
            <p class="mt-6 text-lg text-grey/20 max-w-lg">
                From Money Market to Pension, Education Schemes, and Medical Plans – 
                we help you plan, invest, and grow your wealth with confidence. 
            </p>

            <!-- Buttons -->
            <div class="mt-8 flex justify-center lg:justify-start gap-4">
                <a href="{{ url('/contact') }}"
               class="inline-block bg-transparent text-black font-semibold px-8 py-3 rounded-lg shadow-md  transition-all duration-300 ease-in-out">
                Enquires
            </a>
                
            </div>
        </div>

       
    </div>

    <!-- Bottom Meander Curve -->
  <div class="absolute bottom-0 w-full overflow-hidden leading-none">
    <svg class="relative block w-full h-40" xmlns="http://www.w3.org/2000/svg" 
         viewBox="0 0 1440 320" preserveAspectRatio="none">
        <path fill="#f9f7f4" fill-opacity="1" 
              d="M0,256 
                 C360,80 1080,400 1440,160 
                 L1440,320 L0,320 Z">
        </path>
    </svg>
</div>



</div>

<!-- SAVINGS & INVESTMENTS -->
<section class="bg-[#f9f7f4] py-16 px-6 lg:px-20">
  <div class="max-w-6xl mx-auto">
    <h2 class="text-3xl font-extrabold text-[#a04f3f]"><Span class="border-b-4 border-yellow-700">Savings & Investments</Span></h2>
    <p class="mt-2 text-gray-600 max-w-2xl">
      Build long-term wealth and secure your financial future with our flexible savings and investment solutions.
    </p>

    <!-- Card Grid -->
    <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Unit Trusts -->
      <div class="bg-white rounded-xl shadow-md p-6 flex flex-col justify-between">
        <div>
          <h3 class="text-xl font-semibold text-[#a04f3f]">Unit Trusts</h3>
          <p class="mt-2 text-gray-600">Money Market & Balanced Funds to help you grow steadily.</p>
        </div>
        <div class="mt-4">
          <a href="{{ url('/checkout/unit-trusts') }}" 
             class="inline-block px-4 py-2 bg-[#a04f3f] text-white rounded-lg shadow hover:bg-[#823c32] transition">
            Select
          </a>
        </div>
      </div>

      <!-- Pension Fund -->
      <div class="bg-white rounded-xl shadow-md p-6 flex flex-col justify-between">
        <div>
          <h3 class="text-xl font-semibold text-[#a04f3f]">Pension Fund</h3>
          <p class="mt-2 text-gray-600">Plan for retirement with security and confidence.</p>
        </div>
        <div class="mt-4">
          <a href="{{ url('/checkout/pension') }}" class="inline-block px-4 py-2 bg-[#a04f3f] text-white rounded-lg shadow hover:bg-[#823c32] transition">Select</a>
        </div>
      </div>

      <!-- NSSF Tier 2 -->
      <div class="bg-white rounded-xl shadow-md p-6 flex flex-col justify-between">
        <div>
          <h3 class="text-xl font-semibold text-[#a04f3f]">NSSF Tier 2</h3>
          <p class="mt-2 text-gray-600">Supplementary retirement savings for a stronger future.</p>
        </div>
        <div class="mt-4">
          <a href="{{ url('/checkout/nssf-tier2') }}" class="inline-block px-4 py-2 bg-[#a04f3f] text-white rounded-lg shadow hover:bg-[#823c32] transition">Select</a>
        </div>
      </div>

      <!-- Annuities & Income Drawdown -->
      <div class="bg-white rounded-xl shadow-md p-6 flex flex-col justify-between">
        <div>
          <h3 class="text-xl font-semibold text-[#a04f3f]">Annuities & Income Drawdown</h3>
          <p class="mt-2 text-gray-600">Reliable retirement income solutions that last a lifetime.</p>
        </div>
        <div class="mt-4">
          <a href="{{ url('/checkout/annuities') }}" class="inline-block px-4 py-2 bg-[#a04f3f] text-white rounded-lg shadow hover:bg-[#823c32] transition">Select</a>
        </div>
      </div>

      <!-- Endowment Plans -->
      <div class="bg-white rounded-xl shadow-md p-6 flex flex-col justify-between">
        <div>
          <h3 class="text-xl font-semibold text-[#a04f3f]">Endowment Plans</h3>
          <p class="mt-2 text-gray-600">Save while ensuring protection and future benefits.</p>
        </div>
        <div class="mt-4">
          <a href="{{ url('/checkout/endowment') }}" class="inline-block px-4 py-2 bg-[#a04f3f] text-white rounded-lg shadow hover:bg-[#823c32] transition">Select</a>
        </div>
      </div>

      <!-- Education Funds -->
      <div class="bg-white rounded-xl shadow-md p-6 flex flex-col justify-between">
        <div>
          <h3 class="text-xl font-semibold text-[#a04f3f]">Education Funds</h3>
          <p class="mt-2 text-gray-600">Secure your child’s academic future with structured savings.</p>
        </div>
        <div class="mt-4">
          <a href="{{ url('/checkout/education') }}" class="inline-block px-4 py-2 bg-[#a04f3f] text-white rounded-lg shadow hover:bg-[#823c32] transition">Select</a>
        </div>
      </div>

      <!-- Balanced Funds -->
      <div class="bg-white rounded-xl shadow-md p-6 flex flex-col justify-between">
        <div>
          <h3 class="text-xl font-semibold text-[#a04f3f]">Balanced Funds</h3>
          <p class="mt-2 text-gray-600">Diversified portfolio balancing growth and security.</p>
        </div>
        <div class="mt-4">
          <a href="{{ url('/checkout/balanced') }}" class="inline-block px-4 py-2 bg-[#a04f3f] text-white rounded-lg shadow hover:bg-[#823c32] transition">Select</a>
        </div>
      </div>

      <!-- Fixed Fund -->
      <div class="bg-white rounded-xl shadow-md p-6 flex flex-col justify-between">
        <div>
          <h3 class="text-xl font-semibold text-[#a04f3f]">Fixed Fund</h3>
          <p class="mt-2 text-gray-600">Low-risk investments with consistent returns.</p>
        </div>
        <div class="mt-4">
          <a href="{{ url('/checkout/fixed-fund') }}" class="inline-block px-4 py-2 bg-[#a04f3f] text-white rounded-lg shadow hover:bg-[#823c32] transition">Select</a>
        </div>
      </div>

      <!-- Mansa X -->
      <div class="bg-white rounded-xl shadow-md p-6 flex flex-col justify-between">
        <div>
          <h3 class="text-xl font-semibold text-[#a04f3f]">Mansa X</h3>
          <p class="mt-2 text-gray-600">Innovative investment platform for modern investors.</p>
        </div>
        <div class="mt-4">
          <a href="{{ url('/checkout/mansa-x') }}" class="inline-block px-4 py-2 bg-[#a04f3f] text-white rounded-lg shadow hover:bg-[#823c32] transition">Select</a>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- INSURANCE -->
<section class="bg-[#f9f7f4] py-16 px-6 lg:px-20">
  <div class="max-w-6xl mx-auto">
    <h2 class="text-3xl font-extrabold text-[#a04f3f]  "><span class="border-b-4 border-yellow-70">Insurance Solutions</span></h2>
    <p class="mt-2 text-gray-600 max-w-2xl">
      Protect what matters most with our wide range of tailored insurance plans for individuals and businesses.
    </p>

    <!-- Card Grid -->
    <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Motor Insurance -->
      <div class="bg-[#f9f7f4] rounded-xl shadow-md p-6 flex flex-col justify-between">
        <div>
          <h3 class="text-xl font-semibold text-[#a04f3f]">Motor Insurance</h3>
          <p class="mt-2 text-gray-600">Reliable coverage for your vehicle against risks.</p>
        </div>
        <div class="mt-4">
          <a href="{{ url('/checkout/motor') }}" class="inline-block px-4 py-2 bg-[#a04f3f] text-white rounded-lg shadow hover:bg-[#823c32] transition">Select</a>
        </div>
      </div>

      <!-- Health Insurance -->
      <div class="bg-[#f9f7f4] rounded-xl shadow-md p-6 flex flex-col justify-between">
        <div>
          <h3 class="text-xl font-semibold text-[#a04f3f]">Health Insurance</h3>
          <p class="mt-2 text-gray-600">Access quality healthcare when you need it most.</p>
        </div>
        <div class="mt-4">
          <a href="{{ url('/checkout/health') }}" class="inline-block px-4 py-2 bg-[#a04f3f] text-white rounded-lg shadow hover:bg-[#823c32] transition">Select</a>
        </div>
      </div>

      <!-- Business Insurance -->
      <div class="bg-[#f9f7f4] rounded-xl shadow-md p-6 flex flex-col justify-between">
        <div>
          <h3 class="text-xl font-semibold text-[#a04f3f]">Business Insurance</h3>
          <p class="mt-2 text-gray-600">Safeguard your enterprise against unforeseen risks.</p>
        </div>
        <div class="mt-4">
          <a href="{{ url('/checkout/business') }}" class="inline-block px-4 py-2 bg-[#a04f3f] text-white rounded-lg shadow hover:bg-[#823c32] transition">Select</a>
        </div>
      </div>

      <!-- Travel Insurance -->
      <div class="bg-[#f9f7f4] rounded-xl shadow-md p-6 flex flex-col justify-between">
        <div>
          <h3 class="text-xl font-semibold text-[#a04f3f]">Travel Insurance</h3>
          <p class="mt-2 text-gray-600">Peace of mind while you explore the world.</p>
        </div>
        <div class="mt-4">
          <a href="{{ url('/checkout/travel') }}" class="inline-block px-4 py-2 bg-[#a04f3f] text-white rounded-lg shadow hover:bg-[#823c32] transition">Select</a>
        </div>
      </div>

      <!-- Life Insurance -->
      <div class="bg-[#f9f7f4] rounded-xl shadow-md p-6 flex flex-col justify-between">
        <div>
          <h3 class="text-xl font-semibold text-[#a04f3f]">Life Insurance</h3>
          <p class="mt-2 text-gray-600">Protect your family with Whole Life cover solutions.</p>
        </div>
        <div class="mt-4">
          <a href="{{ url('/checkout/life') }}" class="inline-block px-4 py-2 bg-[#a04f3f] text-white rounded-lg shadow hover:bg-[#823c32] transition">Select</a>
        </div>
      </div>

      <!-- Contractors All Risk -->
      <div class="bg-[#f9f7f4] rounded-xl shadow-md p-6 flex flex-col justify-between">
        <div>
          <h3 class="text-xl font-semibold text-[#a04f3f]">Contractors All Risk</h3>
          <p class="mt-2 text-gray-600">Protect construction projects from risks and uncertainties.</p>
        </div>
        <div class="mt-4">
          <a href="{{ url('/checkout/contractors') }}" class="inline-block px-4 py-2 bg-[#a04f3f] text-white rounded-lg shadow hover:bg-[#823c32] transition">Select</a>
        </div>
      </div>

      <!-- WIBA & Personal Accident -->
      <div class="bg-[#f9f7f4] rounded-xl shadow-md p-6 flex flex-col justify-between">
        <div>
          <h3 class="text-xl font-semibold text-[#a04f3f]">WIBA & Personal Accident</h3>
          <p class="mt-2 text-gray-600">Cover against work injuries and personal accidents.</p>
        </div>
        <div class="mt-4">
          <a href="{{ url('/checkout/wiba') }}" class="inline-block px-4 py-2 bg-[#a04f3f] text-white rounded-lg shadow hover:bg-[#823c32] transition">Select</a>
        </div>
      </div>

      <!-- Marine Insurance -->
      <div class="bg-[#f9f7f4] rounded-xl shadow-md p-6 flex flex-col justify-between">
        <div>
          <h3 class="text-xl font-semibold text-[#a04f3f]">Marine Insurance</h3>
          <p class="mt-2 text-gray-600">Comprehensive cover for goods transported across seas.</p>
        </div>
        <div class="mt-4">
          <a href="{{ url('/checkout/marine') }}" class="inline-block px-4 py-2 bg-[#a04f3f] text-white rounded-lg shadow hover:bg-[#823c32] transition">Select</a>
        </div>
      </div>
    </div>
  </div>
</section>

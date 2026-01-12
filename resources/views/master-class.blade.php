@extends('layouts.app')
@extends('layouts.header')

@section('content')
<section class="py-12">
    <div class="max-w-6xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

            <!-- Left Side - Image -->
            <div>
                <img src="{{ asset('images/2.jpg') }}"
                     alt="Financial Freedom Master Class"
                     class="rounded-xl shadow-md w-full h-60 object-cover">
            </div>

            <!-- Right Side - Content -->
            <div>
                <h2 class="text-3xl md:text-4xl font-semibold text-gray-800 mb-4"
                    style="font-family: 'Times New Roman', serif;">
                    Financial Freedom Master Class
                </h2>

                <!-- Platform Badge -->
                <div class="flex items-center mb-4">
                    <span class="inline-flex items-center px-4 py-2 rounded-full
                                 bg-blue-50 text-blue-700 font-semibold text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M4 6h11a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V7a1 1 0 011-1z"/>
                        </svg>
                        Live on Google Meet
                    </span>
                </div>

                <!-- Price -->
                <div class="inline-block relative px-4 py-2 mb-3">
                    <span class="relative z-10 text-xl font-bold text-white">KES 3,000</span>
                    <span class="absolute inset-0 -skew-x-12 bg-[#a04f3f] opacity-70"></span>
                    <span class="absolute inset-0 skew-x-12 bg-[#b85f4d] opacity-60 translate-y-1"></span>
                    <span class="absolute inset-0 rotate-3 bg-[#8c3e32] opacity-50 -translate-y-1"></span>
                    <span class="absolute inset-0 -rotate-6 bg-[#703028] opacity-40 translate-x-1"></span>
                </div>

                <div class="inline-block relative px-4 py-2 mb-6">
                    <span class="relative z-10 text-xl font-bold text-white">Limited slots</span>
                    <span class="absolute inset-0 -skew-x-12 bg-[#a04f3f] opacity-70"></span>
                    <span class="absolute inset-0 skew-x-12 bg-[#b85f4d] opacity-60 translate-y-1"></span>
                    <span class="absolute inset-0 rotate-3 bg-[#8c3e32] opacity-50 -translate-y-1"></span>
                    <span class="absolute inset-0 -rotate-6 bg-[#703028] opacity-40 translate-x-1"></span>
                </div>

                <!-- Short Description -->
                <p class="text-lg text-gray-700 font-medium mb-4">
                    A richly immersive two-hour live master class.
                </p>

                <!-- Full Description -->
                <p class="text-gray-600 leading-relaxed mb-6">
                    Ready to take control of your financial future? Join our exclusive Master Class
                    designed for individuals and professionals seeking practical wealth strategies,
                    smart investing techniques, and long-term financial clarity.
                </p>

                <!-- Available Dates -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Select Available Date
                    </label>
                    <select
                        class="w-full border border-gray-300 rounded-lg p-3
                               focus:ring-2 focus:ring-[#a04f3f] focus:border-[#a04f3f]">
                        <option value="">-- Choose a date --</option>
                        <option value="2026-01-20">10th January 2026 (9:00 – 11:00 AM)</option>
                        <option value="2026-01-27">10th Febuary 2026 (9:00  – 11:00 AM)</option>
                        <option value="2026-02-03">10th March 2026 (9:00  – 11:00 AM)</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-2">
                        Google Meet link will be shared after successful registration.
                    </p>
                </div>

            </div>
        </div>
    </div>

    <!-- Lower Section -->
    <div class="max-w-6xl mx-auto px-6 lg:px-12 grid grid-cols-1 md:grid-cols-2 gap-12 my-12">

        <!-- Left Side -->
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-6">
                <span class="border-b-4 border-yellow-700">What's in this</span> service
            </h2>

            <ul class="space-y-5 text-gray-700 list-disc list-inside marker:text-yellow-700">
                <li>Practical Budgeting</li>
                <li>Setting & Achieving Financial Goals</li>
                <li>Growing Your Income</li>
                <li>Paying Off Debts & Mobile Loans</li>
                <li>Wealth Creation & Passive Income</li>
                <li>Saving & Investment Options</li>
                <li>Free Budget Template</li>
            </ul>
        </div>

        <!-- Right Side -->
        <div>
            <p class="text-gray-700 leading-relaxed mb-6">
                Whether you’re an experienced professional or just starting out, this master class
                equips you with practical tools, proven frameworks, and confidence to build
                sustainable wealth.
            </p>

            <!-- CTA -->
            <a href="#"
               class="inline-block w-full text-center bg-gray-900 text-white
                      font-semibold px-6 py-3 rounded-lg shadow hover:bg-gray-800 transition mb-6"
                      onclick="openMasterclassPaymentModal(' Master Class', 3000)">
                Register Now
            </a>

            <!-- Disclaimer -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-sm
                        text-gray-700 flex items-start">
                <span class="flex items-center justify-center w-6 h-6 bg-yellow-100
                             rounded-full mr-3 text-yellow-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                <p>All payments are non-refundable once processed.</p>
            </div>
        </div>

    </div>
</section>
@endsection

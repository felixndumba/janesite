<section x-data="{ selected: null, isCouple: 'individual' }" class="py-16 bg-[#f9f7f4]">
    <div class="max-w-5xl mx-auto px-4">

        <!-- Initial 2 Cards -->
        <div class="grid md:grid-cols-2 gap-10" x-show="selected === null">
            <!-- Free Package Card -->
            <div class="relative border-2 border-[#b25d4c] rounded-2xl p-6 bg-white shadow-md transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl hover:border-[#b25d4c]">
                <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-[#b25d4c] text-white font-bold rounded-full px-6 py-2 shadow">
                    FREE PACKAGE
                </div>
                <ul class="mt-8 space-y-3 text-gray-800">
                    <li>• Savings & Investments Accounts.</li>
                    <li>• Retirement Planning</li>
                    <li>• Setting up an Emergency fund</li>
                    <li>• Setting up Sinking funds</li>
                    <li>• Generational wealth | Trust fund</li>
                    <li>• Child Education fund</li>
                    <li>• Insurance packages</li>
                </ul>
                <p class="mt-4 italic text-sm text-gray-500">
                    In partnership with Insurance & Investment companies
                </p>
                <div class="mt-6">
                    <button @click="selected = 'free'"
                        class="inline-block bg-[#b25d4c] text-white px-6 py-2 rounded-full hover:bg-[#8a4638] transition">
                        Join Us
                    </button>
                </div>
            </div>

            <!-- Personal Financial Advisor -->
            <div class="relative border-2 border-[#b25d4c] rounded-2xl p-6 bg-white shadow-md transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl hover:border-[#b25d4c]">
                <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-[#b25d4c] text-white font-bold rounded-full px-6 py-2 shadow">
                    PERSONAL FINANCIAL ADVISOR
                </div>
                <ul class="mt-8 space-y-3 text-gray-800">
                    <li>• Budgeting</li>
                    <li>• Goals Setting</li>
                    <li>• Debt Management</li>
                    <li>• Mapping your financial freedom journey</li>
                    <li>• Wealth creation | Passive income</li>
                    <li>• Financial Accountability partner</li>
                    <li>• Business consult</li>
                </ul>
                <p class="mt-4 italic text-sm text-gray-500">
                    In partnership with Thedi Advisors
                </p>
                <div class="mt-6">
                    <button @click="selected = 'paid'"
                        class="inline-block bg-[#b25d4c] text-white px-6 py-2 rounded-full hover:bg-[#8a4638] transition">
                        Join Us
                    </button>
                </div>
            </div>
        </div>

        <!-- Free Package Only -->
        <div x-show="selected === 'free'" class="mt-10">
            <div class="relative border-2 border-[#b25d4c] rounded-2xl p-6 bg-white shadow-md transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl hover:border-[#b25d4c]">
                <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-[#b25d4c] text-white font-bold rounded-full px-6 py-2 shadow">
                    FREE PACKAGE
                </div>
                <ul class="mt-8 space-y-2 text-gray-800">
                    <li>• Free need analysis session</li>
                    <li>• Investment / savings / insurance product guidance</li>
                    <li>• Available online and physical</li>
                </ul>
                <a href="https://calendly.com/janendichu1/free_discovery_call" target="_blank"
   class="mt-6 w-full block text-center bg-[#b25d4c] text-white font-semibold py-3 rounded-lg hover:bg-[#8a4638] transition">
   Select Package
</a><br><br>

                <button @click="selected = null"
                    class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                    Back
                </button>
            </div>
        </div>

        <!-- Paid Packages (Basic + Premium) -->
         <div>
            
             <div x-show="selected === 'paid'" class="mt-10 space-y-6">
                <div class="mb-8 flex items-center justify-center space-x-6">
                    <label class="inline-flex items-center">
                        <input type="radio" value="individual" x-model="isCouple" checked class="accent-[#b25d4c]">
                        <span class="ml-2 text-lg font-medium text-black">Individual</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" value="couple" x-model="isCouple" class="accent-[#b25d4c]">
                        <span class="ml-2 text-lg font-medium text-black">Couples (50% off)</span>
                    </label>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Basic -->
                    <div class="relative border-2 border-[#b25d4c] rounded-2xl p-6 bg-white shadow-md transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl hover:border-[#b25d4c]">
                        <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-[#b25d4c] text-white font-bold rounded-full px-6 py-2 shadow">
                            BASIC PACKAGE
                        </div>

                        <ul class="mt-8 space-y-2 text-gray-700">
                            <li>• One comprehensive session</li>
                            <li>• Budgeting, Goal setting, Debt management</li>
                            <li>• Financial freedom journey mapping</li>
                            <li>• Wealth creation & Passive income strategies</li>
                            <li>• Available online and physical</li>
                        </ul>
                        <p class="text-xl  text-black mt-2" x-text="isCouple === 'couple' ? '12,750 KSH' : '8,500 KSH'"></p>
                      <button 
    class="mt-6 w-full bg-[#b25d4c] text-white font-semibold py-3 rounded-lg hover:bg-[#8a4638]"
    @click="openPaymentModal(
        'Basic Package' + (isCouple === 'couple' ? ' (Couple)' : ''),
        isCouple === 'couple' ? 12750 : 8500
    )"
>
    Select Package
</button>

                    </div>

                    <!-- Premium -->
                    <div class="relative border-2 border-[#b25d4c] rounded-2xl p-6 bg-white shadow-md transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl hover:border-[#b25d4c]">
                        <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-[#b25d4c] text-white font-bold rounded-full px-6 py-2 shadow">
                            PREMIUM PACKAGE
                        </div>

                        <ul class="mt-8 space-y-2 text-gray-700">
                            <li>• 3 comprehensive sessions</li>
                            <li>• All basic package features</li>
                            <li>• Advanced wealth creation strategies</li>
                            <li>• Ongoing financial accountability</li>
                            <li>• Priority support & follow-ups</li>
                        </ul>
                        <p class="text-xl  text-black mt-2" x-text="isCouple === 'couple' ? '33,750 KSH' : '22,500 KSH'"></p>
                      <button 
    class="mt-6 w-full bg-[#b25d4c] text-white font-semibold py-3 rounded-lg hover:bg-[#8a4638]"
    @click="openPaymentModal(
        'Premium Package' + (isCouple === 'couple' ? ' (Couple)' : ''),
        isCouple === 'couple' ? 33750 : 22500
    )"
>
    Select Package
</button>

                    </div>
                </div>

            <div class="col-span-2 text-center mt-6">
                <button @click="selected = null"
                    class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                    Back
                </button>
            </div>
        </div>

         </div>
       
    </div>
</section>

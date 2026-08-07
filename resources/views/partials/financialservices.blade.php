<section x-data="{ selected: null, isCouple: 'individual', numSessions: 1, packageChoice: null, purchaseType: null, giftType: null, openPackageChoice(packageName, amount) { this.packageChoice = { name: packageName + (this.isCouple === 'couple' ? ' (Couple)' : ''), baseAmount: amount }; this.purchaseType = null; this.giftType = null; this.selected = 'package-choice'; } }" class="py-16 bg-[#f9f7f4]" style="display:block;">
    <div class="max-w-5xl mx-auto px-4">

        <!-- Initial 3 Cards -->
        <div class="grid md:grid-cols-3 gap-10" x-show="selected === null">
            <!-- Free Package Card -->
            <div class="relative border-2 border-[#b25d4c] rounded-2xl p-6 bg-white shadow-md transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl hover:border-[#b25d4c]">
                <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-[#b25d4c] text-white font-bold text-center rounded-full px-6 py-2 shadow">
                    FREE PACKAGE
                </div>
                <ul class="mt-8 space-y-3 text-gray-800">
                    <li>• Savings Accounts.</li>
                    <li>• Retirement || Pension || Annuities.</li>
                    <li>• Emergency fund || Money Market.</li>
                    <li>• Sinking funds || Endowment Plans.</li>
                    <li>• Generational wealth || Trust fund || Whole life cover</li>
                    <li>• Child Education fund</li>
                    <li>•Special funds,Equity funds, Balanced funds and Fixed income funds</li>
                    <li>•NSSF Tier II</li>
                    <li>• All insurance solutions, medical, motor,travel, business, etc...</li>
                </ul>

                <div class="mt-6">
                                <a href="https://calendly.com/janendichu1/free-package" target="_blank"
  class="inline-block bg-[#b25d4c] text-white px-6 py-2 rounded-full hover:bg-[#8a4638] transition">
   Book Now
</a>
                </div>
            </div>

            <!-- Personal Financial Advisor -->
            <div class="relative border-2 border-[#b25d4c] rounded-2xl p-6 bg-white shadow-md transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl hover:border-[#b25d4c]">
                <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-[#b25d4c] text-white font-bold text-center rounded-full px-6 py-2 shadow">
                    PERSONAL FINANCIAL ADVISOR
                </div>
                <ul class="mt-8 space-y-3 text-gray-800"><br>
                    <li>• Budgeting</li>
                    <li>• Goals setting</li>
                    <li>• Debt management</li>
                    <li>• Mapping your financial freedom journey</li>
                    <li>• Wealth creation || Passive income</li>
                    <li>•Build an investment portfolio || Government  Bonds, Bills, local & International Stocks, RIETS. </li>
                    
                    
                   
                </ul>

                <div class="mt-6">
                    <button @click="selected = 'paid'"
                        class="inline-block bg-[#b25d4c] text-white px-6 py-2 rounded-full hover:bg-[#8a4638] transition">
                      Book Now
                    </button>
                </div>
            </div>

            <!-- Financial Accountability Partner -->
            <div class="relative border-2 border-[#b25d4c] rounded-2xl p-6 bg-white shadow-md transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl hover:border-[#b25d4c]">
                <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-[#b25d4c] text-white font-bold text-center rounded-full px-6 py-2 shadow">
                    FINANCIAL ACCOUNTABILITY PARTNER
                </div>
                <ul class="mt-10 space-y-3 text-gray-800"><br>
                    <li>• 90mins session</li>
                    <li>• Structured Money Check-Ins</li>
                    <li>• Goal Tracking & Action Accountability</li>
                    <li>• Budget Reviews</li>
                    <li>• Financial Habit & Behaviour Support</li>
                    <li>• Savings, Investment & Debt Review.</li>
                    <li>• Real-Life Financial Decision Support</li>
                    <li>• Consistent Guidance & Support</li>
                      <li>• Available in physical and online session.</li>
                </ul>

                <div class="mt-6">
                    <button @click="selected = 'accountability'"
                        class="inline-block bg-[#b25d4c] text-white px-6 py-2 rounded-full hover:bg-[#8a4638] transition">
                        Book Now
                    </button>
                </div>
            </div>
        </div>

        <!-- Paid Packages (Basic + Premium) -->
         <div>
            
            <div class="mt-10 space-y-6">

             <!-- Package choice popup for Basic + Premium -->
             <div x-show="selected === 'package-choice'" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-[100000] px-4">
                <div class="bg-white rounded-2xl p-6 w-full max-w-xl shadow-2xl">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="font-bold text-lg text-gray-800">Choose how you want to purchase</h4>
                        <button class="text-gray-500 hover:text-gray-700" @click="purchaseType = null; giftType = null; packageChoice = null; selected = null">✕</button>
                    </div>

                    <div class="space-y-5">
                        <div x-show="purchaseType === null" class="space-y-3">
                            <p class="text-gray-700 font-semibold">Step 1: Purchase type</p>
                            <div class="grid md:grid-cols-2 gap-4">
<button class="w-full bg-[#b25d4c] text-white font-semibold py-3 rounded-lg hover:bg-[#8a4638]"
                                        @click="purchaseType='buy'; giftType=null; selected='package-choice'">
                                    Book Now
                                </button>
                                <button class="w-full bg-[#b25d4c] text-white font-semibold py-3 rounded-lg hover:bg-[#8a4638]"
                                        @click="purchaseType='gift'; giftType=null; selected='package-choice'">
                                    Gift a voucher
                                </button>
                            </div>
                        </div>

                        <div x-show="purchaseType === 'gift' && giftType === null" class="space-y-3">
                            <p class="text-gray-700 font-semibold">Step 2: Voucher type (for gift)</p>
                            <div class="grid md:grid-cols-2 gap-4">
                                <button class="w-full bg-[#b25d4c] text-white font-semibold py-3 rounded-lg hover:bg-[#8a4638]" @click="giftType='evoucher'">
                                    E-voucher
                                </button>
                                <button class="w-full bg-[#b25d4c] text-white font-semibold py-3 rounded-lg hover:bg-[#8a4638]" @click="giftType='physical'">
                                    Physical voucher (+KSH 500 delivery)
                                </button>
                            </div>
                        </div>

                        <div class="border rounded-lg p-4 bg-gray-50" x-show="packageChoice">
                            <p class="text-gray-700 font-semibold">Package</p>
                            <p class="text-gray-900"> <span x-text="(packageChoice?.name || '')"></span></p>

                            <div class="mt-2 text-sm text-gray-600" x-show="purchaseType==='buy'">
                                Amount: <span x-text="'KSH ' + Number(packageChoice?.baseAmount ?? 0).toLocaleString('en-US')"></span>
                            </div>

                            <div class="mt-2 text-sm text-gray-600" x-show="purchaseType==='gift' && giftType==='evoucher'">
                                Amount: <span x-text="'KSH ' + Number(packageChoice?.baseAmount ?? 0).toLocaleString('en-US')"></span>
                            </div>

                            <div class="mt-2 text-sm text-gray-600" x-show="purchaseType==='gift' && giftType==='physical'">
                                Amount: <span x-text="'KSH ' + (Number(packageChoice?.baseAmount ?? 0) + 500).toLocaleString('en-US')"></span>

                                <div class="text-xs mt-1">Delivery fee already included (+KSH 500).</div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3" x-show="purchaseType !== null">
                            <button class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600" @click="selected='paid'; purchaseType=null; giftType=null; packageChoice=null;">
                                Cancel
                            </button>

<button x-show="purchaseType==='buy' && packageChoice" class="bg-[#a04f3f] text-white px-5 py-2 rounded-lg hover:bg-[#8b3f30]" @click="openPaymentModal(packageChoice?.name ?? '', Number(packageChoice?.baseAmount ?? 0)); selected=null; purchaseType=null; giftType=null; packageChoice=null;">

                                Continue to Payment
                            </button>

<button x-show="purchaseType==='gift' && giftType==='evoucher' && packageChoice" class="bg-[#a04f3f] text-white px-5 py-2 rounded-lg hover:bg-[#8b3f30]" @click="openPaymentModal(packageChoice?.name ?? '', Number(packageChoice?.baseAmount ?? 0), 'https://docs.google.com/forms/d/e/1FAIpQLSe-KjLRfwPGtImgTgr9Mb5fO5cgFVLCdr4IdzaYasKmIu1Y8w/viewform?usp=publish-editor'); selected=null; purchaseType=null; giftType=null; packageChoice=null;">

                                Continue to Payment
                            </button>

<button x-show="purchaseType==='gift' && giftType==='physical' && packageChoice" class="bg-[#a04f3f] text-white px-5 py-2 rounded-lg hover:bg-[#8b3f30]" @click="openDeliveryPaymentModal(packageChoice?.name ?? '', Number(packageChoice?.baseAmount ?? 0) + 500, 'https://docs.google.com/forms/d/e/1FAIpQLSeExZEYr8yQIeOEo0a5GYHPjsikEOgM9Hq_dJEEczUxVkJgCw/viewform?usp=header'); selected=null; purchaseType=null; giftType=null; packageChoice=null;">

                                Continue to Payment
                            </button>
                        </div>
                    </div>
                </div>
             </div>
             
             <!-- show paid grid only when not in popup -->
             <div x-show="selected === 'paid' && selected !== 'package-choice'" class="space-y-6">

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
                     <div class="relative border-2 border-[#b25d4c] rounded-2xl p-6 bg-white shadow-md transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl hover:border-[#b25d4c]">
                        <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-[#b25d4c] text-white font-bold text-center rounded-full px-6 py-2 shadow">
                            BASIC PACKAGE
                        </div>

                        <ul class="mt-8 space-y-2 text-gray-700">
                            <li>• One comprehensive session</li>
                            <li>• 2 hrs session</li>
                            <li>• Budgeting, Goal setting, Debt management</li>
                            <li>• Financial freedom journey mapping</li>
                            <li>• Wealth creation & Passive income strategies</li>
                            <li>• Available online and physical</li>
                        </ul>
                        <p class="text-xl  text-black mt-2" x-text="isCouple === 'couple' ? '15000 KSH' : '10,000 KSH'"></p>
                      <button
    class="mt-6 w-full bg-[#b25d4c] text-white font-semibold py-3 rounded-lg hover:bg-[#8a4638]"
@click="openPackageChoice('Basic Package', isCouple === 'couple' ? 15000 : 10000)"
>
    Select Package
</button>

                    </div>

                    <!-- Premium -->
                    <div class="relative border-2 border-[#b25d4c] rounded-2xl p-6 bg-white shadow-md transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl hover:border-[#b25d4c]">
                        <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-[#b25d4c] text-white font-bold text-center rounded-full px-6 py-2 shadow">
                            PREMIUM PACKAGE
                        </div>

                        <ul class="mt-8 space-y-2 text-gray-700">
                            <li>• 3 comprehensive sessions</li>
                             <li>• 2 hrs per sessions</li>
                             <li>• All basic package features</li>
                            <li>• Advanced wealth creation strategies</li>
                            <li>• Ongoing financial accountability</li>
                            <li>• Priority support & follow-ups</li>
                             <li>• Available in physical and online session.</li>
                        </ul>
                        <p class="text-xl  text-black mt-2" x-text="isCouple === 'couple' ? '38,250 KSH' : '25,500 KSH'"></p>
                      <button
    class="mt-6 w-full bg-[#b25d4c] text-white font-semibold py-3 rounded-lg hover:bg-[#8a4638]"
@click="openPackageChoice('Premium Package', isCouple === 'couple' ? 38250 : 25500)"
>
    Select Package
</button>

                    </div>
                </div>

            <div class="text-center mt-6">
                <button @click="selected = null"
                    class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                    Back
                </button>
            </div>
        </div>

        <!-- Financial Accountability Partner Options -->
        <div x-show="selected === 'accountability'" class="mt-10 space-y-6">
            <div class="mb-8 flex items-center justify-center space-x-6">
                <label class="inline-flex items-center">
                    <input type="radio" value="individual" x-model="isCouple" checked class="accent-[#b25d4c]">
                    <span class="ml-2 text-lg font-medium text-black">Individual</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" value="couple" x-model="isCouple" class="accent-[#b25d4c]">
                    <span class="ml-2 text-lg font-medium text-black">Couples</span>
                </label>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Monthly Sessions -->
                <div class="relative border-2 border-[#b25d4c] rounded-2xl p-6 bg-white shadow-md transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl hover:border-[#b25d4c]">
                    <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-[#b25d4c] text-white font-bold text-center rounded-full px-6 py-2 shadow">
                        MONTHLY SESSIONS
                    </div>
                    <div class="mt-8">
                        <label class="block text-gray-800 mb-2">Select number of sessions</label>
                        <input type="number" x-model="numSessions" min="1" class="w-full p-2 border border-gray-300 rounded">
                    </div>
                    <p class="text-xl text-black mt-4" x-text="'Price: ' + 'KSH' + (numSessions * (isCouple === 'couple' ? 11250 : 7500)) + '  per session'"></p>
                    <button class="mt-6 w-full bg-[#b25d4c] text-white font-semibold py-3 rounded-lg hover:bg-[#8a4638]"
                        @click="openPaymentModal('Monthly Sessions (' + numSessions + ' sessions)' + (isCouple === 'couple' ? ' (Couple)' : ''), numSessions * (isCouple === 'couple' ? 11250 : 7500), 'https://calendly.com/janendichu1/financial-accountability-partner')">
                        Select Package
                    </button>
                </div>

                <!-- Quarterly Package -->
                <div class="relative border-2 border-[#b25d4c] rounded-2xl p-6 bg-white shadow-md transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl hover:border-[#b25d4c]">
                    <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-[#b25d4c] text-white font-bold text-center rounded-full px-6 py-2 shadow">
                        QUARTERLY PACKAGE
                    </div>
                    <p class="mt-8 text-gray-800">After every 3 months</p>
                    <p class="text-xl text-black mt-4" x-text="isCouple === 'couple' ? 'KSH 38,250' : 'KSH 25,500'"></p>
                    <button class="mt-6 w-full bg-[#b25d4c] text-white font-semibold py-3 rounded-lg hover:bg-[#8a4638]"
                        @click="openPaymentModal('Quarterly Package' + (isCouple === 'couple' ? ' (Couple)' : ''), isCouple === 'couple' ? 38250 : 25500, 'https://calendly.com/janendichu1/financial-accountability-partner')">
                        Select Package
                    </button>
                </div>

                <!-- Half Yearly -->
                <div class="relative border-2 border-[#b25d4c] rounded-2xl p-6 bg-white shadow-md transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl hover:border-[#b25d4c]">
                    <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-[#b25d4c] text-white font-bold text-center rounded-full px-6 py-2 shadow">
                        HALF YEARLY
                    </div>
                    <p class="mt-8 text-gray-800">After every 6 months</p>
                    <p class="text-xl text-black mt-4" x-text="isCouple === 'couple' ? 'KSH 19,125' : 'KSH 12,750'"></p>
                    <button class="mt-6 w-full bg-[#b25d4c] text-white font-semibold py-3 rounded-lg hover:bg-[#8a4638]"
                        @click="openPaymentModal('Half Yearly Package' + (isCouple === 'couple' ? ' (Couple)' : ''), isCouple === 'couple' ? 19125 : 12750, 'https://calendly.com/janendichu1/financial-accountability-partner')">
                      Select Package
                    </button>
                </div>
            </div>

            <div class="text-center mt-6">
                <button @click="selected = null" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                    Back
                </button>
            </div>
        </div>

         </div>
       
    </div>
</section>

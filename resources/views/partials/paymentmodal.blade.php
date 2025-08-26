<!-- M-Pesa Payment Modal -->
<div id="mpesaModal" 
     class="hidden fixed inset-0 h-screen w-screen  bg-opacity-60 backdrop-blur-sm 
            flex items-center justify-center z-[9999] transition-opacity duration-300 overflow-hidden">
    
    <!-- Modal Card -->
    <div id="mpesaCard"
         class="bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl transform scale-95 opacity-0 
                transition-all duration-300 relative z-[10000]">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h4 class="font-bold text-lg text-gray-800 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="h-6 w-6 text-black-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                M-Pesa Payment
            </h4>
            <button onclick="closePaymentModal()" 
                    class="text-gray-500 hover:text-gray-700 transition">✕</button>
        </div>

        <!-- Package & Amount -->
        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-4 border border-gray-200">
            <p id="modalPackage" class="text-md text-gray-600"></p>
            <p id="modalAmount" class="text-2xl font-bold text-orange-600 mb-4"></p>
        </div><br>

        <!-- Phone Input -->
        <div class="mb-4">
            <label for="mpesaPhone" class="font-semibold text-sm">M-Pesa Phone Number</label>
            <input id="mpesaPhone" type="text" placeholder="2547XXXXXXXX"
                   class="border rounded-lg w-full p-3 focus:ring-2 focus:ring-orange-400 
                          focus:border-orange-500 outline-none shadow-sm transition"/>
        </div>

        <!-- Payment Instructions -->
        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-4 border border-gray-200">
            <p class="font-semibold text-gray-700">Payment Instructions:</p>
            <ol class="list-decimal pl-5 text-sm text-gray-600 mb-4 space-y-1">
                <li>Enter your M-Pesa registered phone number</li>
                <li>You’ll receive an STK push notification</li>
                <li>Enter your M-Pesa PIN to complete payment</li>
                <li>After payment, you’ll be redirected to book your session</li>
            </ol>
        </div><br>
       
        <!-- Pay Button -->
        <button id="payButton" 
                class="w-full bg-[#a04f3f] text-white font-bold py-3 rounded-full shadow-md 
                       hover:bg-[#d97a1b] transition">
            Pay <span id="payAmount">0 KSH</span> via M-Pesa
        </button>

    </div>
</div>

<script>
    function openPaymentModal(packageName, amount) {
        const modal = document.getElementById('mpesaModal');
        const card = document.getElementById('mpesaCard');

        document.getElementById('modalPackage').innerText = packageName;
        document.getElementById('modalAmount').innerText = amount + ' KSH';
        document.getElementById('payAmount').innerText = amount + ' KSH';

        document.body.style.overflow = 'hidden'; // Disable scroll
        modal.classList.remove('hidden');

        setTimeout(() => {
            card.classList.remove('scale-95', 'opacity-0');
            card.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closePaymentModal() {
        const modal = document.getElementById('mpesaModal');
        const card = document.getElementById('mpesaCard');

        document.body.style.overflow = ''; // Enable scroll
        card.classList.add('scale-95', 'opacity-0');
        card.classList.remove('scale-100', 'opacity-100');
        setTimeout(() => modal.classList.add('hidden'), 200);
    }

    // 🚀 Integrate Payment Request
    document.getElementById('payButton').addEventListener('click', async (e) => {
        e.preventDefault();

        const phone  = document.getElementById('mpesaPhone').value.trim();
        const amount = document.getElementById('payAmount').textContent.replace(' KSH','').trim();

        if (!/^2547\d{8}$/.test(phone)) { 
            alert('Enter phone as 2547XXXXXXXX'); 
            return; 
        }

        try {
            const res = await fetch("{{ route('mpesa.initiate') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    phone: phone,
                    amount: Number(amount),
                    account_reference: "ORDER",
                    description: "Online Payment"
                })
            });

            const data = await res.json();
            if (res.ok) {
                alert("✅ Payment request sent to your phone. Enter your M-Pesa PIN.");
            } else {
                console.error(data);
                alert("❌ Failed to initiate payment. Check console/logs.");
            }
        } catch (err) {
            console.error(err);
            alert("⚠️ Network error. Try again.");
        }
    });
</script>

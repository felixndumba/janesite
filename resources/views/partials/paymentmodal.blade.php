<!-- M-Pesa Payment Modal -->
<div id="mpesaModal"
     class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm
            flex items-center justify-center z-[9999]
            overflow-y-auto px-4 transition-opacity duration-300">

    <!-- Modal Card -->
    <div id="mpesaCard"
         class="bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl
                transform scale-95 opacity-0 transition-all duration-300 relative">

        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h4 class="font-bold text-lg text-gray-800 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-6 w-6 text-gray-700" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                M-Pesa Payment
            </h4>
            <button onclick="closePaymentModal()"
                    class="text-gray-500 hover:text-gray-700 transition">✕</button>
        </div>

        <!-- Package & Amount -->
        <div class="bg-gray-100 rounded-lg p-4 border mb-4">
            <p id="modalPackage" class="text-md text-gray-600"></p>
            <p id="modalAmount" class="text-2xl font-bold text-orange-600"></p>
        </div>

        <!-- Phone Input -->
        <div class="mb-4">
            <label class="font-semibold text-sm">M-Pesa Phone Number</label>
            <input id="mpesaPhone" type="text" placeholder="2547XXXXXXXX"
                   class="border rounded-lg w-full p-3 focus:ring-2
                          focus:ring-orange-400 outline-none"/>
        </div>

        <!-- Status Message -->
        <div id="paymentMessage"
             class="hidden mb-4 p-3 rounded-lg text-sm font-medium"></div>

        <!-- Instructions -->
        <div class="bg-gray-100 rounded-lg p-4 border text-sm text-gray-700 space-y-1 mb-4">
            <p class="font-semibold">Payment Instructions:</p>
            <ol class="list-decimal pl-5 space-y-1">
                <li>Enter your M-Pesa phone number</li>
                <li>Wait for STK push</li>
                <li>Enter your PIN</li>
                <li>You’ll be redirected after payment</li>
            </ol><br>
             <div class="bg-gray-400 border border-yellow-200 rounded-lg p-4 text-sm text-gray-700 flex items-start">
            <span class="flex items-center justify-center w-6 h-6 bg-yellow-100 rounded-full mr-3 text-yellow-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
            <p>Please note that the payment is for the stipulated time of your choosing kindly.</p>
        </div>
        </div>

        <!-- Pay Button -->
        <button id="payButton"
                class="w-full bg-[#a04f3f] text-white font-bold py-3
                       rounded-full hover:bg-[#d97a1b] transition">
            Pay <span id="payAmount">KSH 0</span> via M-Pesa
        </button>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

    let currentCheckoutId = null;
    let pollingInterval = null;

    const modal = document.getElementById("mpesaModal");
    const card  = document.getElementById("mpesaCard");

    /* ================= OPEN MODAL ================= */
    window.openPaymentModal = function(packageName, amount) {
        document.getElementById("modalPackage").innerText = packageName;
        document.getElementById("modalAmount").innerText =  " KSH" + amount;
        document.getElementById("payAmount").innerText =  " KSH" + amount;

        modal.classList.remove("hidden");

        setTimeout(() => {
            card.classList.remove("scale-95","opacity-0");
            card.classList.add("scale-100","opacity-100");
        }, 10);
    };

    /* ================= CLOSE MODAL ================= */
    window.closePaymentModal = function() {
        card.classList.add("scale-95","opacity-0");
        card.classList.remove("scale-100","opacity-100");

        setTimeout(() => modal.classList.add("hidden"), 200);

        if (pollingInterval) clearInterval(pollingInterval);
    };

    /* === CLICK OUTSIDE CARD CLOSES MODAL === */
    modal.addEventListener("click", (e) => {
        if (!card.contains(e.target)) {
            closePaymentModal();
        }
    });

    /* ================= STATUS MESSAGE ================= */
    function showMessage(message, type = "info") {
        const box = document.getElementById("paymentMessage");

        box.className = "mb-4 p-3 rounded-lg text-sm font-medium";

        if (type === "success") box.classList.add("bg-green-100","text-green-700");
        else if (type === "error") box.classList.add("bg-red-100","text-red-700");
        else box.classList.add("bg-blue-100","text-blue-700");

        box.innerText = message;
    }

    /* ================= POLLING ================= */
    async function pollPaymentStatus(id) {
        try {
            const res = await fetch(`/api/payment-status/${id}`);
            const data = await res.json();

            if (data.status === "success") {
                showMessage("🎉 Payment confirmed! Redirecting...", "success");
                clearInterval(pollingInterval);
                setTimeout(() => {
                    window.location.href =
                      "https://calendly.com/janendichu1/personal-financial-advisor";
                }, 1500);
            }

            if (data.status === "failed") {
                showMessage("⚠️ Payment failed or cancelled.", "error");
                clearInterval(pollingInterval);
            }
        } catch {
            showMessage("❌ Network error.", "error");
        }
    }

    /* ================= PAY BUTTON ================= */
    document.getElementById("payButton").addEventListener("click", async () => {

        const phone = document.getElementById("mpesaPhone").value.trim();
        const amount = document.getElementById("payAmount").innerText.replace(" KSH","");

        if (!/^2547\d{8}$/.test(phone)) {
            showMessage("⚠️ Enter phone as 2547XXXXXXXX", "error");
            return;
        }

        showMessage("⏳ Sending payment request...");

        const res = await fetch("{{ route('mpesa.initiate') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                phone,
                amount: Number(amount),
                account_reference: "ORDER",
                description: "Online Payment"
            })
        });

        const data = await res.json();

        if (res.ok && data.CheckoutRequestID) {
            currentCheckoutId = data.CheckoutRequestID;
            showMessage("✅ STK push sent. Enter PIN.", "success");

            pollingInterval = setInterval(() => {
                pollPaymentStatus(currentCheckoutId);
            }, 3000);
        } else {
            showMessage("❌ Failed to initiate payment.", "error");
        }
    });
});
</script>

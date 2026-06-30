<!-- M-Pesa Payment Modal for Physical Voucher (includes delivery fee) -->
<div id="mpesaModalDelivery"
     class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm
            flex items-center justify-center z-[9999]
            overflow-y-auto px-4 transition-opacity duration-300">

    <!-- Modal Card -->
    <div id="mpesaCardDelivery"
         class="bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl
                transform scale-95 opacity-0 transition-all duration-300 relative">

        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h4 class="font-bold text-lg text-gray-800 flex items-center gap-2">
                🚚 Physical Voucher Payment
            </h4>
            <button onclick="closeDeliveryPaymentModal()"
                    class="text-gray-500 hover:text-gray-700 transition">✕</button>
        </div>

        <!-- Package & Amount -->
        <div class="bg-gray-100 rounded-lg p-4 border mb-4">
            <p id="deliveryModalPackage" class="text-md text-gray-600"></p>
            <p class="text-xs text-gray-500 mb-1">
                Includes delivery fee: <span class="font-semibold">KSH 500</span> per package.
            </p>
            <p id="deliveryModalAmount" class="text-2xl font-bold text-orange-600"></p>
        </div>

        <!-- Phone Input -->
        <div class="mb-4">
            <label class="font-semibold text-sm">M-Pesa Phone Number</label>
            <input id="deliveryMpesaPhone" type="text" placeholder="Enter your phone number"
                   class="border rounded-lg w-full p-3 focus:ring-2
                          focus:ring-orange-400 outline-none"/>
        </div>

        <!-- Status Message -->
        <div id="deliveryPaymentMessage"
             class="hidden mb-4 p-3 rounded-lg text-sm font-medium"></div>

        <!-- Instructions -->
        <div class="bg-gray-100 rounded-lg p-4 border text-sm text-gray-700 space-y-1 mb-4">
            <p class="font-semibold">Payment Instructions:</p>
            <ol class="list-decimal pl-5 space-y-1">
                <li>Enter your M-Pesa phone number</li>
                <li>Wait for STK push</li>
                <li>Enter your PIN</li>
                <li>You’ll be redirected after payment</li>
            </ol>
            <p class="text-xs text-gray-600 mt-2">
                Note: Delivery fee is already added to your total for the physical voucher.
            </p>
        </div>

        <!-- Pay Button -->
        <button id="deliveryPayButton"
                class="w-full bg-[#a04f3f] text-white font-bold py-3
                       rounded-full hover:bg-[#d97a1b] transition">
            Pay <span id="deliveryPayAmount">KSH 0</span> via M-Pesa
        </button>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

    let deliveryCurrentCheckoutId = null;
    let deliveryPollingInterval = null;
    let deliveryPollCount = 0;
    const deliveryMaxPolls = 30; // 90 seconds timeout

    const modal = document.getElementById("mpesaModalDelivery");
    const card  = document.getElementById("mpesaCardDelivery");

    /* ================= OPEN MODAL ================= */
    window.openDeliveryPaymentModal = function(packageName, baseAmount, redirectUrl = null) {
        
        const totalAmount = Number(baseAmount) ;

window.currentDeliveryRedirectUrl = redirectUrl || 'https://calendly.com/janendichu1/personal-financial-advisor';

        const formattedAmount = Number(baseAmount).toLocaleString('en-US');
        const formattedTotalAmount = Number(totalAmount).toLocaleString('en-US');

        document.getElementById("deliveryModalPackage").innerText = packageName;
        // Show base package amount in the modal amount (as requested)
        document.getElementById("deliveryModalAmount").innerText = "KSH " + formattedAmount;
        // But charge/pay the total (base + delivery)
        document.getElementById("deliveryPayAmount").innerText = "KSH " + formattedTotalAmount;

        modal.classList.remove("hidden");
        setTimeout(() => {
            card.classList.remove("scale-95","opacity-0");
            card.classList.add("scale-100","opacity-100");
        }, 10);
    };

    /* ================= CLOSE MODAL ================= */
    window.closeDeliveryPaymentModal = function() {
        window.currentDeliveryRedirectUrl = null;
        card.classList.add("scale-95","opacity-0");
        card.classList.remove("scale-100","opacity-100");
        setTimeout(() => modal.classList.add("hidden"), 200);
        if (deliveryPollingInterval) clearInterval(deliveryPollingInterval);
    };

    modal.addEventListener("click", (e) => {
        if (!card.contains(e.target)) closeDeliveryPaymentModal();
    });

    /* ================= MESSAGE BOX ================= */
    function showDeliveryMessage(message, type = "info") {
        const box = document.getElementById("deliveryPaymentMessage");
        box.className = "mb-4 p-3 rounded-lg text-sm font-medium";
        if (type === "success") box.classList.add("bg-green-100","text-green-700");
        else if (type === "error") box.classList.add("bg-red-100","text-red-700");
        else box.classList.add("bg-blue-100","text-blue-700");
        box.innerText = message;
        box.classList.remove("hidden");
    }

    /* ================= POLLING ================= */
    async function pollDeliveryPaymentStatus(id) {
        deliveryPollCount++;
        try {
            const res = await fetch(`/api/payment-status/${id}`, {
                headers: { "Accept": "application/json" }
            });
            if (!res.ok) return;

            const data = await res.json();

            if (data.status === "success") {
                showDeliveryMessage("🎉 Payment confirmed! Redirecting...", "success");
                clearInterval(deliveryPollingInterval);
                setTimeout(() => {
                    window.location.href = window.currentDeliveryRedirectUrl || 'https://calendly.com/janendichu1/personal-financial-advisor';
                }, 1500);
            }

            if (data.status === "failed") {
                showDeliveryMessage("⚠️ Payment failed or cancelled. Please try again.", "error");
                clearInterval(deliveryPollingInterval);
            }

            if (deliveryPollCount >= deliveryMaxPolls) {
                showDeliveryMessage("⏰ Payment request timed out. Please try again.", "error");
                clearInterval(deliveryPollingInterval);
            }
        } catch {
            showDeliveryMessage("❌ Network error. Retrying...", "error");
        }
    }

    /* ================= PAY BUTTON ================= */
    document.getElementById("deliveryPayButton").addEventListener("click", async () => {

        const phone = document.getElementById("deliveryMpesaPhone").value.trim();
        const amountText = document.getElementById("deliveryPayAmount").innerText;
        const amount = Number(amountText.replace(/[^0-9.]/g, ""));

        // Validate
        if (!/^(\+254[17]\d{8}|0[17]\d{8})$/.test(phone)) {
            showDeliveryMessage("⚠️ Enter a valid M-Pesa phone number.", "error");
            return;
        }
        if (Number(amount) <= 0) {
            showDeliveryMessage("⚠️ Enter a valid amount greater than 0.", "error");
            return;
        }

        showDeliveryMessage("⏳ Sending payment request...");

        let res, data;
        try {
            res = await fetch("/api/mpesa/stk/initiate", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    phone,
                    amount: Number(amount),
                    account_reference: "ORDER_DELIVERY",
                    description: "Order Payment"
                })
            });
        } catch {
            showDeliveryMessage("❌Check your connection and try again.", "error");
            return;
        }

        if (!res.ok) {
            try {
                const errorData = await res.json();
                showDeliveryMessage("❌ " + (errorData.message || "Payment service is currently unavailable. Please try again later."), "error");
            } catch {
                showDeliveryMessage("❌ Payment service is currently unavailable. Please try again later.", "error");
            }
            return;
        }

        try {
            data = await res.json();
        } catch {
            showDeliveryMessage("❌ Please try again.", "error");
            return;
        }

        // Success
        if (data.checkout_request_id) {
            deliveryCurrentCheckoutId = data.checkout_request_id;
            deliveryPollCount = 0;
            showDeliveryMessage("✅ Payment request sent! Check your phone and enter your PIN.", "success");

            deliveryPollingInterval = setInterval(() => {
                pollDeliveryPaymentStatus(deliveryCurrentCheckoutId);
            }, 3000);

        } else if (data.status === "error") {
            showDeliveryMessage("❌ " + data.message, "error");
        } else {
            showDeliveryMessage("❌. Please try again.", "error");
        }
    });

});
</script>


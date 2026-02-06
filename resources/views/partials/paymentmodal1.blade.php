<!-- MASTER CLASS M-Pesa Payment Modal -->
<div id="mpesaModalMaster"
     class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm
            flex items-center justify-center z-[9999]
            overflow-y-auto px-4 transition-opacity duration-300">

    <!-- Modal Card -->
    <div id="mpesaCardMaster"
         class="bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl
                transform scale-95 opacity-0 transition-all duration-300 relative">

        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h4 class="font-bold text-lg text-gray-800 flex items-center gap-2">
                📚 Master Class Payment
            </h4>
            <button onclick="closeMasterclassPaymentModal()"
                    class="text-gray-500 hover:text-gray-700 transition">✕</button>
        </div>

        <!-- Package & Amount -->
        <div class="bg-gray-100 rounded-lg p-4 border mb-4">
            <p id="masterPackage" class="text-md text-gray-600"></p>
            <p id="masterAmount" class="text-2xl font-bold text-orange-600"></p>
        </div>

        <!-- Phone Input -->
        <div class="mb-4">
            <label class="font-semibold text-sm">M-Pesa Phone Number</label>
            <input id="masterPhone" type="text" placeholder="2547XXXXXXXX"
                   class="border rounded-lg w-full p-3 focus:ring-2
                          focus:ring-orange-400 outline-none"/>
        </div>

        <!-- Status Message -->
        <div id="masterMessage"
             class="hidden mb-4 p-3 rounded-lg text-sm font-medium"></div>

        <!-- Instructions -->
        <div class="bg-gray-100 rounded-lg p-4 border text-sm text-gray-700 space-y-1 mb-4">
            <p class="font-semibold">Payment Instructions:</p>
            <ol class="list-decimal pl-5 space-y-1">
                <li>Enter your M-Pesa phone number</li>
                <li>Wait for STK push</li>
                <li>Enter your PIN</li>
                <li>You’ll be redirected to a form, fill your details</li>
            </ol>
        </div>

        <!-- Pay Button -->
        <button id="masterPayButton"
                class="w-full bg-[#a04f3f] text-white font-bold py-3
                       rounded-full hover:bg-[#d97a1b] transition">
            Pay <span id="masterPayAmount">KSH 0</span> via M-Pesa
        </button>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", () => {

    let masterCheckoutId = null;
    let masterPolling = null;

    const modal = document.getElementById("mpesaModalMaster");
    const card  = document.getElementById("mpesaCardMaster");

    /* ================= OPEN MODAL ================= */
    window.openMasterclassPaymentModal = function(packageName, amount) {
        document.getElementById("masterPackage").innerText = packageName;
        document.getElementById("masterAmount").innerText = "KSH " + amount;
        document.getElementById("masterPayAmount").innerText = "KSH " + amount;

        modal.classList.remove("hidden");

        setTimeout(() => {
            card.classList.remove("scale-95","opacity-0");
            card.classList.add("scale-100","opacity-100");
        }, 10);
    };

    /* ================= CLOSE MODAL ================= */
    window.closeMasterclassPaymentModal = function() {
        card.classList.add("scale-95","opacity-0");
        card.classList.remove("scale-100","opacity-100");

        setTimeout(() => modal.classList.add("hidden"), 200);

        if (masterPolling) clearInterval(masterPolling);
    };

    modal.addEventListener("click", e => {
        if (!card.contains(e.target)) closeMasterclassPaymentModal();
    });

    /* ================= SHOW MESSAGE ================= */
    function showMasterMessage(msg, type="info") {
        const box = document.getElementById("masterMessage");
        box.className = "mb-4 p-3 rounded-lg text-sm font-medium";

        if (type==="success") box.classList.add("bg-green-100","text-green-700");
        else if (type==="error") box.classList.add("bg-red-100","text-red-700");
        else box.classList.add("bg-blue-100","text-blue-700");

        box.innerText = msg;
        box.classList.remove("hidden");
    }

    /* ================= POLLING PAYMENT STATUS ================= */
    async function pollMasterStatus(id) {
        try {
            const res = await fetch(`/api/payment-status/${id}`);
            const data = await res.json();

            if (data.status === "success") {
                showMasterMessage("🎉 Payment successful! You are being redirected…", "success");
                clearInterval(masterPolling);

                setTimeout(() => {
                    window.location.href = "/master-class-room"; // 🔁 Adjust if needed
                }, 1500);
            } else if (data.status === "failed") {
                showMasterMessage("❌ Payment could not be completed. Please try again or contact support.", "error");
                clearInterval(masterPolling);
            } else {
                showMasterMessage("⏳ Payment is being processed. Please complete the STK push on your phone.", "info");
            }
        } catch (err) {
            showMasterMessage("⚠️ Unable to check payment status. Retrying...", "error");
        }
    }

    /* ================= INITIATE PAYMENT ================= */
    document.getElementById("masterPayButton").addEventListener("click", async () => {
        const phone = document.getElementById("masterPhone").value.trim();
        const amount = document.getElementById("masterPayAmount").innerText.replace("KSH ","");

        if (!/^2547\d{8}$/.test(phone)) {
            showMasterMessage("⚠️ Please enter a valid phone number in the format 2547XXXXXXXX.", "error");
            return;
        }

        showMasterMessage("⏳ Sending payment request...", "info");

        try {
            const res = await fetch("{{ route('mpesa.initiate') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    phone,
                    amount: Number(amount),
                    account_reference: "MASTERCLASS",
                    description: "Master Class Payment"
                })
            });

            const data = await res.json();

            if (res.ok && data.checkout_request_id) {
                masterCheckoutId = data.checkout_request_id;
                showMasterMessage("✅ STK push sent! Enter your M-Pesa PIN on your phone to complete payment.", "success");

                masterPolling = setInterval(() => {
                    pollMasterStatus(masterCheckoutId);
                }, 3000);
            } else {
                const msg = data.message || "❌ Could not initiate payment. Please try again.";
                showMasterMessage(msg, "error");
            }

        } catch (err) {
            showMasterMessage("❌ Unable to send payment request. Check your internet and try again.", "error");
        }
    });
});
</script>

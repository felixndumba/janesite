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
            <input id="masterPhone" type="text" placeholder="Enter your phone number"
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
                <li>Choose how you'd like to watch after payment</li>
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
    window.openMasterclassPaymentModal = function(packageName, amount, youtubeId = null, accent = '#8C3E32') {
        // Store the video details so the delivery popup can act on them.
        window.masterclassVideo = {
            title: packageName,
            youtube_id: youtubeId,
            accent: accent,
        };

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

/* ================= OPEN DELIVERY POPUP ================= */
    function openMasterDeliveryPopup() {
        const deliveryPopup = document.getElementById("masterDeliveryPopup");
        deliveryPopup.classList.remove("hidden");

        const card = deliveryPopup.querySelector("div");
        card.classList.add("scale-95","opacity-0");

        // Reset the email form state each time it opens.
        const emailForm = document.getElementById("masterEmailForm");
        emailForm.classList.add("hidden");
        const emailMsg  = document.getElementById("masterEmailMsg");
        emailMsg.classList.add("hidden");
        document.getElementById("masterEmailInput").value = "";

        setTimeout(() => {
            card.classList.remove("scale-95","opacity-0");
            card.classList.add("scale-100","opacity-100");
        }, 10);
    }

    /* ================= POLLING PAYMENT STATUS ================= */
    async function pollMasterStatus(id) {
        try {
            const res = await fetch(`/api/payment-status/${id}`);
            const data = await res.json();

            if (data.status === "success") {
                clearInterval(masterPolling);
                closeMasterclassPaymentModal();
                openMasterDeliveryPopup();
            } else if (data.status === "failed") {
                showMasterMessage("❌ Payment could not be completed. Please try again or contact support.", "error");
                clearInterval(masterPolling);
            } else {
                showMasterMessage("✅ STK push sent! Enter your M-Pesa PIN on your phone to complete payment.", "success");
            }
        } catch (err) {
            showMasterMessage("⚠️ Unable to check payment status. Retrying...", "error");
        }
    }

    /* ================= INITIATE PAYMENT ================= */
    document.getElementById("masterPayButton").addEventListener("click", async () => {
        const phone = document.getElementById("masterPhone").value.trim();
        const amount = document.getElementById("masterPayAmount").innerText.replace("KSH ","");

        if (!/^(\+2547\d{8}|07\d{8}|01\d{8})$/.test(phone)) {
            showMasterMessage("⚠️ Please enter a valid phone number.", "error");
            return;
        }

        showMasterMessage("⏳ Sending payment request...", "info");

        try {
            const res = await fetch("/api/mpesa/stk/initiate", {
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

            if (!res.ok) {
                try {
                    const errorData = await res.json();
                    showMasterMessage("❌ " + (errorData.message || "Payment service is currently unavailable. Please try again later."), "error");
                } catch {
                    showMasterMessage("❌ Payment service is currently unavailable. Please try again later.", "error");
                }
                return;
            }

            const data = await res.json();

            if (data.checkout_request_id) {
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

<!-- HOW WOULD YOU LIKE TO WATCH? DELIVERY POPUP -->
<div id="masterDeliveryPopup"
     class="hidden fixed inset-0 bg-black/40 z-50
            flex items-center justify-center px-4">

    <div class="bg-white rounded-3xl p-8 max-w-md w-full text-center
                shadow-2xl transform scale-95 opacity-0 transition-all duration-300">

        <div class="mx-auto mb-4 w-14 h-14 rounded-full bg-green-100
                    flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <h3 class="text-xl font-bold text-gray-800">
            Payment Successful! 🎉
        </h3>

        <p class="text-gray-600 mt-2">
            How would you like to watch your masterclass?
        </p>

        <div class="mt-6 space-y-3">
            <!-- Watch Now -->
            <button type="button" onclick="watchNowFromDelivery()"
                    class="w-full bg-[#a04f3f] text-white font-bold py-3 rounded-full
                           hover:bg-[#8b3f30] transition flex items-center justify-center gap-2">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M8 5v14l11-7z" />
                </svg>
                Watch Now
            </button>

            <!-- Email me the link -->
            <button type="button" onclick="showMasterEmailForm()"
                    class="w-full bg-gray-900 text-white font-bold py-3 rounded-full
                           hover:bg-gray-800 transition flex items-center justify-center gap-2">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2z" />
                    <path d="M22 6l-10 7L2 6" />
                </svg>
                Email me the link
            </button>
        </div>

        <!-- Email form (revealed after clicking "Email me the link") -->
        <div id="masterEmailForm" class="hidden mt-5 text-left">
            <label class="font-semibold text-sm text-gray-700">Email Address</label>
            <input id="masterEmailInput" type="email" placeholder="you@example.com"
                   class="border rounded-lg w-full p-3 mt-1 mb-3 focus:ring-2
                          focus:ring-orange-400 outline-none"/>
            <button type="button" onclick="sendMasterEmailLink()"
                    class="w-full bg-[#8C6D31] text-white font-bold py-3 rounded-full
                           hover:bg-[#7a5f2b] transition">
                Send Link
            </button>
        </div>

        <!-- Email status message -->
        <div id="masterEmailMsg"
             class="hidden mt-4 p-3 rounded-lg text-sm font-medium"></div>

        <button type="button" onclick="closeMasterDeliveryPopup()"
                class="mt-6 text-sm font-semibold text-gray-400 hover:text-gray-600 transition">
            Close
        </button>
    </div>
</div>

<script>
window.showMasterEmailForm = function() {
    const form = document.getElementById("masterEmailForm");
    const msg = document.getElementById("masterEmailMsg");
    if (form) form.classList.remove("hidden");
    if (msg) msg.classList.add("hidden");
};

window.closeMasterDeliveryPopup = function() {
    const popup = document.getElementById("masterDeliveryPopup");
    if (!popup) return;

    const card = popup.querySelector("div");
    if (card) {
        card.classList.add("scale-95","opacity-0");
        card.classList.remove("scale-100","opacity-100");
    }

    setTimeout(() => {
        if (popup) popup.classList.add("hidden");
    }, 200);
};

window.watchNowFromDelivery = function() {
    const video = window.masterclassVideo || {};
    const popup = document.getElementById("masterDeliveryPopup");

    if (popup) {
        popup.classList.add("hidden");
    }

    if (video && video.youtube_id) {
        const event = new CustomEvent("masterclass:watch", {
            detail: video
        });

        window.dispatchEvent(event);

        if (window.Alpine && typeof window.Alpine.store === 'function') {
            const watcher = window.Alpine.store('masterclass');
            if (watcher && typeof watcher.play === 'function') {
                watcher.play(video);
            }
        }
    } else {
        console.warn("watchNowFromDelivery() called without a purchased video payload");
    }
};

window.sendMasterEmailLink = async function() {
    const input = document.getElementById("masterEmailInput");
    const email = input.value.trim();
    const msgBox = document.getElementById("masterEmailMsg");

    if (!msgBox) return;

    msgBox.classList.remove("hidden");

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        msgBox.className = "mt-4 p-3 rounded-lg text-sm font-medium bg-red-100 text-red-700";
        msgBox.innerText = "⚠️ Please enter a valid email address.";
        return;
    }

    const video = window.masterclassVideo || {};
    msgBox.className = "mt-4 p-3 rounded-lg text-sm font-medium bg-blue-100 text-blue-700";
    msgBox.innerText = "⏳ Sending your video link...";

    try {
        const masterclassSendLinkUrl = @json(route('masterclass.send-link'));

        const res = await fetch(masterclassSendLinkUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            },
            body: JSON.stringify({
                email: email,
                title: video.title || "Masterclass",
                youtube_id: video.youtube_id || ""
            })
        });

        let data = {};

        try {
            data = await res.json();
        } catch {
            data = { status: 'error', message: 'Something went wrong. Please try again.' };
        }

     if (res.ok && (data.status === "success" || data.success === true)) {
            msgBox.className = "mt-4 p-3 rounded-lg text-sm font-medium bg-green-100 text-green-700";
            msgBox.innerText = (data.message || "The video link has been sent to your email.");
            input.value = "";

            setTimeout(() => {
                const emailForm = document.getElementById("masterEmailForm");
                if (emailForm) {
                    emailForm.classList.add("hidden");
                }
            }, 900);
        } else {
            const errorMessage = (data.message || "Something went wrong. Please try again.");
            msgBox.className = "mt-4 p-3 rounded-lg text-sm font-medium bg-red-100 text-red-700";
            msgBox.innerText = "✅ Your masterclass link has been sent to your email. Please check your inbox.";
        }
    } catch {
        msgBox.className = "mt-4 p-3 rounded-lg text-sm font-medium bg-red-100 text-red-700";
        msgBox.innerText = "❌ Network error. Please try again.";
    }
};

document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("mpesaModalMaster");
    const card  = document.getElementById("mpesaCardMaster");

    let masterCheckoutId = null;
    let masterPolling = null;

    function openMasterDeliveryPopup() {
        const deliveryPopup = document.getElementById("masterDeliveryPopup");
        deliveryPopup.classList.remove("hidden");

        const card = deliveryPopup.querySelector("div");
        card.classList.add("scale-95","opacity-0");

        const emailForm = document.getElementById("masterEmailForm");
        const emailMsg  = document.getElementById("masterEmailMsg");

        if (emailForm) emailForm.classList.add("hidden");
        if (emailMsg) emailMsg.classList.add("hidden");

        const input = document.getElementById("masterEmailInput");
        if (input) input.value = "";

        setTimeout(() => {
            card.classList.remove("scale-95","opacity-0");
            card.classList.add("scale-100","opacity-100");
        }, 10);
    }

    async function pollMasterStatus(id) {
        try {
            const res = await fetch(`/api/payment-status/${id}`);
            const data = await res.json();

            if (data.status === "success") {
                clearInterval(masterPolling);
                closeMasterclassPaymentModal();
                openMasterDeliveryPopup();
            } else if (data.status === "failed") {
                showMasterMessage("❌ Payment could not be completed. Please try again or contact support.", "error");
                clearInterval(masterPolling);
            } else {
                showMasterMessage("✅ STK push sent! Enter your M-Pesa PIN on your phone to complete payment.", "success");
            }
        } catch (err) {
            showMasterMessage("⚠️ Unable to check payment status. Retrying...", "error");
        }
    }

    document.getElementById("masterPayButton").addEventListener("click", async () => {
        const phone = document.getElementById("masterPhone").value.trim();
        const amount = document.getElementById("masterPayAmount").innerText.replace("KSH ","");

        if (!/^(\+2547\d{8}|07\d{8}|01\d{8})$/.test(phone)) {
            showMasterMessage("⚠️ Please enter a valid phone number.", "error");
            return;
        }

        showMasterMessage("⏳ Sending payment request...", "info");

        try {
            const res = await fetch("/api/mpesa/stk/initiate", {
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

            if (!res.ok) {
                try {
                    const errorData = await res.json();
                    showMasterMessage("❌ " + (errorData.message || "Payment service is currently unavailable. Please try again later."), "error");
                } catch {
                    showMasterMessage("❌ Payment service is currently unavailable. Please try again later.", "error");
                }
                return;
            }

            const data = await res.json();

            if (data.checkout_request_id) {
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

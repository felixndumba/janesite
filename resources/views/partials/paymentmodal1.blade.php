

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

            <button
                type="button"
                onclick="closeMasterclassPaymentModal()"
                class="text-gray-500 hover:text-gray-700 transition"
            >
                ✕
            </button>
        </div>


        <!-- Package & Amount -->
        <div class="bg-gray-100 rounded-lg p-4 border mb-4">
            <p id="masterPackage" class="text-md text-gray-600"></p>

            <p
                id="masterAmount"
                class="text-2xl font-bold text-orange-600"
            ></p>
        </div>


        <!-- Phone Input -->
        <div class="mb-4">
            <label
                for="masterPhone"
                class="font-semibold text-sm"
            >
                M-Pesa Phone Number
            </label>

            <input
                id="masterPhone"
                type="text"
                placeholder="Enter your phone number"
                class="border rounded-lg w-full p-3 focus:ring-2
                       focus:ring-orange-400 outline-none"
            />
        </div>


        <!-- Status Message -->
        <div
            id="masterMessage"
            class="hidden mb-4 p-3 rounded-lg text-sm font-medium"
        ></div>


        <!-- Instructions -->
        <div
            class="bg-gray-100 rounded-lg p-4 border text-sm
                   text-gray-700 space-y-1 mb-4"
        >
            <p class="font-semibold">
                Payment Instructions:
            </p>

            <ol class="list-decimal pl-5 space-y-1">
                <li>Enter your M-Pesa phone number</li>
                <li>Wait for STK push</li>
                <li>Enter your PIN</li>
                <li>Choose how you'd like to watch after payment</li>
            </ol>
        </div>


        <!-- Pay Button -->
        <button
            id="masterPayButton"
            type="button"
            class="w-full bg-[#a04f3f] text-white font-bold py-3
                   rounded-full hover:bg-[#8b3f30] transition"
        >
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


    /* ============================================================
       OPEN MASTERCLASS PAYMENT MODAL
       ============================================================ */

    window.openMasterclassPaymentModal = function(
        packageName,
        amount,
        youtubeId = null,
        accent = '#8C3E32'
    ) {

        /*
         * Store the purchased video information.
         * This is later used by:
         *
         * 1. Watch Now
         * 2. Google Form
         */
        window.masterclassVideo = {
            title: packageName,
            youtube_id: youtubeId,
            accent: accent
        };


        document.getElementById("masterPackage").innerText =
            packageName;

        document.getElementById("masterAmount").innerText =
            "KSH " + amount;

        document.getElementById("masterPayAmount").innerText =
            "KSH " + amount;


        /*
         * Open modal
         */
        modal.classList.remove("hidden");


        /*
         * Animation
         */
        setTimeout(() => {

            card.classList.remove(
                "scale-95",
                "opacity-0"
            );

            card.classList.add(
                "scale-100",
                "opacity-100"
            );

        }, 10);
    };


    /* ============================================================
       CLOSE PAYMENT MODAL
       ============================================================ */

    window.closeMasterclassPaymentModal = function() {

        card.classList.add(
            "scale-95",
            "opacity-0"
        );

        card.classList.remove(
            "scale-100",
            "opacity-100"
        );


        setTimeout(() => {
            modal.classList.add("hidden");
        }, 200);


        /*
         * Stop polling when modal closes
         */
        if (masterPolling) {
            clearInterval(masterPolling);
            masterPolling = null;
        }
    };


    /* ============================================================
       CLOSE WHEN CLICKING OUTSIDE
       ============================================================ */

    modal.addEventListener("click", e => {

        if (!card.contains(e.target)) {
            closeMasterclassPaymentModal();
        }

    });


    /* ============================================================
       SHOW PAYMENT MESSAGE
       ============================================================ */

    function showMasterMessage(
        msg,
        type = "info"
    ) {

        const box =
            document.getElementById("masterMessage");

        box.className =
            "mb-4 p-3 rounded-lg text-sm font-medium";


        if (type === "success") {

            box.classList.add(
                "bg-green-100",
                "text-green-700"
            );

        } else if (type === "error") {

            box.classList.add(
                "bg-red-100",
                "text-red-700"
            );

        } else {

            box.classList.add(
                "bg-blue-100",
                "text-blue-700"
            );
        }


        box.innerText = msg;

        box.classList.remove("hidden");
    }


    /* ============================================================
       OPEN DELIVERY POPUP
       ============================================================ */

    function openMasterDeliveryPopup() {

        const deliveryPopup =
            document.getElementById(
                "masterDeliveryPopup"
            );


        if (!deliveryPopup) {
            return;
        }


        deliveryPopup.classList.remove("hidden");


        const deliveryCard =
            deliveryPopup.querySelector("div");


        if (deliveryCard) {

            deliveryCard.classList.add(
                "scale-95",
                "opacity-0"
            );

            deliveryCard.classList.remove(
                "scale-100",
                "opacity-100"
            );
        }


        /*
         * IMPORTANT:
         *
         * Every time the payment succeeds and the
         * delivery popup opens, hide the Google Form.
         *
         * The user must click "Fill Your Details"
         * to reveal it.
         */

        const googleForm =
            document.getElementById(
                "masterGoogleForm"
            );


        if (googleForm) {
            googleForm.classList.add("hidden");
        }


        /*
         * Animation
         */

        setTimeout(() => {

            if (deliveryCard) {

                deliveryCard.classList.remove(
                    "scale-95",
                    "opacity-0"
                );

                deliveryCard.classList.add(
                    "scale-100",
                    "opacity-100"
                );
            }

        }, 10);
    }


    /* ============================================================
       POLL PAYMENT STATUS
       ============================================================ */

    async function pollMasterStatus(id) {

        try {

            const res =
                await fetch(
                    `/api/payment-status/${id}`
                );


            const data =
                await res.json();


            /*
             * PAYMENT SUCCESS
             */

            if (data.status === "success") {

                clearInterval(masterPolling);

                masterPolling = null;


                /*
                 * Close M-Pesa modal
                 */

                closeMasterclassPaymentModal();


                /*
                 * Open delivery options
                 */

                openMasterDeliveryPopup();


            }


            /*
             * PAYMENT FAILED
             */

            else if (data.status === "failed") {

                showMasterMessage(
                    "❌ Payment could not be completed. Please try again or contact support.",
                    "error"
                );


                clearInterval(masterPolling);

                masterPolling = null;
            }


            /*
             * PAYMENT STILL PROCESSING
             */

            else {

                showMasterMessage(
                    "✅ STK push sent! Enter your M-Pesa PIN on your phone to complete payment.",
                    "success"
                );
            }


        } catch (err) {

            console.error(
                "Masterclass payment polling error:",
                err
            );


            showMasterMessage(
                "⚠️ Unable to check payment status. Retrying...",
                "error"
            );
        }
    }


    /* ============================================================
       INITIATE M-PESA PAYMENT
       ============================================================ */

    document
        .getElementById("masterPayButton")
        .addEventListener(
            "click",
            async () => {

                const phone =
                    document
                        .getElementById("masterPhone")
                        .value
                        .trim();


                const amount =
                    document
                        .getElementById("masterPayAmount")
                        .innerText
                        .replace("KSH ", "");


                /*
                 * Validate phone number
                 */

                if (
                    !/^(\+2547\d{8}|07\d{8}|01\d{8})$/
                        .test(phone)
                ) {

                    showMasterMessage(
                        "⚠️ Please enter a valid phone number.",
                        "error"
                    );

                    return;
                }


                showMasterMessage(
                    "⏳ Sending payment request...",
                    "info"
                );


                try {

                    const res =
                        await fetch(
                            "/api/mpesa/stk/initiate",
                            {
                                method: "POST",

                                headers: {
                                    "Content-Type":
                                        "application/json",

                                    "X-CSRF-TOKEN":
                                        "{{ csrf_token() }}"
                                },

                                body: JSON.stringify({
                                    phone: phone,

                                    amount:
                                        Number(amount),

                                    account_reference:
                                        "MASTERCLASS",

                                    description:
                                        "Master Class Payment"
                                })
                            }
                        );


                    /*
                     * Server error
                     */

                    if (!res.ok) {

                        try {

                            const errorData =
                                await res.json();


                            showMasterMessage(
                                "❌ " +
                                (
                                    errorData.message ||
                                    "Payment service is currently unavailable. Please try again later."
                                ),
                                "error"
                            );

                        } catch {

                            showMasterMessage(
                                "❌ Payment service is currently unavailable. Please try again later.",
                                "error"
                            );
                        }


                        return;
                    }


                    const data =
                        await res.json();


                    /*
                     * STK PUSH CREATED
                     */

                    if (
                        data.checkout_request_id
                    ) {

                        masterCheckoutId =
                            data.checkout_request_id;


                        showMasterMessage(
                            "✅ STK push sent! Enter your M-Pesa PIN on your phone to complete payment.",
                            "success"
                        );


                        /*
                         * Start polling
                         */

                        masterPolling =
                            setInterval(
                                () => {

                                    pollMasterStatus(
                                        masterCheckoutId
                                    );

                                },
                                3000
                            );


                    } else {

                        const msg =
                            data.message ||
                            "❌ Could not initiate payment. Please try again.";


                        showMasterMessage(
                            msg,
                            "error"
                        );
                    }


                } catch (err) {

                    console.error(
                        "Masterclass payment error:",
                        err
                    );


                    showMasterMessage(
                        "❌ Unable to send payment request. Check your internet and try again.",
                        "error"
                    );
                }

            }
        );

});
</script>



<!-- ============================================================
     HOW WOULD YOU LIKE TO WATCH?
     DELIVERY POPUP
     ============================================================ -->

<div
    id="masterDeliveryPopup"
    class="hidden fixed inset-0 bg-black/40 z-50
           flex items-center justify-center px-4
           overflow-y-auto"
>

    <div
        class="bg-white rounded-3xl p-8 max-w-md w-full
               text-center shadow-2xl
               transform scale-95 opacity-0
               transition-all duration-300 my-8"
    >

        <!-- Success Icon -->

        <div
            class="mx-auto mb-4 w-14 h-14 rounded-full
                   bg-green-100 flex items-center justify-center"
        >

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-8 h-8 text-green-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 13l4 4L19 7"
                />

            </svg>

        </div>


        <!-- Heading -->

        <h3 class="text-xl font-bold text-gray-800">
            Payment Successful! 🎉
        </h3>


        <p class="text-gray-600 mt-2">
            How would you like to watch your masterclass?
        </p>


        <!-- ====================================================
             OPTIONS
             ==================================================== -->

        <div class="mt-6 space-y-3">


            <!-- ================= WATCH NOW ================= -->

            <button
                type="button"
                onclick="watchNowFromDelivery()"
                class="w-full bg-[#a04f3f] text-white font-bold
                       py-3 rounded-full
                       hover:bg-[#8b3f30] transition
                       flex items-center justify-center gap-2"
            >

                <svg
                    class="h-5 w-5"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                >

                    <path d="M8 5v14l11-7z" />

                </svg>

                Watch Now

            </button>


            <!-- ================= FILL DETAILS ================= -->

            <button
                type="button"
                onclick="showMasterGoogleForm()"
                class="w-full bg-gray-900 text-white font-bold
                       py-3 rounded-full
                       hover:bg-gray-800 transition
                       flex items-center justify-center gap-2"
            >

                <svg
                    class="h-5 w-5"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >

                    <path
                        d="M4 4h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2z"
                    />

                    <path
                        d="M8 9h8M8 13h6"
                    />

                </svg>

                Fill Your Details

            </button>

        </div>


        <!-- ====================================================
             GOOGLE FORM
             ==================================================== -->

        <div
            id="masterGoogleForm"
            class="hidden mt-5 text-left"
        >

            <!-- Form Header -->

            <div class="mb-4">

                <h4 class="text-lg font-bold text-gray-800">
                    Complete Your Details
                </h4>

                <p class="text-sm text-gray-500 mt-1">
                    Please fill in your details below to receive
                    access to your purchased masterclass.
                </p>

            </div>


            <!-- Google Form -->

            <div
                class="overflow-hidden rounded-2xl
                       border border-gray-200 bg-gray-50"
            >

                <iframe
                    src="https://docs.google.com/forms/d/e/1FAIpQLSeoo5Z_M5PEOKOuGD7jYISWaXXhJTfLj6NS7GbJieE253hMSQ/viewform?embedded=true"
                    width="100%"
                    height="650"
                    frameborder="0"
                    marginheight="0"
                    marginwidth="0"
                    title="Masterclass Details Form"
                    class="w-full"
                >
                    Loading…
                </iframe>

            </div>


            <!-- Form Information -->

            <p
                class="text-xs text-gray-400
                       text-center mt-3"
            >
                Please submit the form once you have completed
                your details.
            </p>

        </div>


        <!-- Close -->

        <button
            type="button"
            onclick="closeMasterDeliveryPopup()"
            class="mt-6 text-sm font-semibold
                   text-gray-400 hover:text-gray-600 transition"
        >
            Close
        </button>

    </div>

</div>



<script>

/* ============================================================
   SHOW GOOGLE FORM
   ============================================================ */

window.showMasterGoogleForm = function() {

    const form =
        document.getElementById(
            "masterGoogleForm"
        );


    if (!form) {
        return;
    }


    /*
     * Show the Google Form
     */

    form.classList.remove("hidden");


    /*
     * Scroll down to the form
     */

    setTimeout(() => {

        form.scrollIntoView({
            behavior: "smooth",
            block: "start"
        });

    }, 100);

};



/* ============================================================
   CLOSE DELIVERY POPUP
   ============================================================ */

window.closeMasterDeliveryPopup = function() {

    const popup =
        document.getElementById(
            "masterDeliveryPopup"
        );


    if (!popup) {
        return;
    }


    const card =
        popup.querySelector("div");


    /*
     * Animate out
     */

    if (card) {

        card.classList.add(
            "scale-95",
            "opacity-0"
        );

        card.classList.remove(
            "scale-100",
            "opacity-100"
        );
    }


    /*
     * Hide popup
     */

    setTimeout(() => {

        popup.classList.add("hidden");

    }, 200);

};



/* ============================================================
   WATCH NOW
   ============================================================ */

window.watchNowFromDelivery = function() {

    const video =
        window.masterclassVideo || {};


    const popup =
        document.getElementById(
            "masterDeliveryPopup"
        );


    /*
     * Close delivery popup
     */

    if (popup) {

        popup.classList.add("hidden");

    }


    /*
     * Make sure we have the purchased video
     */

    if (
        video &&
        video.youtube_id
    ) {

        /*
         * Fire event for the Masterclass page
         */

        const event =
            new CustomEvent(
                "masterclass:watch",
                {
                    detail: video
                }
            );


        window.dispatchEvent(event);


        /*
         * Also support Alpine store
         * if your Masterclass page uses it.
         */

        if (
            window.Alpine &&
            typeof window.Alpine.store === "function"
        ) {

            const watcher =
                window.Alpine.store(
                    "masterclass"
                );


            if (
                watcher &&
                typeof watcher.play === "function"
            ) {

                watcher.play(video);

            }
        }


    } else {

        console.warn(
            "watchNowFromDelivery() called without a purchased video payload"
        );
    }

};

</script>


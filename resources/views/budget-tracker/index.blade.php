@extends('layouts.app')

@section('title', 'Budget Tracker | Thedi Advisors')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | BUDGET TRACKER PRODUCT SETTINGS
    |--------------------------------------------------------------------------
    | No database is required for this product.
    | Change the price here when you are ready for the real price.
    */

    $budgetProductName = 'Financial Planner ';

    $budgetPrice = 500;

    $budgetDescription = 'A practical Excel budget tracker designed to help you manage your income, expenses, savings and overall financial progress with ease.';

    // Shown as a quick checklist on the product card.
    $budgetFeatures = [
        'Pre-built income, expense & savings sheets',
        'Pre-built debt tracker, financial goals tracker, investment tracker, net worth calculator sheets',
        'Automatic monthly and yearly totals',
        'Works in Excel & Google Sheets',
        'Instant download — no waiting, no email required',
    ];

    // Shown in the "How it works" section below the product.
    $budgetSteps = [
        [
            'title'       => 'Preview your tracker',
            'description' => 'Preview the sheet, then tap Purchase when you are ready.',
        ],
        [
            'title'       => 'Pay with M-Pesa',
            'description' => 'Enter your number and approve the prompt on your phone.',
        ],
        [
            'title'       => 'Download instantly',
            'description' => 'Your file unlocks the moment payment is confirmed.',
        ],
    ];

    $budgetFaqs = [
        [
            'q' => 'What do I get after paying?',
            'a' => 'A ready-to-use Excel file with income, expense and savings sheets already set up. No templates to build yourself.',
        ],
        [
            'q' => 'Does it work on my phone?',
            'a' => 'Yes. The file opens in the Excel or Google Sheets app on Android and iPhone, as well as on desktop.',
        ],
        [
            'q' => 'What if my payment does not go through?',
            'a' => 'If M-Pesa fails or times out, you will see a clear message and can retry immediately — you are only charged once payment is confirmed.',
        ],
        [
            'q' => 'Can I get help using the tracker?',
            'a' => 'Yes, reach out to Thedi Advisors support and we will walk you through setting it up.',
        ],
    ];
@endphp


<section class="min-h-screen bg-[#fdf9f6] py-20">

    <div class="mx-auto max-w-7xl px-6 lg:px-8">

        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

        <div class="mx-auto mb-12 max-w-3xl text-center">

            <p class="mb-3 text-xs font-semibold uppercase
                      tracking-[0.15em] text-[#a04f3f]">
                Financial Tools
            </p>

            <h1 class="text-4xl font-semibold tracking-tight
                       text-[#3a231c] sm:text-5xl">
                Practical financial trackers
            </h1>

            <p class="mx-auto mt-4 max-w-xl text-base
                      text-[#3a231c]/60 sm:text-lg">
                Simple Excel tools designed to help you manage your money,
                track your progress and make better financial decisions.
            </p>

            {{-- Trust row --}}
            <div class="mt-6 flex flex-wrap items-center
                        justify-center gap-x-6 gap-y-2
                        text-xs font-medium text-[#3a231c]/50">

                <span class="inline-flex items-center gap-1.5">
                    <svg class="h-4 w-4 text-[#4b6a53]" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Secure M-Pesa checkout
                </span>

                <span class="inline-flex items-center gap-1.5">
                    <svg class="h-4 w-4 text-[#4b6a53]" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Instant download
                </span>

                <span class="inline-flex items-center gap-1.5">
                    <svg class="h-4 w-4 text-[#4b6a53]" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    One-time payment
                </span>

            </div>

        </div>


        {{-- =====================================================
             BUDGET TRACKER PRODUCT
        ====================================================== --}}

        <div class="mx-auto max-w-md">

            <article
                class="flex flex-col rounded-2xl bg-white p-6
                       shadow-sm ring-1 ring-[#3a231c]/5
                       transition duration-300
                       hover:-translate-y-1 hover:shadow-xl"
            >

                {{-- Product Header --}}

                <div class="mb-5 flex items-center justify-between">

                    <span
                        class="inline-flex rounded-full
                               bg-[#a04f3f]/10 px-3 py-1
                               text-[11px] font-semibold
                               uppercase tracking-wider
                               text-[#a04f3f]"
                    >
                        Financial Tool
                    </span>

                    <span class="text-right">
                        <span class="block text-lg font-bold text-[#3a231c]">
                            KSh {{ number_format($budgetPrice) }}
                        </span>
                       
                    </span>

                </div>


                {{-- Product Name --}}

                <h2 class="text-2xl font-bold text-[#3a231c]">
                    {{ $budgetProductName }}
                </h2>


                {{-- Product Description --}}

                <p class="mt-3 text-sm leading-relaxed text-[#3a231c]/60">
                    {{ $budgetDescription }}
                </p>


                {{-- Feature checklist --}}

                <ul class="mt-5 space-y-2.5 border-t border-[#3a231c]/10 pt-5">

                    @foreach ($budgetFeatures as $feature)
                        <li class="flex items-start gap-2.5 text-sm text-[#3a231c]/75">
                            <svg class="mt-0.5 h-4 w-4 flex-shrink-0 text-[#4b6a53]"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>{{ $feature }}</span>
                        </li>
                    @endforeach

                </ul>


                {{-- =================================================
                     BUTTONS
                ================================================== --}}

                <div class="mt-6 flex gap-3">

                    {{-- Preview --}}

                    <a
                        href="{{ route('budget.preview') }}"
                        target="_blank"
                        class="flex-1 rounded-full
                               border border-[#a04f3f]/30
                               px-4 py-3 text-center text-xs
                               font-semibold uppercase
                               tracking-wider text-[#a04f3f]
                               transition hover:bg-[#a04f3f]/5
                               focus:outline-none focus-visible:ring-2
                               focus-visible:ring-[#a04f3f]/40"
                    >
                        Preview
                    </a>


                    {{-- Purchase --}}

                    <button
                        type="button"
                        onclick="openBudgetPaymentModal({{ $budgetPrice }})"
                        class="flex-1 rounded-full
                               bg-[#a04f3f]
                               px-4 py-3 text-xs
                               font-semibold uppercase
                               tracking-wider text-white
                               transition hover:bg-[#873f35]
                               focus:outline-none focus-visible:ring-2
                               focus-visible:ring-[#a04f3f]/40
                               focus-visible:ring-offset-2"
                    >
                        Purchase
                    </button>

                </div>

                <p class="mt-4 text-center text-[11px] text-[#3a231c]/40">
                    Paid securely via M-Pesa &middot; delivered as an .xlsx file
                </p>

            </article>

        </div>


        {{-- =====================================================
             HOW IT WORKS
        ====================================================== --}}

        <div class="mx-auto mt-20 max-w-4xl">

            <h3 class="mb-10 text-center text-xl font-semibold text-[#3a231c]">
                How it works
            </h3>

            <div class="grid gap-8 sm:grid-cols-3">

                @foreach ($budgetSteps as $index => $step)
                    <div class="relative text-center">

                        <div class="mx-auto mb-4 flex h-11 w-11
                                    items-center justify-center
                                    rounded-full bg-[#a04f3f]/10
                                    text-sm font-bold text-[#a04f3f]">
                            {{ $index + 1 }}
                        </div>

                        <h4 class="text-sm font-semibold text-[#3a231c]">
                            {{ $step['title'] }}
                        </h4>

                        <p class="mt-1.5 text-sm text-[#3a231c]/55">
                            {{ $step['description'] }}
                        </p>

                    </div>
                @endforeach

            </div>

        </div>


        {{-- =====================================================
             FAQ
        ====================================================== --}}

        <div class="mx-auto mt-20 max-w-2xl">

            <h3 class="mb-6 text-center text-xl font-semibold text-[#3a231c]">
                Common questions
            </h3>

            <div class="divide-y divide-[#3a231c]/10
                        rounded-2xl border border-[#3a231c]/10 bg-white">

                @foreach ($budgetFaqs as $faq)
                    <details class="group px-5 py-4">

                        <summary
                            class="flex cursor-pointer list-none
                                   items-center justify-between
                                   text-sm font-medium text-[#3a231c]
                                   focus:outline-none"
                        >
                            {{ $faq['q'] }}

                            <svg
                                class="h-4 w-4 flex-shrink-0 text-[#3a231c]/40
                                       transition-transform duration-200
                                       group-open:rotate-45"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </summary>

                        <p class="mt-2.5 text-sm leading-relaxed text-[#3a231c]/60">
                            {{ $faq['a'] }}
                        </p>

                    </details>
                @endforeach

            </div>

        </div>

    </div>

</section>



{{-- =============================================================
     BUDGET TRACKER PAYMENT MODAL
============================================================= --}}

<div
    id="budgetPaymentModal"
    class="hidden fixed inset-0 z-[9999]
           flex items-center justify-center
           overflow-y-auto bg-black/60
           px-4 py-8 backdrop-blur-sm
           transition-opacity duration-300"
    role="dialog"
    aria-modal="true"
    aria-labelledby="budgetModalTitle"
>

    {{-- Modal Card --}}

    <div
        id="budgetPaymentCard"
        class="relative w-full max-w-md
               transform rounded-2xl bg-white p-6
               opacity-0 shadow-2xl scale-95
               transition-all duration-300"
    >

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="mb-5 flex items-center justify-between">

            <h4
                id="budgetModalTitle"
                class="flex items-center gap-2
                       text-lg font-bold text-gray-800"
            >
                <svg class="h-6 w-6 text-gray-700" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                M-Pesa Payment
            </h4>

            <button
                type="button"
                onclick="closeBudgetPaymentModal()"
                aria-label="Close"
                class="rounded-full p-1 text-gray-400 transition
                       hover:bg-gray-100 hover:text-gray-600
                       focus:outline-none focus-visible:ring-2
                       focus-visible:ring-[#a04f3f]/40"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

        </div>


        {{-- =====================================================
             STEP INDICATOR
        ====================================================== --}}

        <div id="budgetStepIndicator" class="mb-5 flex items-center justify-center gap-2">

            <div class="flex items-center gap-2">
                <span id="budgetStepDot1"
                      class="h-2 w-2 rounded-full bg-[#a04f3f] transition-colors"></span>
                <span id="budgetStepLine1"
                      class="h-px w-8 bg-gray-200 transition-colors"></span>
                <span id="budgetStepDot2"
                      class="h-2 w-2 rounded-full bg-gray-200 transition-colors"></span>
                <span id="budgetStepLine2"
                      class="h-px w-8 bg-gray-200 transition-colors"></span>
                <span id="budgetStepDot3"
                      class="h-2 w-2 rounded-full bg-gray-200 transition-colors"></span>
            </div>

        </div>


        {{-- =====================================================
             PRODUCT / AMOUNT
        ====================================================== --}}

        <div class="mb-5 flex items-center justify-between
                    rounded-lg border bg-gray-50 p-4">

            <div>
                <p id="budgetModalProduct" class="text-sm text-gray-500">
                    {{ $budgetProductName }}
                </p>

                <p id="budgetModalAmount" class="text-2xl font-bold text-[#a04f3f]">
                    KSH {{ number_format($budgetPrice) }}
                </p>
            </div>

            <svg class="h-9 w-9 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 3H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2z" />
            </svg>

        </div>


        {{-- =====================================================
             PAYMENT FORM
        ====================================================== --}}

        <div id="budgetPaymentForm">

            {{-- Phone --}}

            <div class="mb-4">

                <label for="budgetMpesaPhone" class="text-sm font-semibold text-gray-700">
                    M-Pesa phone number
                </label>

                <input
                    id="budgetMpesaPhone"
                    type="text"
                    inputmode="tel"
                    autocomplete="tel"
                    placeholder="07XX XXX XXX"
                    class="mt-1.5 w-full rounded-lg border border-gray-300
                           p-3 text-sm outline-none transition
                           focus:border-[#a04f3f] focus:ring-2
                           focus:ring-[#a04f3f]/20"
                />

                <p id="budgetPhoneHint" class="mt-1.5 text-xs text-gray-400">
                    We'll send a payment prompt to this number.
                </p>

            </div>


            {{-- Payment Message --}}

            <div
                id="budgetPaymentMessage"
                class="mb-4 hidden rounded-lg p-3 text-sm font-medium"
                role="status"
                aria-live="polite"
            ></div>


            {{-- =================================================
                 PAYMENT INSTRUCTIONS
            ================================================== --}}

            <div class="mb-5 rounded-lg border bg-gray-50 p-4 text-sm text-gray-600">

                <p class="mb-2 font-semibold text-gray-700">What happens next</p>

                <ol class="list-decimal space-y-1 pl-4">
                    <li>Enter your M-Pesa number and tap Pay</li>
                    <li>Approve the prompt sent to your phone</li>
                    <li>Your download unlocks automatically</li>
                </ol>

            </div>


            {{-- =================================================
                 PAY BUTTON
            ================================================== --}}

            <button
                id="budgetPayButton"
                type="button"
                class="flex w-full items-center justify-center gap-2
                       rounded-full bg-[#a04f3f]
                       py-3 font-bold text-white
                       transition hover:bg-[#873f35]
                       focus:outline-none focus-visible:ring-2
                       focus-visible:ring-[#a04f3f]/40
                       focus-visible:ring-offset-2
                       disabled:cursor-not-allowed disabled:opacity-60"
            >
                <span id="budgetPayButtonSpinner" class="hidden h-4 w-4 animate-spin
                       rounded-full border-2 border-white/40 border-t-white"></span>
                <span id="budgetPayButtonLabel">
                    Pay KSH {{ number_format($budgetPrice) }} via M-Pesa
                </span>
            </button>

            <p class="mt-3 flex items-center justify-center gap-1.5
                      text-center text-[11px] text-gray-400">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                Payments are processed securely by M-Pesa
            </p>

        </div>


        {{-- =====================================================
             SUCCESS / DOWNLOAD SECTION
        ====================================================== --}}

        <div id="budgetDownloadSection" class="hidden text-center">

            <div class="mx-auto mb-4 flex h-16 w-16
                        items-center justify-center
                        rounded-full bg-green-100">
                <svg class="h-8 w-8 text-green-600" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h3 class="text-xl font-bold text-gray-800">
                Payment confirmed!
            </h3>

            <p class="mt-2 text-sm leading-relaxed text-gray-500">
                Thank you for your purchase! Your payment has been
                confirmed and your Budget Tracker Excel file is
                ready to download.
            </p>

            {{-- File chip --}}

            <div class="mx-auto mt-4 flex max-w-[240px] items-center
                        gap-2.5 rounded-lg border bg-gray-50 p-3 text-left">
                <svg class="h-8 w-8 flex-shrink-0 text-[#4b6a53]" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M9 17v-6h6v6m-9 4h12a2 2 0 002-2V7l-4-4H6a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                <span class="min-w-0">
                    <span class="block truncate text-sm font-medium text-gray-700">
                        Budget-Tracker.xlsx
                    </span>
                    <span class="block text-xs text-gray-400">Ready to download</span>
                </span>
            </div>

            {{-- =================================================
                 DOWNLOAD BUTTON
            ================================================== --}}

            <a
                href="{{ route('budget.download') }}"
                class="mt-5 flex w-full items-center justify-center gap-2
                       rounded-full bg-[#a04f3f] py-3
                       text-sm font-bold text-white
                       transition hover:bg-[#873f35]
                       focus:outline-none focus-visible:ring-2
                       focus-visible:ring-[#a04f3f]/40
                       focus-visible:ring-offset-2"
            >
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3" />
                </svg>
                Download Excel file
            </a>

            <button
                type="button"
                onclick="closeBudgetPaymentModal()"
                class="mt-3 text-sm text-gray-500 transition hover:text-gray-800"
            >
                Close
            </button>

        </div>

    </div>

</div>



{{-- =============================================================
     BUDGET TRACKER PAYMENT JAVASCRIPT
============================================================= --}}

<script>

document.addEventListener("DOMContentLoaded", function () {

    /* =========================================================
       VARIABLES
    ========================================================== */

    let currentCheckoutId = null;

    let pollingInterval = null;

    let pollCount = 0;

    const maxPolls = 30;

    let currentAmount = 0;



    /* =========================================================
       ELEMENTS
    ========================================================== */

    const modal = document.getElementById("budgetPaymentModal");

    const card = document.getElementById("budgetPaymentCard");

    const phoneInput = document.getElementById("budgetMpesaPhone");

    const payButton = document.getElementById("budgetPayButton");

    const payButtonLabel = document.getElementById("budgetPayButtonLabel");

    const payButtonSpinner = document.getElementById("budgetPayButtonSpinner");

    const paymentForm = document.getElementById("budgetPaymentForm");

    const downloadSection = document.getElementById("budgetDownloadSection");

    const stepDots = [
        document.getElementById("budgetStepDot1"),
        document.getElementById("budgetStepDot2"),
        document.getElementById("budgetStepDot3"),
    ];

    const stepLines = [
        document.getElementById("budgetStepLine1"),
        document.getElementById("budgetStepLine2"),
    ];



    /* =========================================================
       STEP INDICATOR
    ========================================================== */

    function setBudgetStep(activeIndex) {

        stepDots.forEach(function (dot, index) {

            dot.className = index <= activeIndex
                ? "h-2 w-2 rounded-full bg-[#a04f3f] transition-colors"
                : "h-2 w-2 rounded-full bg-gray-200 transition-colors";

        });

        stepLines.forEach(function (line, index) {

            line.className = index < activeIndex
                ? "h-px w-8 bg-[#a04f3f] transition-colors"
                : "h-px w-8 bg-gray-200 transition-colors";

        });

    }



    /* =========================================================
       PAY BUTTON STATE
    ========================================================== */

    function setPayButtonState(state, amountLabel) {

        if (state === "idle") {

            payButton.disabled = false;

            payButtonSpinner.classList.add("hidden");

            payButtonLabel.textContent = "Pay " + amountLabel + " via M-Pesa";

        }

        else if (state === "sending") {

            payButton.disabled = true;

            payButtonSpinner.classList.remove("hidden");

            payButtonLabel.textContent = "Sending request...";

        }

        else if (state === "waiting") {

            payButton.disabled = true;

            payButtonSpinner.classList.remove("hidden");

            payButtonLabel.textContent = "Waiting for confirmation...";

        }

    }



    /* =========================================================
       OPEN MODAL
    ========================================================== */

    window.openBudgetPaymentModal = function (amount) {

        currentAmount = Number(amount);

        const formattedAmount = "KSH " + currentAmount.toLocaleString("en-US");


        document.getElementById("budgetModalAmount").innerText = formattedAmount;

        document.getElementById("budgetModalProduct").innerText = "Budget Tracker";


        /* Reset form */

        paymentForm.classList.remove("hidden");

        downloadSection.classList.add("hidden");

        phoneInput.value = "";

        phoneInput.classList.remove("border-red-400", "focus:ring-red-200");

        setPayButtonState("idle", formattedAmount);

        setBudgetStep(0);

        hideBudgetMessage();


        /* Reset payment state */

        currentCheckoutId = null;

        pollCount = 0;


        if (pollingInterval) {

            clearInterval(pollingInterval);

            pollingInterval = null;

        }


        /* Open modal */

        modal.classList.remove("hidden");

        document.addEventListener("keydown", handleBudgetEscape);


        setTimeout(function () {

            card.classList.remove("scale-95", "opacity-0");

            card.classList.add("scale-100", "opacity-100");

            phoneInput.focus();

        }, 10);

    };



    /* =========================================================
       CLOSE MODAL
    ========================================================== */

    window.closeBudgetPaymentModal = function () {

        card.classList.add("scale-95", "opacity-0");

        card.classList.remove("scale-100", "opacity-100");


        setTimeout(function () {

            modal.classList.add("hidden");

        }, 200);


        document.removeEventListener("keydown", handleBudgetEscape);


        if (pollingInterval) {

            clearInterval(pollingInterval);

            pollingInterval = null;

        }

    };


    function handleBudgetEscape(event) {

        if (event.key === "Escape") {

            closeBudgetPaymentModal();

        }

    }



    /* =========================================================
       CLICK OUTSIDE MODAL
    ========================================================== */

    modal.addEventListener("click", function (event) {

        if (!card.contains(event.target)) {

            closeBudgetPaymentModal();

        }

    });



    /* =========================================================
       PHONE INPUT — light formatting + live validity
    ========================================================== */

    phoneInput.addEventListener("input", function () {

        phoneInput.value = phoneInput.value.replace(/[^\d+]/g, "");

        phoneInput.classList.remove("border-red-400", "focus:ring-red-200");

    });



    /* =========================================================
       SHOW / HIDE MESSAGE
    ========================================================== */

    function showBudgetMessage(message, type = "info") {

        const box = document.getElementById("budgetPaymentMessage");

        box.className = "mb-4 p-3 rounded-lg text-sm font-medium";

        if (type === "success") {

            box.classList.add("bg-green-100", "text-green-700");

        }

        else if (type === "error") {

            box.classList.add("bg-red-100", "text-red-700");

        }

        else {

            box.classList.add("bg-blue-100", "text-blue-700");

        }

        box.innerText = message;

        box.classList.remove("hidden");

    }


    function hideBudgetMessage() {

        const box = document.getElementById("budgetPaymentMessage");

        box.classList.add("hidden");

        box.innerText = "";

    }



    /* =========================================================
       CHECK PAYMENT STATUS
    ========================================================== */

    async function checkBudgetPaymentStatus() {

        if (!currentCheckoutId) {

            return;

        }

        pollCount++;

        try {

            const response = await fetch(

                `/api/payment-status/${currentCheckoutId}`,

                {
                    method: "GET",
                    headers: { "Accept": "application/json" }
                }

            );

            if (!response.ok) {

                return;

            }

            const data = await response.json();

            console.log("Budget Tracker payment status:", data);


            /* PAYMENT SUCCESS */

            if (data.status === "success") {

                clearInterval(pollingInterval);

                pollingInterval = null;

                setBudgetStep(2);

                paymentForm.classList.add("hidden");

                downloadSection.classList.remove("hidden");

                return;

            }


            /* PAYMENT FAILED */

            if (data.status === "failed") {

                clearInterval(pollingInterval);

                pollingInterval = null;

                showBudgetMessage(
                    "Payment failed or was cancelled. Please try again.",
                    "error"
                );

                setBudgetStep(0);

                setPayButtonState(
                    "idle",
                    "KSH " + currentAmount.toLocaleString()
                );

                return;

            }


            /* TIMEOUT */

            if (pollCount >= maxPolls) {

                clearInterval(pollingInterval);

                pollingInterval = null;

                showBudgetMessage(
                    "Payment confirmation timed out. Please try again.",
                    "error"
                );

                setBudgetStep(0);

                setPayButtonState(
                    "idle",
                    "KSH " + currentAmount.toLocaleString()
                );

            }

        }

        catch (error) {

            console.error("Budget Tracker payment polling error:", error);

        }

    }



    /* =========================================================
       PAY BUTTON
    ========================================================== */

    payButton.addEventListener("click", async function () {

        const phone = phoneInput.value.trim();

        const formattedAmount = "KSH " + currentAmount.toLocaleString();


        /* VALIDATE PHONE */

        if (!/^(\+254[17]\d{8}|0[17]\d{8})$/.test(phone)) {

            showBudgetMessage("Enter a valid M-Pesa phone number.", "error");

            phoneInput.classList.add("border-red-400", "focus:ring-red-200");

            phoneInput.focus();

            return;

        }

        if (currentAmount <= 0) {

            showBudgetMessage("Invalid payment amount.", "error");

            return;

        }


        setPayButtonState("sending", formattedAmount);

        showBudgetMessage("Sending payment request...");


        let response;

        let data;


        /* SEND STK PUSH */

        try {

            response = await fetch(

                "/api/mpesa/stk/initiate",

                {
                    method: "POST",

                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },

                    body: JSON.stringify({
                        phone: phone,
                        amount: currentAmount,
                        account_reference: "BUDGET",
                        description: "Budget Tracker"
                    })
                }

            );

        }

        catch (error) {

            console.error("STK request error:", error);

            showBudgetMessage("Check your connection and try again.", "error");

            setPayButtonState("idle", formattedAmount);

            return;

        }


        /* READ RESPONSE */

        try {

            data = await response.json();

        }

        catch (error) {

            showBudgetMessage("Invalid response from payment service.", "error");

            setPayButtonState("idle", formattedAmount);

            return;

        }


        /* HANDLE SERVER ERROR */

        if (!response.ok) {

            showBudgetMessage(
                data.message || "Payment service is currently unavailable.",
                "error"
            );

            setPayButtonState("idle", formattedAmount);

            return;

        }


        /* CHECK CHECKOUT REQUEST ID */

        if (data.checkout_request_id) {

            currentCheckoutId = data.checkout_request_id;

            pollCount = 0;

            setBudgetStep(1);

            showBudgetMessage(
                "Payment request sent! Check your phone and enter your M-Pesa PIN.",
                "success"
            );

            setPayButtonState("waiting", formattedAmount);


            if (pollingInterval) {

                clearInterval(pollingInterval);

            }

            pollingInterval = setInterval(checkBudgetPaymentStatus, 3000);

        }

        else {

            showBudgetMessage(
                "Payment request could not be started. Please try again.",
                "error"
            );

            setPayButtonState("idle", formattedAmount);

        }

    });

});

</script>

@endsection
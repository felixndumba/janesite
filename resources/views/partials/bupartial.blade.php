@extends('layouts.app')

@section('title', 'Budget Tracker | Thedi Advisors')

@section('content')

<section class="min-h-screen bg-[#fdf9f6] py-20">

    <div class="mx-auto max-w-7xl px-6 lg:px-8">

        {{-- Page Header --}}
        <div class="mx-auto max-w-3xl text-center mb-14">

            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-[#a04f3f] mb-4">
                Financial Tools
            </p>

            <h1 class="text-4xl sm:text-5xl font-semibold tracking-tight text-[#3a231c]">
                Practical Financial Trackers
            </h1>

            <p class="mt-5 text-base sm:text-lg text-[#3a231c]/60">
                Simple Excel tools designed to help you manage your money,
                track your progress and make better financial decisions.
            </p>

        </div>


        {{-- Single Budget Tracker --}}
        <div class="mx-auto max-w-md">

            <article
                class="flex flex-col rounded-2xl bg-white p-6 shadow-sm
                       ring-1 ring-[#3a231c]/5
                       transition duration-300
                       hover:-translate-y-1 hover:shadow-xl"
            >

                {{-- Product Header --}}
                <div class="mb-6">

                    <div class="flex items-center justify-between">

                        <span
                            class="inline-flex rounded-full
                                   bg-[#a04f3f]/10 px-3 py-1
                                   text-[11px] font-semibold uppercase
                                   tracking-wider text-[#a04f3f]"
                        >
                            Financial Tool
                        </span>

                        <span class="text-lg font-bold text-[#3a231c]">
                            KSh {{ number_format($products->first()->price) }}
                        </span>

                    </div>

                </div>


                {{-- Product Name --}}
                <h2 class="text-2xl font-bold text-[#3a231c]">
                    Budget Tracker
                </h2>


                {{-- Product Description --}}
                <p class="mt-3 text-sm leading-relaxed text-[#3a231c]/60 flex-grow">
                    A practical Excel budget tracker designed to help you
                    manage your income, expenses, savings and overall
                    financial progress with ease.
                </p>


                {{-- Buttons --}}
                <div class="mt-6 flex gap-3">

                    {{-- Preview --}}
                    <a
                        href="{{ route('budget.preview', $products->first()) }}"
                        target="_blank"
                        class="flex-1 rounded-full border border-[#a04f3f]/30
                               px-4 py-3 text-center text-xs font-semibold
                               uppercase tracking-wider text-[#a04f3f]
                               transition hover:bg-[#a04f3f]/5"
                    >
                        Preview
                    </a>


                    {{-- Purchase --}}
                    <button
                        type="button"
                        onclick="openPurchaseModal(
                            {{ $products->first()->id }},
                            'Budget Tracker',
                            {{ $products->first()->price }}
                        )"
                        class="flex-1 rounded-full bg-[#a04f3f]
                               px-4 py-3 text-xs font-semibold
                               uppercase tracking-wider text-white
                               transition hover:bg-[#873f35]"
                    >
                        Purchase
                    </button>

                </div>

            </article>

        </div>

    </div>

</section>


{{-- ========================================================= --}}
{{-- PURCHASE MODAL --}}
{{-- ========================================================= --}}

<div
    id="purchaseModal"
    class="fixed inset-0 z-[99999] hidden items-center justify-center
           bg-black/60 px-4 backdrop-blur-sm"
>

    <div
        class="w-full max-w-md rounded-3xl bg-white p-7 shadow-2xl"
    >

        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6">

            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-[#a04f3f]">
                    Purchase
                </p>

                <h3
                    id="purchaseProductName"
                    class="mt-1 text-xl font-bold text-[#3a231c]"
                ></h3>

            </div>


            {{-- Close Button --}}
            <button
                type="button"
                onclick="closePurchaseModal()"
                class="text-2xl text-gray-400 hover:text-gray-700"
            >
                &times;
            </button>

        </div>


        {{-- Price --}}
        <div class="mb-6 rounded-2xl bg-[#fdf9f6] p-4">

            <div class="flex justify-between">

                <span class="text-sm text-gray-500">
                    Price
                </span>

                <strong
                    id="purchaseProductPrice"
                    class="text-[#3a231c]"
                ></strong>

            </div>

        </div>


        {{-- Purchase Form --}}
        <form id="purchaseForm">

            @csrf

            {{-- Product ID --}}
            <input
                type="hidden"
                id="product_id"
                name="product_id"
            >


            {{-- Customer Name --}}
            <div class="mb-4">

                <label
                    class="mb-2 block text-sm font-medium text-[#3a231c]"
                >
                    Name
                </label>

                <input
                    type="text"
                    name="customer_name"
                    required
                    autocomplete="name"
                    class="w-full rounded-xl border border-gray-200
                           px-4 py-3 outline-none
                           focus:border-[#a04f3f]
                           focus:ring-1 focus:ring-[#a04f3f]"
                >

            </div>


            {{-- Customer Email --}}
            <div class="mb-4">

                <label
                    class="mb-2 block text-sm font-medium text-[#3a231c]"
                >
                    Email
                </label>

                <input
                    type="email"
                    name="customer_email"
                    required
                    autocomplete="email"
                    class="w-full rounded-xl border border-gray-200
                           px-4 py-3 outline-none
                           focus:border-[#a04f3f]
                           focus:ring-1 focus:ring-[#a04f3f]"
                >

            </div>


            {{-- M-Pesa Phone --}}
            <div class="mb-6">

                <label
                    class="mb-2 block text-sm font-medium text-[#3a231c]"
                >
                    M-Pesa Phone Number
                </label>

                <input
                    type="text"
                    name="customer_phone"
                    placeholder="07XXXXXXXX"
                    required
                    autocomplete="tel"
                    inputmode="numeric"
                    class="w-full rounded-xl border border-gray-200
                           px-4 py-3 outline-none
                           focus:border-[#a04f3f]
                           focus:ring-1 focus:ring-[#a04f3f]"
                >

                <p class="mt-2 text-xs text-gray-400">
                    Enter the number you will use to complete the M-Pesa payment.
                </p>

            </div>


            {{-- Success / Error Message --}}
            <div
                id="purchaseMessage"
                class="hidden mb-4 rounded-xl p-3 text-sm"
            ></div>


            {{-- Submit --}}
            <button
                type="submit"
                id="purchaseButton"
                class="w-full rounded-full bg-[#a04f3f]
                       px-6 py-3.5 text-sm font-semibold
                       uppercase tracking-wider text-white
                       transition hover:bg-[#873f35]
                       disabled:cursor-not-allowed
                       disabled:opacity-60"
            >
                Pay with M-Pesa
            </button>

        </form>

    </div>

</div>


{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

<script>

    /**
     * Open Purchase Modal
     */
    function openPurchaseModal(id, name, price)
    {
        const modal = document.getElementById('purchaseModal');

        const productId = document.getElementById('product_id');

        const productName = document.getElementById('purchaseProductName');

        const productPrice = document.getElementById('purchaseProductPrice');

        const message = document.getElementById('purchaseMessage');

        const button = document.getElementById('purchaseButton');


        // Set product information
        productId.value = id;

        productName.textContent = name;

        productPrice.textContent =
            'KSh ' + Number(price).toLocaleString();


        // Reset message
        message.textContent = '';

        message.classList.add('hidden');

        message.classList.remove(
            'bg-red-100',
            'text-red-700',
            'bg-green-100',
            'text-green-700'
        );


        // Reset button
        button.disabled = false;

        button.textContent = 'Pay with M-Pesa';


        // Show modal
        modal.classList.remove('hidden');

        modal.classList.add('flex');


        // Prevent background scrolling
        document.body.classList.add('overflow-hidden');
    }


    /**
     * Close Purchase Modal
     */
    function closePurchaseModal()
    {
        const modal = document.getElementById('purchaseModal');

        modal.classList.add('hidden');

        modal.classList.remove('flex');

        document.body.classList.remove('overflow-hidden');
    }


    /**
     * Close modal when clicking outside
     */
    document.getElementById('purchaseModal').addEventListener(
        'click',
        function(event)
        {
            if (event.target === this) {
                closePurchaseModal();
            }
        }
    );


    /**
     * Close modal with Escape key
     */
    document.addEventListener(
        'keydown',
        function(event)
        {
            if (event.key === 'Escape') {
                closePurchaseModal();
            }
        }
    );


    /**
     * Purchase Form Submission
     */
    document.getElementById('purchaseForm').addEventListener(
        'submit',
        async function(event)
        {
            event.preventDefault();


            const form = this;

            const button =
                document.getElementById('purchaseButton');

            const message =
                document.getElementById('purchaseMessage');


            // Disable button
            button.disabled = true;

            button.textContent = 'Processing...';


            // Hide previous message
            message.classList.add('hidden');

            message.classList.remove(
                'bg-red-100',
                'text-red-700',
                'bg-green-100',
                'text-green-700'
            );


            try {

                const response = await fetch(
                    "{{ route('budget.purchase') }}",
                    {
                        method: 'POST',

                        headers: {

                            'X-CSRF-TOKEN':
                                document.querySelector(
                                    'meta[name="csrf-token"]'
                                ).content,

                            'Accept': 'application/json',

                        },

                        body: new FormData(form)
                    }
                );


                const data = await response.json();


                // Handle failed response
                if (!response.ok) {

                    throw new Error(
                        data.message ||
                        'Something went wrong. Please try again.'
                    );

                }


                // Show success message
                message.textContent =
                    data.message ||
                    'Payment request sent. Please check your phone and complete the M-Pesa payment.';


                message.classList.remove('hidden');

                message.classList.add(
                    'bg-green-100',
                    'text-green-700'
                );


                // Update button
                button.textContent =
                    'Payment Request Sent';


            } catch (error) {

                console.error(error);


                // Show error
                message.textContent =
                    error.message ||
                    'Unable to process your purchase. Please try again.';


                message.classList.remove('hidden');

                message.classList.add(
                    'bg-red-100',
                    'text-red-700'
                );


                // Re-enable button
                button.disabled = false;

                button.textContent =
                    'Pay with M-Pesa';

            }

        }
    );

</script>

@endsection
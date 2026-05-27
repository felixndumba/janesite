<style>
    /* =========================
       MICRO INTERACTIONS
    ========================== */

    .star-btn svg {
        transition:
            transform 0.15s cubic-bezier(0.4, 0, 0.2, 1),
            fill 0.15s;
    }

    .star-btn:hover svg {
        transform: scale(1.15);
    }

    /* =========================
       HIDDEN SPAM FIELD
    ========================== */

    .hidden-security-gate {
        display: none !important;
        visibility: hidden;
    }

    /* =========================
       HIDE SCROLLBAR
    ========================== */

    #reviewsContainer::-webkit-scrollbar {
        display: none;
    }

    #reviewsContainer {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    /* =========================
       MOBILE IMPROVEMENTS
    ========================== */

    @media (max-width: 640px) {

        #reviewsContainer {
            padding-left: 16px;
            padding-right: 16px;
        }

    }
</style>

<section class="py-20 relative overflow-hidden bg-[#f8f7f5]">

    <!-- FLOATING DOTS -->
    <div class="absolute top-20 left-10 w-4 h-4 bg-blue-400 rounded-full"></div>
    <div class="absolute top-40 left-32 w-3 h-3 bg-green-400 rounded-full"></div>
    <div class="absolute top-24 right-40 w-4 h-4 bg-red-400 rounded-full"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        <!-- HEADER -->
        <div class="text-center mb-14">

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-800 mb-5">
                WHAT OUR CLIENTS SAY
            </h1>

            <p class="text-gray-500 max-w-2xl mx-auto text-base sm:text-lg leading-8">
                Trusted by clients for reliable financial advisory,
                investment guidance and professional consultation services.
            </p>

        </div>

        <!-- BUTTON -->
        <div class="flex justify-center mb-14">

            <button
                type="button"
                onclick="openModal()"
                class="bg-black text-white px-8 py-4 rounded-full hover:scale-105 transition duration-300 shadow-xl text-sm sm:text-base">

                Click Here To Leave A Review

            </button>

        </div>

        <!-- =========================
             REVIEWS CAROUSEL
        ========================== -->

        <div class="relative overflow-hidden">

            <!-- PREV -->
            <button
                type="button"
                aria-label="Previous reviews"
                onclick="reviewsPrev()"
                class="hidden lg:flex absolute left-0 top-1/2 -translate-y-1/2 z-10 items-center justify-center w-12 h-12 rounded-full bg-white shadow border border-gray-100">

                <span class="text-2xl">‹</span>

            </button>

            <!-- NEXT -->
            <button
                type="button"
                aria-label="Next reviews"
                onclick="reviewsNext()"
                class="hidden lg:flex absolute right-0 top-1/2 -translate-y-1/2 z-10 items-center justify-center w-12 h-12 rounded-full bg-white shadow border border-gray-100">

                <span class="text-2xl">›</span>

            </button>

            <!-- SCROLLER -->
            <div
                id="reviewsContainer"
                class="flex gap-5 overflow-x-auto snap-x snap-mandatory scroll-smooth pb-4">

                @foreach($reviews as $review)

                    @php
                        $nameParts = preg_split('/\s+/', trim($review->name));

                        $first = $nameParts[0] ?? '';
                        $second = $nameParts[1] ?? '';

                        $initials = strtoupper(
                            substr($first,0,1) .
                            substr($second,0,1)
                        );

                        if(strlen($initials) < 2){
                            $initials = strtoupper(substr(
                                preg_replace('/[^A-Za-z]/', '', $review->name),
                                0,
                                2
                            ));
                        }

                        $hash = crc32($review->name ?? '');

                        $bg = [
                            'bg-indigo-100',
                            'bg-purple-100',
                            'bg-pink-100',
                            'bg-emerald-100',
                            'bg-teal-100',
                            'bg-sky-100',
                            'bg-amber-100',
                            'bg-orange-100',
                            'bg-rose-100'
                        ][$hash % 9];

                        $text = [
                            'text-indigo-700',
                            'text-purple-700',
                            'text-pink-700',
                            'text-emerald-700',
                            'text-teal-700',
                            'text-sky-700',
                            'text-amber-700',
                            'text-orange-700',
                            'text-rose-700'
                        ][$hash % 9];
                    @endphp

                    <!-- REVIEW CARD -->
                    <div
                        id="review-{{ $review->id }}"
                        class="
                            snap-start
                            flex-shrink-0

                            w-[320px]
                            min-w-[320px]

                            sm:w-[420px]
                            sm:min-w-[420px]

                            md:w-[460px]
                            md:min-w-[460px]

                            lg:w-[360px]
                            lg:min-w-[360px]

                            bg-white
                            rounded-3xl
                            border border-gray-100
                            shadow-sm

                            p-6 sm:p-8

                            transition
                            duration-300
                            hover:-translate-y-2
                        ">

                        <!-- STARS -->
                        <div class="flex gap-1 mb-4 flex-wrap">

                            @for($i = 0; $i < $review->rating; $i++)

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    class="w-5 h-5 text-yellow-400">

                                    <path
                                        fill-rule="evenodd"
                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                        clip-rule="evenodd" />

                                </svg>

                            @endfor

                        </div>

                        <!-- MESSAGE -->
                        <p
                            class="
                                text-gray-600
                                text-sm sm:text-base
                                leading-7
                                mb-8

                                break-words
                                whitespace-normal
                                line-clamp-5
                            "
                            style="display: -webkit-box; -webkit-line-clamp: 5; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $review->message }}

                        <!-- USER -->
                        <div class="flex items-center gap-3">

                            <!-- AVATAR -->
                            <div class="w-12 h-12 rounded-full {{ $bg }} border border-gray-200 flex items-center justify-center flex-shrink-0">

                                <span class="{{ $text }} font-bold text-sm">
                                    {{ $initials }}
                                </span>

                            </div>

                            <!-- INFO -->
                            <div class="min-w-0">

                                <h3 class="font-bold text-gray-800 text-base sm:text-lg truncate">
                                    {{ $review->name }}
                                </h3>

                                <p class="text-gray-400 text-sm truncate">
                                    {{ $review->organisation }}
                                </p>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</section>

<!-- =========================
     REVIEW MODAL
========================== -->

<div
    id="reviewModal"
    class="fixed inset-0 bg-black/60 hidden justify-center items-center z-50 p-4">

    <div class="bg-white w-full max-w-lg rounded-2xl p-6 sm:p-8 relative shadow-2xl">

        <!-- CLOSE -->
        <button
            onclick="closeModal()"
            class="absolute top-4 right-4 text-2xl text-gray-400 hover:text-black transition">

            ×

        </button>

        <h2 class="text-2xl sm:text-3xl font-bold mb-2 text-center">
            Leave A Review
        </h2>

        <p class="text-center text-sm text-gray-400 mb-6">
            No registration required. Share your feedback below.
        </p>

        <form id="reviewForm">

            <!-- HONEYPOT -->
            <div class="hidden-security-gate">

                <label for="address_verification_field">
                    Leave empty
                </label>

                <input
                    type="text"
                    id="address_verification_field"
                    autocomplete="off">

            </div>

            <!-- NAME -->
            <input
                type="text"
                id="name"
                placeholder="Your Name"
                class="w-full border border-gray-300 p-4 rounded-xl mb-4 focus:outline-none focus:ring-2 focus:ring-black"
                required>

            <!-- ORGANISATION -->
            <input
                type="text"
                id="organisation"
                placeholder="Your Organisation (Optional)"
                class="w-full border border-gray-300 p-4 rounded-xl mb-4 focus:outline-none focus:ring-2 focus:ring-black">

            <!-- RATING -->
            <div class="mb-5 text-center">

                <label class="block text-sm font-medium text-gray-500 mb-2">
                    Overall Quality Rating
                </label>

                <div
                    class="flex justify-center gap-2 flex-wrap"
                    id="starWidgetContainer">

                    <input type="hidden" id="rating" value="5">

                    @for($i = 1; $i <= 5; $i++)

                        <button
                            type="button"
                            onclick="setRatingValue({{ $i }})"
                            class="star-btn text-yellow-400"
                            data-index="{{ $i }}">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                                class="w-8 h-8">

                                <path
                                    fill-rule="evenodd"
                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                    clip-rule="evenodd"/>

                            </svg>

                        </button>

                    @endfor

                </div>

            </div>

            <!-- MESSAGE -->
            <textarea
                id="message"
                rows="4"
                placeholder="Write your feedback..."
                class="w-full border border-gray-300 p-4 rounded-xl mb-6 focus:outline-none focus:ring-2 focus:ring-black"
                required></textarea>

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full bg-black text-white py-4 rounded-xl hover:bg-gray-800 transition duration-300 font-medium tracking-wide">

                Publish Review

            </button>

        </form>

    </div>

</div>

<script>

    /* =========================
       MODAL
    ========================== */

    window.openModal = function () {

        const modal = document.getElementById('reviewModal');

        if (!modal) return;

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        setRatingValue(5);
    };

    window.closeModal = function () {

        const modal = document.getElementById('reviewModal');

        if (!modal) return;

        modal.classList.remove('flex');
        modal.classList.add('hidden');
    };

    /* =========================
       CAROUSEL
    ========================== */

    window.reviewsPrev = function () {

        const scroller = document.getElementById('reviewsContainer');

        if (!scroller) return;

        const firstItem = scroller.querySelector('[id^="review-"]');

        const delta =
            firstItem
                ? firstItem.getBoundingClientRect().width + 20
                : 320;

        scroller.scrollBy({
            left: -delta,
            behavior: 'smooth'
        });
    };

    window.reviewsNext = function () {

        const scroller = document.getElementById('reviewsContainer');

        if (!scroller) return;

        const firstItem = scroller.querySelector('[id^="review-"]');

        const delta =
            firstItem
                ? firstItem.getBoundingClientRect().width + 20
                : 320;

        scroller.scrollBy({
            left: delta,
            behavior: 'smooth'
        });
    };

    /* =========================
       DRAG TO SCROLL
    ========================== */

    (function enableDragToScroll() {

        const scroller = document.getElementById('reviewsContainer');

        if (!scroller) return;

        let isDown = false;
        let startX = 0;
        let scrollLeft = 0;

        scroller.addEventListener('pointerdown', (e) => {

            isDown = true;

            scroller.setPointerCapture(e.pointerId);

            startX = e.pageX;
            scrollLeft = scroller.scrollLeft;
        });

        scroller.addEventListener('pointermove', (e) => {

            if (!isDown) return;

            const dx = e.pageX - startX;

            scroller.scrollLeft = scrollLeft - dx;
        });

        scroller.addEventListener('pointerup', () => {
            isDown = false;
        });

        scroller.addEventListener('pointercancel', () => {
            isDown = false;
        });

    })();

    /* =========================
       STAR RATING
    ========================== */

    function setRatingValue(rating) {

        document.getElementById('rating').value = rating;

        const starButtons =
            document.querySelectorAll(
                '#starWidgetContainer .star-btn'
            );

        starButtons.forEach(btn => {

            const index =
                parseInt(btn.getAttribute('data-index'));

            if (index <= rating) {

                btn.classList.remove('text-gray-300');
                btn.classList.add('text-yellow-400');

            } else {

                btn.classList.remove('text-yellow-400');
                btn.classList.add('text-gray-300');
            }
        });
    }

    /* =========================
       FORM SUBMIT
    ========================== */

    const reviewFormEl =
        document.getElementById('reviewForm');

    if (reviewFormEl) {

        reviewFormEl.addEventListener(
            'submit',
            async function (e) {

                e.preventDefault();

                const honeypotEl =
                    document.getElementById(
                        'address_verification_field'
                    );

                const honeypotVal =
                    honeypotEl
                        ? honeypotEl.value
                        : '';

                if (honeypotVal.length > 0) {
                    return;
                }

                const formData = {

                    name:
                        document.getElementById('name').value,

                    organisation:
                        document.getElementById('organisation').value ||
                        'Independent Client',

                    rating:
                        document.getElementById('rating').value,

                    message:
                        document.getElementById('message').value
                };

                try {

                    const csrfMeta =
                        document.querySelector(
                            'meta[name="csrf-token"]'
                        );

                    const csrfToken =
                        csrfMeta
                            ? csrfMeta.content
                            : null;

                    const headers = {
                        'Content-Type': 'application/json'
                    };

                    if (csrfToken) {
                        headers['X-CSRF-TOKEN'] = csrfToken;
                    }

                    const response = await fetch('/reviews', {
                        method: 'POST',
                        headers,
                        body: JSON.stringify(formData)
                    });

                    const data = await response.json();

                    if (data.success) {

                        location.reload();

                    }

                } catch (err) {

                    console.error(err);

                }

            }
        );
    }

</script>
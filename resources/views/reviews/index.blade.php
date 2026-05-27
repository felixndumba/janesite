<style>
    /* Modern micro-interactions for the star rating widget */

    .star-btn svg {
        transition: transform 0.15s cubic-bezier(0.4, 0, 0.2, 1), fill 0.15s;
    }
    .star-btn:hover svg {
        transform: scale(1.15);
    }
    /* Anti-Spam Field Styling */
    .hidden-security-gate {
        display: none !important;
        visibility: hidden;
    }
</style>

<section class="py-24 relative">

    <!-- FLOATING DOTS -->
    <div class="absolute top-20 left-10 w-4 h-4 bg-blue-400 rounded-full"></div>
    <div class="absolute top-40 left-32 w-3 h-3 bg-green-400 rounded-full"></div>
    <div class="absolute top-24 right-40 w-4 h-4 bg-red-400 rounded-full"></div>

    <div class="max-w-7xl mx-auto px-6">
        <!-- HEADER -->
        <div class="text-center mb-16">
            <h1 class="text-5xl font-bold text-gray-800 mb-5">WHAT OUR CLIENTS SAY</h1>
            <p class="text-gray-500 max-w-2xl mx-auto text-lg">
                Trusted by clients for reliable financial advisory, investment guidance and professional consultation services.
            </p>
        </div>

        <!-- BUTTON -->
        <div class="flex justify-center mb-14">
            <button type="button" onclick="openModal()" class="bg-black text-white px-8 py-4 rounded-full hover:scale-105 transition duration-300 shadow-xl">
                Click Here To Leave A Review
            </button>
        </div>

        <!-- REVIEWS CAROUSEL (3 visible on desktop, 1 on mobile) -->
        <div class="relative">
            <!-- Arrows (hidden on small screens) -->
            <button
                type="button"
                aria-label="Previous reviews"
                onclick="reviewsPrev()"
                class="hidden md:flex absolute -left-6 top-1/2 -translate-y-1/2 z-10 items-center justify-center w-12 h-12 rounded-full bg-white shadow hover:bg-gray-50 border border-gray-100">
                <span aria-hidden class="text-2xl">‹</span>
            </button>
            <button
                type="button"
                aria-label="Next reviews"
                onclick="reviewsNext()"
                class="hidden md:flex absolute -right-6 top-1/2 -translate-y-1/2 z-10 items-center justify-center w-12 h-12 rounded-full bg-white shadow hover:bg-gray-50 border border-gray-100">
                <span aria-hidden class="text-2xl">›</span>
            </button>

            <div
                id="reviewsContainer"
                class="flex overflow-x-auto scroll-snap-x mandatory scroll-px-6 gap-6 pb-4 scrollbar-hide snap-x"
                style="scrollbar-width: none; -ms-overflow-style: none;">

                @foreach($reviews as $review)
                    @php
                        $nameParts = preg_split('/\s+/', trim($review->name));
                        $first = $nameParts[0] ?? '';
                        $second = $nameParts[1] ?? '';
                        $initials = strtoupper(substr($first, 0, 1) . substr($second, 0, 1));
                        if (strlen($initials) < 2) {
                            $initials = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $review->name), 0, 2));
                        }
                    @endphp

                    <div
                        id="review-{{ $review->id }}"
                        class="scroll-snap-align-start flex-shrink-0 w-[calc((100%-12px)/3)] md:w-[calc((100%-12px)/3)] sm:w-[min(85vw,420px)] lg:w-[calc((100%-24px)/3)] bg-white p-8 hover:-translate-y-2 transition duration-300 border border-gray-100 rounded-2xl">

                        <!-- STARS DISPLAY -->
                        <div class="flex gap-1 mb-5">
                            @for($i = 0; $i < $review->rating; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-yellow-400 drop-shadow-sm">
                                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                </svg>
                            @endfor
                        </div>

                        <!-- MESSAGE -->
                        <p class="text-gray-600 leading-8 mb-8 break-words break-all whitespace-normal">{{ $review->message }}</p>

                        <!-- USER INFO + AVATAR -->
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
@php
                            $hash = crc32($review->name ?? '');
                            $bg = ['bg-indigo-100','bg-purple-100','bg-pink-100','bg-emerald-100','bg-teal-100','bg-sky-100','bg-amber-100','bg-orange-100','bg-rose-100'][$hash % 9];
                            $text = ['text-indigo-700','text-purple-700','text-pink-700','text-emerald-700','text-teal-700','text-sky-700','text-amber-700','text-orange-700','text-rose-700'][$hash % 9];
                        @endphp
                        <div class="w-11 h-11 rounded-full {{ $bg }} border border-gray-200 flex items-center justify-center">
                                    <span class="{{ $text }} font-bold text-sm">{{ $initials }}</span>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-gray-800">{{ $review->name }}</h3>
                                    <p class="text-gray-400 text-sm">{{ $review->organisation }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- MODAL POPUP -->
<div id="reviewModal" class="fixed inset-0 bg-black/60 hidden justify-center items-center z-50 p-4">
    <div class="bg-white w-full max-w-lg rounded-2xl p-8 relative shadow-2xl">
        <!-- CLOSE BUTTON -->
        <button onclick="closeModal()" class="absolute top-4 right-4 text-2xl text-gray-400 hover:text-black transition">×</button>

        <h2 class="text-3xl font-bold mb-2 text-center">Leave A Review</h2>
        <p class="text-center text-sm text-gray-400 mb-6">No registration required. Share your  feedback below.</p>

        <form id="reviewForm">
            <!-- ANTI-SPAM HONEYPOT GATE (Hidden from human eyes) -->
            <div class="hidden-security-gate">
                <label for="address_verification_field">Leave empty</label>
                <input type="text" id="address_verification_field" autocomplete="off">
            </div>

            <!-- NAME -->
            <input type="text" id="name" placeholder="Your Name " class="w-full border border-gray-300 p-4 rounded-xl mb-4 focus:outline-none focus:ring-2 focus:ring-black" required>

            <!-- ORGANISATION -->
            <input type="text" id="organisation" placeholder="Your Organisation (Optional)" class="w-full border border-gray-300 p-4 rounded-xl mb-4 focus:outline-none focus:ring-2 focus:ring-black">

            <!-- INTERACTIVE RATING WIDGET -->
            <div class="mb-5 text-center">
                <label class="block text-sm font-medium text-gray-500 mb-2">Overall Quality Rating</label>
                <div class="flex justify-center gap-2" id="starWidgetContainer">
                    <input type="hidden" id="rating" value="5">
                    <!-- Dynamic Star UI Selection Nodes -->
                    <button type="button" onclick="setRatingValue(1)" class="star-btn text-yellow-400" data-index="1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd"/></svg></button>
                    <button type="button" onclick="setRatingValue(2)" class="star-btn text-yellow-400" data-index="2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd"/></svg></button>
                    <button type="button" onclick="setRatingValue(3)" class="star-btn text-yellow-400" data-index="3"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd"/></svg></button>
                    <button type="button" onclick="setRatingValue(4)" class="star-btn text-yellow-400" data-index="4"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd"/></svg></button>
                    <button type="button" onclick="setRatingValue(5)" class="star-btn text-yellow-400" data-index="5"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd"/></svg></button>
                </div>
            </div>

            <!-- MESSAGE -->
            <textarea id="message" rows="4" placeholder="Write your feedback..." class="w-full border border-gray-300 p-4 rounded-xl mb-6 focus:outline-none focus:ring-2 focus:ring-black" required></textarea>

            <!-- BUTTON -->
            <button type="submit" class="w-full bg-black text-white py-4 rounded-xl hover:bg-gray-800 transition duration-300 font-medium tracking-wide">
                Publish Review
        </form>
    </div>
</div>

<script>
// Ensure modal functions are available globally (onclick uses global scope)
window.openModal = function openModal() {
    const modal = document.getElementById('reviewModal');
    if (!modal) return;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    if (typeof setRatingValue === 'function') {
        setRatingValue(5); // Reset widget selection to default
    }
};

window.closeModal = function closeModal() {
    const modal = document.getElementById('reviewModal');
    if (!modal) return;
    modal.classList.remove('flex');
    modal.classList.add('hidden');
};

window.reviewsPrev = function reviewsPrev() {
    const scroller = document.getElementById('reviewsContainer');
    if (!scroller) return;

    const firstItem = scroller.querySelector('[id^="review-"]');
    const delta = firstItem ? firstItem.getBoundingClientRect().width + 24 : 320;
    scroller.scrollBy({ left: -delta, behavior: 'smooth' });
}

function reviewsNext() {
    const scroller = document.getElementById('reviewsContainer');
    if (!scroller) return;

    const firstItem = scroller.querySelector('[id^="review-"]');
    const delta = firstItem ? firstItem.getBoundingClientRect().width + 24 : 320;
    scroller.scrollBy({ left: delta, behavior: 'smooth' });
}

// Enhance drag-to-scroll for touch/mouse (mobile swipe)
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

// Interactive Star Input Widget Logic
function setRatingValue(rating) {
    document.getElementById('rating').value = rating;
    const starButtons = document.querySelectorAll('#starWidgetContainer .star-btn');

    starButtons.forEach(btn => {
        const index = parseInt(btn.getAttribute('data-index'));
        if (index <= rating) {
            btn.classList.remove('text-gray-300');
            btn.classList.add('text-yellow-400');
        } else {
            btn.classList.remove('text-yellow-400');
            btn.classList.add('text-gray-300');
        }
    });
}

document.getElementById('reviewForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    // Spam Checking Guardrail
    const honeypotVal = document.getElementById('address_verification_field').value;
    if (honeypotVal.length > 0) {
        console.warn('Bot submission blocked.');
        return;
    }

    const formData = {
        name: document.getElementById('name').value,
        organisation: document.getElementById('organisation').value || 'Independent Client',
        rating: document.getElementById('rating').value,
        message: document.getElementById('message').value
    };

    try {
        const response = await fetch('/reviews', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(formData)
        });

        const data = await response.json();

        if (data.success) {
            const review = data.review;
            let dynamicStarsMarkup = '';

            // Generate clean vector stars to match the Blade loop layout perfectly
            for (let i = 0; i < review.rating; i++) {
                dynamicStarsMarkup += `
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-yellow-400 drop-shadow-sm">
                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                    </svg>`;
            }

            const name = (review.name || '').trim();
            const parts = name.split(/\s+/).filter(Boolean);
            const first = parts[0] ? parts[0][0] : '';
            const second = parts[1] ? parts[1][0] : '';
            const initials = (first + second).toUpperCase().replace(/[^A-Z]/g,'') || name.substring(0,2).toUpperCase();

            const reviewHTML = `
                <div id="review-${review.id}" class="scroll-snap-align-start flex-shrink-0 w-[calc((100%-12px)/3)] md:w-[calc((100%-12px)/3)] sm:w-[min(85vw,420px)] lg:w-[calc((100%-24px)/3)] bg-white p-8 hover:-translate-y-2 transition duration-300 border border-gray-100 rounded-2xl">
                    <div class="flex gap-1 mb-5">
                        ${dynamicStarsMarkup}
                    </div>
                    <p class="text-gray-600 leading-8 mb-8 break-words break-all whitespace-normal">
                       ${escapeHtml(review.message)} 
                    </p>
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center">
                                <span class="text-gray-700 font-bold text-sm">${escapeHtml(initials)}</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-gray-800">${escapeHtml(review.name)}</h3>
                                <p class="text-gray-400 text-sm">${escapeHtml(review.organisation)}</p>
                            </div>
                        </div>
                    </div>
                </div>`;

            document.getElementById('reviewsContainer').insertAdjacentHTML('afterbegin', reviewHTML);
            document.getElementById('reviewForm').reset();
            closeModal();
        }
    } catch (err) {
        console.error('Submission failed:', err);
    }
});

// Sanitization utility to keep non-login user submissions secure
function escapeHtml(str) {

    return str
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}
</script>




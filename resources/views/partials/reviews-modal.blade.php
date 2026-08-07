<style>
    .star-btn svg {
        transition:
            transform 0.15s cubic-bezier(0.4, 0, 0.2, 1),
            fill 0.15s;
    }

    .star-btn:hover svg {
        transform: scale(1.15);
    }

    .hidden-security-gate {
        display: none !important;
        visibility: hidden;
    }
</style>

<!-- =========================
     REVIEW MODAL
========================== -->

<div
    id="reviewModal"
    onclick="if (event.target === this) closeModal()"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-4 backdrop-blur-sm">

    <div class="relative w-full max-w-lg rounded-3xl bg-white p-6 shadow-2xl sm:p-8">

        <button
            onclick="closeModal()"
            aria-label="Close"
            class="absolute right-4 top-4 flex h-9 w-9 items-center justify-center rounded-full text-xl text-gray-400 transition hover:bg-gray-100 hover:text-black">
            ×
        </button>

        <div class="mb-6 text-center  ">
           
            <h2 class="mt-3 text-2xl font-extrabold text-gray-900 sm:text-3xl">
               Share Your Experience
            </h2>
            <p class="mt-2 text-sm text-gray-400">
                No registration required. Share your feedback below.
            </p>
        </div>

        <form id="reviewForm">

            <!-- HONEYPOT -->
            <div class="hidden-security-gate">
                <label for="address_verification_field">Leave empty</label>
                <input type="text" id="address_verification_field" autocomplete="off">
            </div>

            <!-- NAME -->
            <input
                type="text"
                id="name"
                placeholder="Your Name"
                class="mb-4 w-full rounded-xl border border-gray-200 bg-gray-50 p-4 text-sm transition focus:border-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-gray-900/10"
                required>

            <!-- ORGANISATION -->
            <input
                type="text"
                id="organisation"
                placeholder="Your Organisation (Optional)"
                class="mb-5 w-full rounded-xl border border-gray-200 bg-gray-50 p-4 text-sm transition focus:border-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-gray-900/10">

            <!-- RATING -->
            <div class="mb-6 rounded-2xl bg-gray-50 py-5 text-center">
                <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-gray-400">
                    Overall Quality Rating
                </label>

                <div class="flex flex-wrap justify-center gap-2" id="starWidgetContainer">
                    <input type="hidden" id="rating" value="5">

                    @for ($i = 1; $i <= 5; $i++)
                        <button
                            type="button"
                            onclick="setRatingValue({{ $i }})"
                            class="star-btn text-yellow-400"
                            data-index="{{ $i }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-8 w-8">
                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd"/>
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
                class="mb-6 w-full rounded-xl border border-gray-200 bg-gray-50 p-4 text-sm leading-6 transition focus:border-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-gray-900/10"
                required></textarea>

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full rounded-xl bg-gray-900 py-4 text-sm font-semibold tracking-wide text-white transition duration-300 hover:bg-black sm:text-base">
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
       STAR RATING
    ========================== */

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

    /* =========================
       FORM SUBMIT
    ========================== */

    const reviewFormEl = document.getElementById('reviewForm');

    if (reviewFormEl) {
        reviewFormEl.addEventListener('submit', async function (e) {
            e.preventDefault();

            const honeypotEl = document.getElementById('address_verification_field');
            const honeypotVal = honeypotEl ? honeypotEl.value : '';

            if (honeypotVal.length > 0) {
                return;
            }

            const formData = {
                name: document.getElementById('name').value,
                organisation: document.getElementById('organisation').value || 'Independent Client',
                rating: document.getElementById('rating').value,
                message: document.getElementById('message').value
            };

            try {
                const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                const csrfToken = csrfMeta ? csrfMeta.content : null;

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
        });
    }

</script>

<style>
    .inline-star-btn svg {
        transition: transform 0.15s cubic-bezier(0.4, 0, 0.2, 1), fill 0.15s;
    }

    .inline-star-btn:hover svg {
        transform: scale(1.15);
    }

    .inline-star-btn:active svg {
        transform: scale(0.95);
    }

    .hidden-security-gate-inline {
        display: none !important;
        visibility: hidden;
    }
</style>

<section class="relative overflow-hidden bg-[#FAF8F5] pb-14 pt-16 sm:pb-16 sm:pt-20">
    <div class="pointer-events-none absolute -top-24 right-0 h-64 w-[28rem] rounded-full bg-[#E2B287]/20 blur-3xl"></div>
    <div class="pointer-events-none absolute inset-0 opacity-[0.035]"
         style="background-image:radial-gradient(#000 1px,transparent 1px);background-size:22px 22px;"></div>

    <div class="relative mx-auto max-w-3xl px-4 sm:px-6">

        {{-- ── Heading ─────────────────────────────────────── --}}
        <div class="mx-auto mb-7 max-w-xl text-center sm:mb-8">
            <span class="inline-flex items-center gap-2 rounded-full bg-white px-3.5 py-1.5 text-[11px] font-semibold uppercase tracking-[0.16em] text-[#B9865A] shadow-sm ring-1 ring-black/5 sm:px-4 sm:text-xs">
                Share Your Experience
            </span>

            <h2 class="mt-4 text-[26px] font-extrabold leading-tight tracking-tight text-gray-900 sm:text-4xl">
                Leave A <span class="text-[#E2B287]">Review</span>
            </h2>

            <p class="mt-3 text-sm leading-6 text-gray-500 sm:text-base">
               We value your feedback.
            </p>
        </div>

        {{-- ── Inline form (compact) ───────────────────────── --}}
        <div class="rounded-[28px] border border-gray-100 bg-white p-5 shadow-[0_1px_2px_rgba(0,0,0,0.04)] sm:p-8">

            <form id="inlineReviewForm">

                <!-- HONEYPOT -->
                <div class="hidden-security-gate-inline">
                    <label for="inline_address_verification_field">Leave empty</label>
                    <input type="text" id="inline_address_verification_field" autocomplete="off">
                </div>

                <!-- NAME + ORGANISATION -->
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="inline_name" class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Your Name
                        </label>
                        <input
                            type="text"
                            id="inline_name"
                            placeholder="Your Name"
                            autocomplete="name"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3.5 text-base transition focus:border-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-gray-900/10 sm:py-3 sm:text-sm"
                            required>
                    </div>

                    <div>
                        <label for="inline_organisation" class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Organisation (Optional)
                        </label>
                        <input
                            type="text"
                            id="inline_organisation"
                            placeholder="Your Organisation"
                            autocomplete="organization"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3.5 text-base transition focus:border-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-gray-900/10 sm:py-3 sm:text-sm">
                    </div>
                </div>

                <!-- RATING -->
                <div class="mb-4 mt-5 rounded-2xl bg-gray-50 py-5 text-center">
                    <label class="mb-3 block text-xs font-semibold uppercase tracking-wider text-gray-400">
                        Overall Quality Rating
                    </label>

                    <div class="flex flex-wrap justify-center gap-1" id="inlineStarWidgetContainer">
                        <input type="hidden" id="inline_rating" value="5">

                        @for ($i = 1; $i <= 5; $i++)
                            <button
                                type="button"
                                onclick="setInlineRatingValue({{ $i }})"
                                aria-label="{{ $i }} star{{ $i > 1 ? 's' : '' }}"
                                class="inline-star-btn flex h-11 w-11 items-center justify-center rounded-full text-yellow-400 transition hover:bg-white active:bg-white sm:h-9 sm:w-9"
                                data-index="{{ $i }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-7 w-7">
                                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        @endfor
                    </div>
                </div>

                <!-- MESSAGE -->
                <label for="inline_message" class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-gray-400">
                    Your Feedback
                </label>
                <textarea
                    id="inline_message"
                    rows="3"
                    placeholder="Write your feedback..."
                    class="mb-4 w-full resize-none rounded-xl border border-gray-200 bg-gray-50 px-4 py-3.5 text-base leading-6 transition focus:border-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-gray-900/10 sm:py-3 sm:text-sm"
                    required></textarea>

                <!-- BUTTON -->
                <button
                    type="submit"
                    class="group inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gray-900 py-4 text-sm font-semibold tracking-wide text-white transition duration-300 hover:bg-black active:scale-[0.99] sm:py-3">
                    <svg class="h-4 w-4 text-[#E2B287] transition group-hover:rotate-12" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                    </svg>
                    Publish Review
                </button>
            </form>
        </div>
    </div>
</section>

<script>
    /* =========================
       STAR RATING (INLINE)
    ========================== */

    function setInlineRatingValue(rating) {
        document.getElementById('inline_rating').value = rating;

        const starButtons = document.querySelectorAll('#inlineStarWidgetContainer .inline-star-btn');

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
       FORM SUBMIT (INLINE)
    ========================== */

    const inlineReviewFormEl = document.getElementById('inlineReviewForm');

    if (inlineReviewFormEl) {
        inlineReviewFormEl.addEventListener('submit', async function (e) {
            e.preventDefault();

            const honeypotEl = document.getElementById('inline_address_verification_field');
            const honeypotVal = honeypotEl ? honeypotEl.value : '';

            if (honeypotVal.length > 0) {
                return;
            }

            const formData = {
                name: document.getElementById('inline_name').value,
                organisation: document.getElementById('inline_organisation').value || 'Independent Client',
                rating: document.getElementById('inline_rating').value,
                message: document.getElementById('inline_message').value
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
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

    #reviewsContainer::-webkit-scrollbar {
        display: none;
    }

    #reviewsContainer {
        -ms-overflow-style: none;
        scrollbar-width: none;
        cursor: grab;
    }

    #reviewsContainer:active {
        cursor: grabbing;
    }

    @media (max-width: 640px) {
        #reviewsContainer {
            padding-left: 16px;
            padding-right: 16px;
        }
    }
</style>

<section class="relative overflow-hidden bg-[#FAF8F5] py-24">

    {{-- soft ambient accents --}}
    <div class="pointer-events-none absolute -top-24 left-1/2 h-72 w-[36rem] -translate-x-1/2 rounded-full bg-[#E2B287]/20 blur-3xl"></div>
    <div class="pointer-events-none absolute inset-0 opacity-[0.035]"
         style="background-image:radial-gradient(#000 1px,transparent 1px);background-size:22px 22px;"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6">

        {{-- ── Heading ─────────────────────────────────────── --}}
        <div class="mx-auto mb-14 max-w-2xl text-center">
            

            <h1 class="mt-5 text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl">
                What Our Clients <span class="text-[#E2B287]">Say</span>
            </h1>

            <p class="mt-4 text-base leading-8 text-gray-500 sm:text-lg">
                Trusted by clients for reliable financial advisory, investment guidance
                and professional consultation services.
            </p>
        </div>

        {{-- ── Leave a review CTA ─────────────────────────────── --}}
        <div class="mb-14 flex justify-center">
            <button
                type="button"
                onclick="openModal()"
                class="group inline-flex items-center gap-2 rounded-full bg-gray-900 px-8 py-4 text-sm font-semibold text-white shadow-xl shadow-black/10 transition duration-300 hover:-translate-y-0.5 hover:bg-black sm:text-base">
                <svg class="h-4 w-4 text-[#E2B287] transition group-hover:rotate-12" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                </svg>
                Click Here To Leave A Review
            </button>
        </div>

     <div class="relative overflow-hidden">

            <button
                type="button"
                aria-label="Previous reviews"
                onclick="reviewsPrev()"
                class="hidden lg:flex absolute left-0 top-1/2 z-10 -translate-y-1/2 -translate-x-5 h-12 w-12 items-center justify-center rounded-full border border-gray-100 bg-white text-gray-700 shadow-lg shadow-black/5 transition hover:scale-105 hover:text-gray-900">
                <span class="text-2xl leading-none">‹</span>
            </button>

            <button
                type="button"
                aria-label="Next reviews"
                onclick="reviewsNext()"
                class="hidden lg:flex absolute right-0 top-1/2 z-10 -translate-y-1/2 translate-x-5 h-12 w-12 items-center justify-center rounded-full border border-gray-100 bg-white text-gray-700 shadow-lg shadow-black/5 transition hover:scale-105 hover:text-gray-900">
                <span class="text-2xl leading-none">›</span>
            </button>

            <div class="reviews-fade">
                <div
                    id="reviewsContainer"
                    class="flex gap-4 overflow-x-auto snap-x snap-mandatory scroll-smooth pb-6 pt-2 sm:gap-5">

                    @forelse($reviews as $review)

                        @php
                            $nameParts = preg_split('/\s+/', trim($review->name));

                            $first = $nameParts[0] ?? '';
                            $second = $nameParts[1] ?? '';

                            $initials = strtoupper(
                                substr($first, 0, 1) .
                                substr($second, 0, 1)
                            );

                            if (strlen($initials) < 2) {
                                $initials = strtoupper(substr(
                                    preg_replace('/[^A-Za-z]/', '', $review->name),
                                    0,
                                    2
                                ));
                            }

                            $hash = crc32($review->name ?? '');

                            $accent = [
                                ['bg-indigo-50', 'text-indigo-700', 'ring-indigo-100'],
                                ['bg-purple-50', 'text-purple-700', 'ring-purple-100'],
                                ['bg-pink-50', 'text-pink-700', 'ring-pink-100'],
                                ['bg-emerald-50', 'text-emerald-700', 'ring-emerald-100'],
                                ['bg-teal-50', 'text-teal-700', 'ring-teal-100'],
                                ['bg-sky-50', 'text-sky-700', 'ring-sky-100'],
                                ['bg-amber-50', 'text-amber-700', 'ring-amber-100'],
                                ['bg-orange-50', 'text-orange-700', 'ring-orange-100'],
                                ['bg-rose-50', 'text-rose-700', 'ring-rose-100'],
                            ][$hash % 9];

                            [$bg, $text, $ring] = $accent;
                        @endphp

                        <div
                            id="review-{{ $review->id }}"
                            class="
                                snap-center shrink-0 flex flex-col

                                w-[85vw] max-w-[340px]
                                sm:w-[400px] sm:max-w-none
                                lg:w-[360px]

                                overflow-hidden rounded-[28px] border border-gray-100 bg-white
                                shadow-[0_1px_2px_rgba(0,0,0,0.04)]
                                transition duration-300
                                hover:-translate-y-1.5 hover:shadow-[0_24px_48px_-20px_rgba(0,0,0,0.18)]
                            ">

                            {{-- top: identity strip --}}
                            <div class="flex items-center gap-3 px-5 pt-5 sm:px-7 sm:pt-7">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full {{ $bg }} ring-1 {{ $ring }} sm:h-12 sm:w-12">
                                    <span class="{{ $text }} text-sm font-bold">
                                        {{ $initials }}
                                    </span>
                                </div>

                                <div class="min-w-0 flex-1">
                                    <h3 class="truncate text-sm font-bold text-gray-900 sm:text-base">
                                        {{ $review->name }}
                                    </h3>
                                    <p class="truncate text-xs text-gray-400 sm:text-sm">
                                        {{ $review->organisation }}
                                    </p>
                                </div>

                                {{-- rating pill --}}
                                <div class="flex shrink-0 items-center gap-1 rounded-full bg-amber-50 px-2.5 py-1 ring-1 ring-amber-100">
                                    <svg class="h-3.5 w-3.5 text-amber-400" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-xs font-bold text-amber-600">{{ $review->rating }}.0</span>
                                </div>
                            </div>

                            {{-- message --}}
                            <div class="relative mt-4 flex-1 px-5 sm:px-7">
                                <svg class="absolute -top-1 left-4 h-9 w-9 text-gray-100 sm:h-10 sm:w-10" viewBox="0 0 32 32" fill="currentColor" aria-hidden="true">
                                    <path d="M10 8c-3.3 0-6 2.7-6 6v10h10V14H8c0-1.1.9-2 2-2V8Zm14 0c-3.3 0-6 2.7-6 6v10h10V14h-6c0-1.1.9-2 2-2V8Z"/>
                                </svg>

                                <p class="relative z-10 pt-6 text-[15px] italic leading-7 text-gray-600 break-words sm:pt-7 sm:text-base sm:leading-8"
                                   style="display: -webkit-box; -webkit-line-clamp: 5; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $review->message }}
                                </p>
                            </div>

                            {{-- bottom stars strip --}}
                            <div class="mt-5 flex gap-1 border-t border-gray-50 px-5 py-4 sm:px-7">
                                @for ($i = 0; $i < $review->rating; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4 text-yellow-400">
                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                    </svg>
                                @endfor
                            </div>
                        </div>

                    @empty

                        <div class="w-full rounded-3xl border border-dashed border-gray-200 bg-white/60 py-16 text-center text-gray-400">
                            No reviews yet. Be the first to leave one!
                        </div>

                    @endforelse

            </div>
        </div>
    </div>
</section>

{{-- =========================
     REVIEW MODAL
========================== --}}

@include('partials.reviews-modal')

<script>
    /* =========================
       CAROUSEL
    ========================== */

    window.reviewsPrev = function () {
        const scroller = document.getElementById('reviewsContainer');
        if (!scroller) return;

        const firstItem = scroller.querySelector('[id^="review-"]');
        const delta = firstItem ? firstItem.getBoundingClientRect().width + 20 : 320;

        scroller.scrollBy({ left: -delta, behavior: 'smooth' });
    };

    window.reviewsNext = function () {
        const scroller = document.getElementById('reviewsContainer');
        if (!scroller) return;

        const firstItem = scroller.querySelector('[id^="review-"]');
        const delta = firstItem ? firstItem.getBoundingClientRect().width + 20 : 320;

        scroller.scrollBy({ left: delta, behavior: 'smooth' });
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
</script>

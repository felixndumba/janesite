@extends('layouts.app')


@section('content')

{{--
    Data shape below is illustrative — swap for a real $categories collection
    from your controller once you're ready (each video needs: title, youtube_id,
    description, price).
--}}
@php
$categories = [
    [
        'name' => 'Financial Freedom Masterclass',
        'slug' => 'financial-freedom',
        'accent' => '#8C3E32', // maroon — matches your existing price badge
        'videos' => [
            [
                'title' => 'Financial Freedom Masterclass — Full Session',
                'youtube_id' => 'JUFRw042-Kc',
                'description' => 'The complete two-hour class: what financial freedom actually means, the four levers that move your net worth, and a plan you can start on this week.',
                'price' => 1,
                'duration' => '2h 04m',
            ],
        ],
    ],
    [
        'name' => 'Budgeting Masterclass',
        'slug' => 'budgeting',
        'accent' => '#8C6D31', // olive-gold
        'videos' => [
            [
                'title' => 'Build a Budget That Survives Contact With Real Life',
                'youtube_id' => 'tjAY0Ds2Rtc',
                'description' => 'A zero-based budgeting method built for irregular income — with a walkthrough of the free template so every shilling has a job.',
                'price' => 2000,
                'duration' => '1h 12m',
            ],
        ],
    ],
    [
        'name' => 'Debt Management Masterclass',
        'slug' => 'debt-management',
        'accent' => '#1B3A4B', // deep navy
        'videos' => [
            [
                'title' => 'Getting Out From Under Mobile Loans & Debt',
                'youtube_id' => 'wFibhtyG5ug',
                'description' => 'Snowball vs. avalanche compared side by side, how to talk to lenders, and a repayment order for stacked mobile loans.',
                'price' => 2000,
                'duration' => '1h 30m',
            ],
        ],
    ],
    [
        'name' => 'Financial Goal Setting Masterclass',
        'slug' => 'goal-setting',
        'accent' => '#3E5C43', // muted green
        'videos' => [
            [
                'title' => 'Setting Goals You Will Actually Hit',
                'youtube_id' => 'wFibhtyG5ug',
                'description' => 'Turning vague money goals into dated, funded targets — plus a simple system for tracking progress month to month.',
                'price' => 2000,
                'duration' => '55m',
            ],
        ],
    ],
];

$totalClasses = collect($categories)->sum(fn ($c) => count($c['videos']));
$lowestPrice  = collect($categories)->flatMap(fn ($c) => $c['videos'])->min('price');
@endphp

<div x-data="masterclassLibrary()" class="bg-[#FAF8F5] min-h-screen">

    {{-- ── Header ─────────────────────────────────────────────── --}}
    <header class="relative overflow-hidden bg-[#12100F] text-white">
        {{-- soft accent glows --}}
        <div class="pointer-events-none absolute -top-32 -left-24 h-80 w-80 rounded-full bg-[#8C3E32] opacity-30 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-40 right-0 h-96 w-96 rounded-full bg-[#8C6D31] opacity-20 blur-3xl"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.06]"
             style="background-image:linear-gradient(#fff 1px,transparent 1px),linear-gradient(90deg,#fff 1px,transparent 1px);background-size:56px 56px;"></div>

        <div class="relative mx-auto max-w-6xl px-6 py-20 sm:py-24">
            <div class="grid gap-10 lg:grid-cols-[minmax(0,1fr)_auto] lg:items-end">
                <div class="min-w-0">
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/5 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-white/80">
                        <span class="h-1.5 w-1.5 rounded-full bg-[#C0705F]"></span>
                        Recorded Sessions
                    </span>

                    <h1 class="mt-6 text-4xl font-black leading-[1.05] tracking-tight sm:text-6xl">
                        Masterclass<br class="hidden sm:block">
                        <span class="text-[#D9A441]">Library</span>
                    </h1>

                    <p class="mt-5 max-w-xl text-base leading-relaxed text-white/70 sm:text-lg">
                        Every past live session, recorded and ready to watch. Pick a topic, preview the
                        class, and unlock full access whenever you're ready.
                    </p>
                </div>

                <dl class="grid grid-cols-3 gap-3 lg:gap-4">
                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-4 backdrop-blur">
                        <dt class="text-[11px] uppercase tracking-wider text-white/50">Classes</dt>
                        <dd class="mt-1 text-2xl font-bold">{{ $totalClasses }}</dd>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-4 backdrop-blur">
                        <dt class="text-[11px] uppercase tracking-wider text-white/50">Topics</dt>
                        <dd class="mt-1 text-2xl font-bold">{{ count($categories) }}</dd>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-4 backdrop-blur">
                        <dt class="text-[11px] uppercase tracking-wider text-white/50">From</dt>
                        <dd class="mt-1 text-2xl font-bold">{{ number_format($lowestPrice) }}<span class="ml-1 text-xs font-medium text-white/50">KES</span></dd>
                    </div>
                </dl>
            </div>
        </div>

        <div class="h-px w-full bg-gradient-to-r from-transparent via-white/25 to-transparent"></div>
    </header>

    <main class="mx-auto max-w-6xl px-6 pb-24">

        {{-- ── Filter bar ─────────────────────────────────────── --}}
        <div class="sticky top-0 z-30 -mx-6 mb-12 border-b border-black/5 bg-[#FAF8F5]/85 px-6 py-4 backdrop-blur">
            <div class="flex gap-2 overflow-x-auto pb-1 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                <button
                    @click="activeTab = 'all'"
                    :class="activeTab === 'all' ? 'bg-gray-900 text-white shadow-sm' : 'bg-white text-gray-600 ring-1 ring-black/5 hover:bg-gray-100'"
                    class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition">
                    All Classes
                </button>
                @foreach($categories as $category)
                    <button
                        @click="activeTab = '{{ $category['slug'] }}'"
                        :class="activeTab === '{{ $category['slug'] }}' ? 'text-white shadow-sm' : 'bg-white text-gray-600 ring-1 ring-black/5 hover:bg-gray-100'"
                        :style="activeTab === '{{ $category['slug'] }}' ? 'background-color: {{ $category['accent'] }}' : ''"
                        class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition">
                        {{ $category['name'] }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- ── Category sections ──────────────────────────────── --}}
        @foreach($categories as $category)
            <section
                x-show="activeTab === 'all' || activeTab === '{{ $category['slug'] }}'"
                x-transition.opacity
                class="mb-16">

                <div class="mb-6 flex items-center gap-4">
                    <span class="h-8 w-1.5 shrink-0 rounded-full" style="background-color: {{ $category['accent'] }}"></span>
                    <h2 class="min-w-0 truncate text-xl font-bold tracking-tight text-gray-900 sm:text-2xl">
                        {{ $category['name'] }}
                    </h2>
                    <span class="shrink-0 rounded-full bg-white px-2.5 py-1 text-xs font-semibold text-gray-500 ring-1 ring-black/5">
                        {{ count($category['videos']) }} {{ Str::plural('class', count($category['videos'])) }}
                    </span>
                    <span class="hidden h-px flex-1 bg-black/5 sm:block"></span>
                </div>

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($category['videos'] as $video)
                        <article class="group flex flex-col overflow-hidden rounded-2xl bg-white shadow-[0_1px_2px_rgba(0,0,0,0.04)] ring-1 ring-black/5 transition duration-300 hover:-translate-y-1 hover:shadow-[0_18px_40px_-18px_rgba(0,0,0,0.35)]">

                            {{-- Thumbnail --}}
                            <button
                                type="button"
                                @click="openPreview(@js($video), @js($category))"
                                class="relative block w-full aspect-video overflow-hidden bg-gray-900">
                                <img
                                    src="https://i.ytimg.com/vi/{{ $video['youtube_id'] }}/hqdefault.jpg"
                                    alt="{{ $video['title'] }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover opacity-90 transition duration-500 group-hover:scale-105 group-hover:opacity-100">

                                <span class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></span>

                                {{-- Play button --}}
                                <span class="absolute inset-0 flex items-center justify-center">
                                    <span class="flex h-14 w-14 items-center justify-center rounded-full bg-white/95 shadow-lg transition duration-300 group-hover:scale-110"
                                          style="color: {{ $category['accent'] }}">
                                        <svg class="ml-0.5 h-6 w-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                            <path d="M8 5v14l11-7z" />
                                        </svg>
                                    </span>
                                </span>

                                <span class="absolute left-3 top-3 rounded-full px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wider text-white"
                                      style="background-color: {{ $category['accent'] }}">
                                    Preview
                                </span>

                                <span class="absolute bottom-3 right-3 rounded-md bg-black/75 px-2 py-1 text-xs font-semibold text-white tabular-nums">
                                    {{ $video['duration'] }}
                                </span>
                            </button>


                            {{-- Body --}}
                            <div class="flex flex-1 flex-col p-5">
                                <h3 class="text-base font-bold leading-snug text-gray-900">
                                    {{ $video['title'] }}
                                </h3>

                                <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-gray-500">
                                    {{ $video['description'] }}
                                </p>

                                <div class="mt-5 flex items-end justify-between gap-3 border-t border-black/5 pt-4">
                                    <div class="min-w-0">
                                        <span class="block text-[11px] uppercase tracking-wider text-gray-400">Full recording</span>
                                        <span class="block text-lg font-extrabold tabular-nums" style="color: {{ $category['accent'] }}">
                                            KES {{ number_format($video['price']) }}
                                        </span>
                                    </div>

<button
                                        type="button"
                                        onclick="openMasterclassPaymentModal('{{ addslashes($video['title']) }}', '{{ $video['price'] }}', '{{ $video['youtube_id'] }}', '{{ $category['accent'] }}')"
                                        class="shrink-0 rounded-full px-5 py-2.5 text-sm font-semibold text-white transition hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2"
                                        style="background-color: {{ $category['accent'] }}">
                                        Purchase
                                    </button>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endforeach

        {{-- Empty state --}}
        <p x-show="false" class="rounded-2xl bg-white p-10 text-center text-sm text-gray-500 ring-1 ring-black/5">
            No classes in this category yet.
        </p>

        {{-- Note --}}
        <div class="mt-4 flex items-start gap-3 rounded-2xl bg-white p-5 ring-1 ring-black/5">
            <svg class="mt-0.5 h-5 w-5 shrink-0 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <circle cx="12" cy="12" r="9" />
                <path d="M12 8h.01M11 12h1v4h1" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <p class="text-sm leading-relaxed text-gray-500">
                Purchased recordings are sent to your email as a private viewing link or watch it directly on our website. All payments are
                non-refundable once processed.
            </p>
        </div>
    </main>

    {{-- ── Player modal ───────────────────────────────────────── --}}
    <div 
        x-show="playing"
        x-transition.opacity
        @keydown.escape.window="closePreview()"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/85 p-4 backdrop-blur-sm"
        style="display: none;">
        <div class="relative mt-20 w-full max-w-3xl" @click.outside="closePreview()">
            <div class="mb-3 flex items-center justify-between gap-4">
                <p class="min-w-0 truncate text-sm font-semibold text-white/90" x-text="playingTitle"></p>
                <button
                    type="button"
                    @click="closePreview()"
                    class="shrink-0 rounded-full bg-white/10 px-3 py-1.5 text-sm font-semibold text-white transition hover:bg-white/20">
                    Close ✕
                </button>
            </div>

            {{-- Player mounts into this div via the YouTube IFrame API --}}
            <div class="relative overflow-hidden rounded-2xl bg-black shadow-2xl ring-1 ring-white/10">
                <div class="aspect-video w-full">
                    <div id="yt-preview-player" class="h-full w-full"></div>
                </div>

                {{-- End-of-preview purchase overlay --}}
                <div
                    x-show="previewEnded"
                    x-transition.opacity
                    x-cloak
                    class="absolute inset-0 flex flex-col items-center justify-center gap-4 bg-black/90 px-6 text-center">
                    <span class="text-[11px] font-semibold uppercase tracking-[0.18em] text-white/50">Preview finished</span>
                    <p class="max-w-sm text-lg font-bold text-white" x-text="playingTitle"></p>
                    <p class="text-2xl font-extrabold tabular-nums" :style="'color: ' + playingAccent" x-text="'KES ' + Number(playingPrice).toLocaleString()"></p>

                    <div class="mt-2 flex items-center gap-3">
                        <button
                            type="button"
                            @click="replayPreview()"
                            class="rounded-full bg-white/10 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-white/20">
                            Watch Again
                        </button>
                        <button
                            type="button"
                            @click="purchaseFromPreview()"
                            class="rounded-full px-6 py-2.5 text-sm font-semibold text-white shadow-lg transition hover:opacity-90"
                            :style="'background-color: ' + playingAccent">
                            Purchase Now
                        </button>
                    </div>
                </div>
            </div>

            <p class="mt-3 text-center text-xs text-white/50" x-show="!previewEnded">
                Preview clip — purchase for the full, uninterrupted recording.
            </p>
        </div>
    </div>
</div>

@once
    @push('scripts')
        <script>
            // Loads the YouTube IFrame API once and resolves a shared promise
            // when it's ready, so multiple Alpine components can await it safely.
            window.__ytApiPromise = window.__ytApiPromise || new Promise((resolve) => {
                if (window.YT && window.YT.Player) {
                    resolve(window.YT);
                    return;
                }
                const tag = document.createElement('script');
                tag.src = 'https://www.youtube.com/iframe_api';
                document.head.appendChild(tag);

                window.onYouTubeIframeAPIReady = () => resolve(window.YT);
            });

            function masterclassLibrary() {
                return {
                    activeTab: 'all',
                    playing: null,        // youtube video id currently loaded
                    playingTitle: '',
                    playingPrice: 0,
                    playingAccent: '#111827',
previewEnded: false,
                    player: null,         // YT.Player instance

                    // Listen for the "Watch Now" choice from the delivery popup
                    // so a fully-paid video plays directly in the preview player.
                    init() {
                        window.addEventListener("masterclass:watch", (e) => {
                            const video = e.detail || {};
                            if (!video.youtube_id) return;
                            this.playingTitle = video.title || "";
                            this.playingPrice = 0;
                            this.playingAccent = video.accent || '#111827';
                            this.previewEnded = false;
                            this.playing = video.youtube_id;

                            window.__ytApiPromise.then((YT) => {
                                this.$nextTick(() => this.mountPlayer(YT, video.youtube_id));
                            });
                        });
                    },

                    openPreview(video, category) {
                        this.playingTitle = video.title;
                        this.playingPrice = video.price;
                        this.playingAccent = category.accent;
                        this.previewEnded = false;
                        this.playing = video.youtube_id;

                        window.__ytApiPromise.then((YT) => {
                            // Give the modal a tick to render its container.
                            this.$nextTick(() => this.mountPlayer(YT, video.youtube_id));
                        });
                    },

                    mountPlayer(YT, videoId) {
                        if (this.player) {
                            // Reuse the existing player instance for a fresh video.
                            this.player.loadVideoById(videoId);
                            return;
                        }

                        this.player = new YT.Player('yt-preview-player', {
                            videoId: videoId,
                            playerVars: {
                                autoplay: 1,
                                rel: 0,
                                modestbranding: 1,
                            },
                            events: {
                                onStateChange: (event) => this.onPlayerStateChange(event, YT),
                            },
                        });
                    },

                    onPlayerStateChange(event, YT) {
                        // Automatic detection of preview completion.
                        if (event.data === YT.PlayerState.ENDED) {
                            this.previewEnded = true;
                        }
                        // Any state other than ENDED means playback resumed —
                        // hide the purchase overlay if it was showing.
                        if (event.data === YT.PlayerState.PLAYING) {
                            this.previewEnded = false;
                        }
                    },

                    replayPreview() {
                        this.previewEnded = false;
                        if (this.player && typeof this.player.seekTo === 'function') {
                            this.player.seekTo(0);
                            this.player.playVideo();
                        }
                    },

purchaseFromPreview() {
                        // Pass the video id + accent so the "Watch Now" option
                        // in the delivery popup can replay the purchased video.
                        openMasterclassPaymentModal(this.playingTitle, this.playingPrice, this.playing, this.playingAccent);
                        this.closePreview();
                    },

                    closePreview() {
                        this.playing = null;
                        this.previewEnded = false;
                        if (this.player && typeof this.player.stopVideo === 'function') {
                            this.player.stopVideo();
                        }
                    },
                };
            }
        </script>
    @endpush
@endonce

@endsection
@extends('layouts.app')

@section('content')

@php
$categories = [
    [
        'name' => 'Financial Freedom Masterclass',
        'slug' => 'financial-freedom',
        'accent' => '#8C3E32',
        'videos' => [
            [
                'title' => 'Financial Freedom Masterclass — Full Session',
                'preview_youtube_id' => 'JUFRw042-Kc',
                'paid_youtube_id' => 'k1LXQEE6vdQ',
                'description' => 'The complete two-hour class: what financial freedom actually means, the four levers that move your net worth, and a plan you can start on this week.',
                'price' => 4000,
                'duration' => '2h 13m',
            ],
        ],
    ],

    [
        'name' => 'Budgeting Masterclass',
        'slug' => 'budgeting',
        'accent' => '#8C6D31',
        'videos' => [
            [
                'title' => 'Build a Budget That Survives Contact With Real Life',
                'preview_youtube_id' => 'tjAY0Ds2Rtc',
                'paid_youtube_id' => 'YOUR_BUDGETING_FULL_VIDEO_ID',
                'description' => 'A zero-based budgeting method built for irregular income — with a walkthrough of the free template so every shilling has a job.',
                'price' => 2000,
                'duration' => '38min',
            ],
        ],
    ],

    [
        'name' => 'Debt Management Masterclass',
        'slug' => 'debt-management',
        'accent' => '#1B3A4B',
        'videos' => [
            [
                'title' => 'Getting Out From Under Mobile Loans & Debt',
                'preview_youtube_id' => 'wFibhtyG5ug',
                'paid_youtube_id' => 'UEbeGDj0Tgg',
                'description' => 'Snowball vs. avalanche compared side by side, how to talk to lenders, and a repayment order for stacked mobile loans.',
                'price' => 2000,
                'duration' => '30m',
            ],
        ],
    ],

    [
        'name' => 'Financial Goal Setting and wealth creation Masterclass',
        'slug' => 'goal-setting',
        'accent' => '#3E5C43',
        'videos' => [
            [
                'title' => 'Setting Goals You Will Actually Hit',
                'preview_youtube_id' => 'wFibhtyG5ug',
                'paid_youtube_id' => 'GOq3cT_uWQs',
                'description' => 'Turning vague money goals into dated, funded targets — plus a simple system for tracking progress month to month.',
                'price' => 2000,
                'duration' => '47m',
            ],
        ],
    ],
];

$totalClasses = collect($categories)->sum(fn ($c) => count($c['videos']));

$lowestPrice = collect($categories)
    ->flatMap(fn ($c) => $c['videos'])
    ->min('price');

$allVideos = collect($categories)
    ->flatMap(function ($c) {
        return array_map(
            fn ($v) => array_merge($v, ['category' => $c]),
            $c['videos']
        );
    })
    ->all();
@endphp


<div x-data="masterclassLibrary()" class="bg-[#FAF8F5] min-h-screen">

    {{-- =========================================================
         HEADER
    ========================================================== --}}
    <header class="relative overflow-hidden bg-[#12100F] text-white">

        <div class="pointer-events-none absolute -top-32 -left-24 h-80 w-80 rounded-full bg-[#8C3E32] opacity-30 blur-3xl"></div>

        <div class="pointer-events-none absolute -bottom-40 right-0 h-96 w-96 rounded-full bg-[#8C6D31] opacity-20 blur-3xl"></div>

        <div
            class="pointer-events-none absolute inset-0 opacity-[0.06]"
            style="background-image:linear-gradient(#fff 1px,transparent 1px),linear-gradient(90deg,#fff 1px,transparent 1px);background-size:56px 56px;">
        </div>

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

                        Every past live session, recorded and ready to watch.
                        Pick a topic, preview the class, and unlock full access whenever you're ready.

                    </p>

                </div>

                <dl class="grid grid-cols-3 gap-3 lg:gap-4">

                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-4 backdrop-blur">

                        <dt class="text-[11px] uppercase tracking-wider text-white/50">
                            Classes
                        </dt>

                        <dd class="mt-1 text-2xl font-bold">
                            {{ $totalClasses }}
                        </dd>

                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-4 backdrop-blur">

                        <dt class="text-[11px] uppercase tracking-wider text-white/50">
                            Topics
                        </dt>

                        <dd class="mt-1 text-2xl font-bold">
                            {{ count($categories) }}
                        </dd>

                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-4 backdrop-blur">

                        <dt class="text-[11px] uppercase tracking-wider text-white/50">
                            From
                        </dt>

                        <dd class="mt-1 text-2xl font-bold">

                            {{ number_format($lowestPrice) }}

                            <span class="ml-1 text-xs font-medium text-white/50">
                                KES
                            </span>

                        </dd>

                    </div>

                </dl>

            </div>

        </div>

        <div class="h-px w-full bg-gradient-to-r from-transparent via-white/25 to-transparent"></div>

    </header>


    {{-- =========================================================
         MAIN
    ========================================================== --}}
    <main class="mx-auto max-w-6xl px-6 pb-24">

        {{-- FILTER BAR --}}
        <div class="sticky top-0 z-30 -mx-6 mb-12 border-b border-black/5 bg-[#FAF8F5]/85 px-6 py-4 backdrop-blur">

            <div class="flex gap-2 overflow-x-auto pb-1 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">

                <button
                    @click="activeTab = 'all'"
                    :class="activeTab === 'all'
                        ? 'bg-gray-900 text-white shadow-sm'
                        : 'bg-white text-gray-600 ring-1 ring-black/5 hover:bg-gray-100'"
                    class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition">

                    All Classes

                </button>

                @foreach($categories as $category)

                    <button
                        @click="activeTab = '{{ $category['slug'] }}'"
                        :class="activeTab === '{{ $category['slug'] }}'
                            ? 'text-white shadow-sm'
                            : 'bg-white text-gray-600 ring-1 ring-black/5 hover:bg-gray-100'"
                        :style="activeTab === '{{ $category['slug'] }}'
                            ? 'background-color: {{ $category['accent'] }}'
                            : ''"
                        class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition">

                        {{ $category['name'] }}

                    </button>

                @endforeach

            </div>

        </div>


        {{-- =====================================================
             CLASS CARDS
        ====================================================== --}}
        <div class="grid gap-6 sm:grid-cols-2">

            @foreach($allVideos as $video)

                @php
                    $category = $video['category'];
                @endphp

                <article
                    x-show="activeTab === 'all' || activeTab === '{{ $category['slug'] }}'"
                    x-transition.opacity
                    class="group flex flex-col overflow-hidden rounded-2xl bg-white shadow-[0_1px_2px_rgba(0,0,0,0.04)] ring-1 ring-black/5 transition duration-300 hover:-translate-y-1 hover:shadow-[0_18px_40px_-18px_rgba(0,0,0,0.35)]">

                    {{-- THUMBNAIL / PREVIEW --}}
                    <button
                        type="button"
                        @click="openPreview(@js($video), @js($category))"
                        class="relative block w-full aspect-video overflow-hidden bg-gray-900">

                        <img
                            src="https://i.ytimg.com/vi/{{ $video['preview_youtube_id'] }}/hqdefault.jpg"
                            alt="{{ $video['title'] }}"
                            loading="lazy"
                            class="h-full w-full object-cover opacity-90 transition duration-500 group-hover:scale-105 group-hover:opacity-100">

                        <span class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></span>

                        <span class="absolute inset-0 flex items-center justify-center">

                            <span
                                class="flex h-14 w-14 items-center justify-center rounded-full bg-white/95 shadow-lg transition duration-300 group-hover:scale-110"
                                style="color: {{ $category['accent'] }}">

                                <svg
                                    class="ml-0.5 h-6 w-6"
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    aria-hidden="true">

                                    <path d="M8 5v14l11-7z" />

                                </svg>

                            </span>

                        </span>

                        <span
                            class="absolute left-3 top-3 rounded-full px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wider text-white"
                            style="background-color: {{ $category['accent'] }}">

                            Preview

                        </span>

                        <span class="absolute bottom-3 right-3 rounded-md bg-black/75 px-2 py-1 text-xs font-semibold text-white tabular-nums">

                            {{ $video['duration'] }}

                        </span>

                    </button>


                    {{-- BODY --}}
                    <div class="flex flex-1 flex-col p-5">

                        <span
                            class="mb-2 inline-flex w-fit items-center gap-1.5 rounded-full bg-gray-100 px-2.5 py-0.5 text-[11px] font-semibold uppercase tracking-wider"
                            style="color: {{ $category['accent'] }}">

                            {{ $category['name'] }}

                        </span>

                        <h3 class="text-base font-bold leading-snug text-gray-900">

                            {{ $video['title'] }}

                        </h3>

                        <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-gray-500">

                            {{ $video['description'] }}

                        </p>

                        <div class="mt-5 flex items-end justify-between gap-3 border-t border-black/5 pt-4">

                            <div class="min-w-0">

                                <span class="block text-[11px] uppercase tracking-wider text-gray-400">
                                    Full recording
                                </span>

                                <span
                                    class="block text-lg font-extrabold tabular-nums"
                                    style="color: {{ $category['accent'] }}">

                                    KES {{ number_format($video['price']) }}

                                </span>

                            </div>


                            {{-- PURCHASE --}}
                            <button
                                type="button"
                                onclick="openMasterclassPaymentModal(
                                    @js($video['title']),
                                    @js($video['price']),
                                    @js($video['paid_youtube_id']),
                                    @js($category['accent'])
                                )"
                                class="shrink-0 rounded-full px-5 py-2.5 text-sm font-semibold text-white transition hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2"
                                style="background-color: {{ $category['accent'] }}">

                                Purchase

                            </button>

                        </div>

                    </div>

                </article>

            @endforeach

        </div>


        {{-- EMPTY STATE --}}
        <p
            x-show="false"
            class="rounded-2xl bg-white p-10 text-center text-sm text-gray-500 ring-1 ring-black/5">

            No classes in this category yet.

        </p>


        {{-- NOTE --}}
        <div class="mt-4 flex items-start gap-3 rounded-2xl bg-white p-5 ring-1 ring-black/5">

            <svg
                class="mt-0.5 h-5 w-5 shrink-0 text-gray-400"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                aria-hidden="true">

                <circle cx="12" cy="12" r="9" />

                <path
                    d="M12 8h.01M11 12h1v4h1"
                    stroke-linecap="round"
                    stroke-linejoin="round" />

            </svg>

            <p class="text-sm leading-relaxed text-gray-500">

                Purchased recordings are sent to your email as a private viewing link
                or watched directly on our website. All payments are non-refundable
                once processed.

            </p>

        </div>

    </main>


    {{-- =========================================================
         VIDEO PLAYER MODAL
    ========================================================== --}}
    <div
        x-show="playing"
        x-cloak
        x-transition.opacity
        @keydown.escape.window="closePreview()"
        class="fixed inset-0 z-[200] flex items-center justify-center bg-black/85 p-4 backdrop-blur-sm"
        style="display: none;">

        <div
            class="relative mt-20 w-full max-w-3xl"
            @click.outside="closePreview()">

            {{-- PLAYER HEADER --}}
            <div class="mb-3 flex items-center justify-between gap-4">

                <p
                    class="min-w-0 truncate text-sm font-semibold text-white/90"
                    x-text="playingTitle">
                </p>

                <button
                    type="button"
                    @click="closePreview()"
                    class="shrink-0 rounded-full bg-white/10 px-3 py-1.5 text-sm font-semibold text-white transition hover:bg-white/20">

                    Close ✕

                </button>

            </div>


            {{-- PLAYER --}}
            <div class="relative overflow-hidden rounded-2xl bg-black shadow-2xl ring-1 ring-white/10">

                <div class="aspect-video w-full">

                    <div
                        id="yt-preview-player"
                        class="h-full w-full">
                    </div>

                </div>


                {{-- =================================================
                     PREVIEW FINISHED OVERLAY
                     ONLY SHOWN FOR FREE PREVIEW
                ================================================== --}}
                <div
                    x-show="previewEnded && !playingPaid"
                    x-transition.opacity
                    x-cloak
                    class="absolute inset-0 flex flex-col items-center justify-center gap-4 bg-black/90 px-6 text-center">

                    <span class="text-[11px] font-semibold uppercase tracking-[0.18em] text-white/50">

                        Preview finished

                    </span>

                    <p
                        class="max-w-sm text-lg font-bold text-white"
                        x-text="playingTitle">
                    </p>

                    <p
                        class="text-2xl font-extrabold tabular-nums"
                        :style="'color: ' + playingAccent"
                        x-text="'KES ' + Number(playingPrice).toLocaleString()">
                    </p>

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


                {{-- PAID VIDEO LABEL --}}
                <div
                    x-show="playingPaid"
                    x-cloak
                    class="absolute left-3 top-3 rounded-full bg-green-600 px-3 py-1 text-xs font-bold text-white shadow-lg">

                    ✓ Purchased Masterclass

                </div>

            </div>


            {{-- PREVIEW FOOTER --}}
            <p
                class="mt-3 text-center text-xs text-white/50"
                x-show="!previewEnded && !playingPaid">

                Preview clip — purchase for the full, uninterrupted recording.

            </p>

            {{-- PAID FOOTER --}}
            <p
                class="mt-3 text-center text-xs text-green-300"
                x-show="playingPaid"
                x-cloak>

                ✓ You are watching your purchased masterclass.

            </p>

        </div>

    </div>


    {{-- =========================================================
         EMAIL DELIVERY MODAL
    ========================================================== --}}
    <div
        x-show="emailModalOpen"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-[300] flex items-center justify-center bg-black/75 p-4 backdrop-blur-sm">

        <div
            @click.outside="closeEmailModal()"
            x-transition.scale
            class="w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl">

            <div class="flex items-start justify-between gap-4">

                <div>

                    <div
                        class="mb-3 flex h-12 w-12 items-center justify-center rounded-full"
                        :style="'background-color:' + emailAccent + '18; color:' + emailAccent">

                        <svg
                            class="h-6 w-6"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8">

                            <path
                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2Z"/>

                            <path d="m22 6-10 7L2 6"/>

                        </svg>

                    </div>

                    <h2 class="text-xl font-bold text-gray-900">

                        Send My Masterclass

                    </h2>

                    <p class="mt-1 text-sm leading-relaxed text-gray-500">

                        Enter your email address and we'll send you your private
                        viewing link.

                    </p>

                </div>

                <button
                    type="button"
                    @click="closeEmailModal()"
                    class="rounded-full p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-700">

                    ✕

                </button>

            </div>


            <div class="mt-5 rounded-2xl bg-gray-50 p-4 ring-1 ring-black/5">

                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">

                    Purchased Masterclass

                </p>

                <p
                    class="mt-1 font-semibold text-gray-900"
                    x-text="emailVideoTitle">
                </p>

            </div>


            <div
                x-show="emailError"
                x-transition
                class="mt-4 rounded-xl bg-red-50 p-3 text-sm text-red-700">

                <span x-text="emailError"></span>

            </div>


            <div
                x-show="emailSuccess"
                x-transition
                class="mt-4 rounded-xl bg-green-50 p-4 text-sm text-green-700">

                <div class="flex gap-3">

                    <svg
                        class="h-5 w-5 shrink-0"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2">

                        <path
                            d="m5 12 4 4L19 6"
                            stroke-linecap="round"
                            stroke-linejoin="round"/>

                    </svg>

                    <div>

                        <p class="font-bold">
                            Link sent successfully
                        </p>

                        <p class="mt-1">
                            Check your inbox for your private masterclass viewing link.
                        </p>

                    </div>

                </div>

            </div>


            <form
                x-show="!emailSuccess"
                @submit.prevent="sendMasterclassLink()"
                class="mt-5">

                <label
                    for="masterclass-email"
                    class="block text-sm font-semibold text-gray-700">

                    Email address

                </label>

                <input
                    id="masterclass-email"
                    type="email"
                    x-model="emailAddress"
                    autocomplete="email"
                    required
                    placeholder="you@example.com"
                    class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm outline-none transition focus:border-gray-400 focus:ring-2 focus:ring-gray-200">

                <button
                    type="submit"
                    :disabled="emailSending"
                    class="mt-4 flex w-full items-center justify-center gap-2 rounded-xl px-5 py-3.5 text-sm font-bold text-white transition hover:opacity-90 disabled:cursor-not-allowed disabled:opacity-60"
                    :style="'background-color:' + emailAccent">

                    <svg
                        x-show="emailSending"
                        class="h-5 w-5 animate-spin"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor">

                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                            stroke-opacity=".25"
                            stroke-width="3"/>

                        <path
                            d="M21 12a9 9 0 0 0-9-9"
                            stroke-width="3"
                            stroke-linecap="round"/>

                    </svg>

                    <span x-show="!emailSending">
                        Send Private Link
                    </span>

                    <span x-show="emailSending">
                        Sending...
                    </span>

                </button>

            </form>


            <button
                x-show="emailSuccess"
                type="button"
                @click="closeEmailModal()"
                class="mt-5 w-full rounded-xl bg-gray-100 px-5 py-3 text-sm font-bold text-gray-700 transition hover:bg-gray-200">

                Done

            </button>

        </div>

    </div>

</div>


{{-- =============================================================
     ALPINE + YOUTUBE
============================================================= --}}
@once
@push('scripts')

<script>

(function () {

    /*
    |--------------------------------------------------------------------------
    | YOUTUBE IFRAME API
    |--------------------------------------------------------------------------
    */

    window.__ytApiPromise = window.__ytApiPromise || new Promise((resolve) => {

        if (window.YT && window.YT.Player) {
            resolve(window.YT);
            return;
        }

        const existingScript =
            document.querySelector(
                'script[src="https://www.youtube.com/iframe_api"]'
            );

        if (!existingScript) {

            const tag =
                document.createElement('script');

            tag.src =
                'https://www.youtube.com/iframe_api';

            tag.async = true;

            tag.onerror = () => resolve(null);

            document.head.appendChild(tag);
        }

        const previousCallback =
            window.onYouTubeIframeAPIReady;

        window.onYouTubeIframeAPIReady =
            function () {

                if (typeof previousCallback === 'function') {
                    previousCallback();
                }

                resolve(window.YT);
            };

    });


    /*
    |--------------------------------------------------------------------------
    | ALPINE COMPONENT
    |--------------------------------------------------------------------------
    */

    window.masterclassLibrary = function () {

        return {

            /*
            |--------------------------------------------------------------------------
            | CATEGORY FILTER
            |--------------------------------------------------------------------------
            */

            activeTab: 'all',


            /*
            |--------------------------------------------------------------------------
            | PLAYER STATE
            |--------------------------------------------------------------------------
            */

            playing: null,

            playingTitle: '',

            playingPrice: 0,

            playingAccent: '#111827',

            previewEnded: false,

            player: null,

            /*
             * TRUE = purchased/full video
             * FALSE = free preview
             */
            playingPaid: false,

            /*
             * Full paid YouTube ID
             */
            playingPaidVideoId: '',


            /*
            |--------------------------------------------------------------------------
            | EMAIL STATE
            |--------------------------------------------------------------------------
            */

            emailModalOpen: false,

            emailAddress: '',

            emailVideoTitle: '',

            emailVideoId: '',

            emailPrice: 0,

            emailAccent: '#8C3E32',

            emailSending: false,

            emailSuccess: false,

            emailError: '',


            /*
            |--------------------------------------------------------------------------
            | INIT
            |--------------------------------------------------------------------------
            */

            init() {

                console.log(
                    'Masterclass Alpine component initialized.'
                );


                /*
                |--------------------------------------------------------------------------
                | WATCH NOW FROM PAYMENT DELIVERY POPUP
                |--------------------------------------------------------------------------
                |
                | Your existing payment modal sends:
                |
                | {
                |     title,
                |     youtube_id,
                |     accent
                | }
                |
                | IMPORTANT:
                |
                | youtube_id here is the PAID video.
                |
                */

                window.addEventListener(
                    'masterclass:watch',
                    (event) => {

                        const video =
                            event.detail || {};

                        console.log(
                            'MASTERCLASS WATCH EVENT:',
                            video
                        );


                        /*
                        |--------------------------------------------------------------------------
                        | PAID WATCH
                        |--------------------------------------------------------------------------
                        |
                        | Your payment modal sends youtube_id.
                        |
                        */

                        if (video.youtube_id) {

                            this.openPaidVideo(
                                video.youtube_id,
                                video.title || 'Masterclass',
                                video.accent || '#8C3E32'
                            );

                            return;
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | BACKWARD COMPATIBILITY
                        |--------------------------------------------------------------------------
                        |
                        | If another part of your site sends a preview
                        | object, we still support it.
                        |
                        */

                        if (video.preview_youtube_id) {

                            this.openPreview(
                                video,
                                {
                                    accent:
                                        video.accent || '#8C3E32'
                                }
                            );

                        }

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | EMAIL EVENT
                |--------------------------------------------------------------------------
                */

                window.addEventListener(
                    'masterclass:email',
                    (event) => {

                        const video =
                            event.detail || {};

                        this.openEmailModal(video);

                    }
                );

            },


            /*
            |--------------------------------------------------------------------------
            | OPEN FREE PREVIEW
            |--------------------------------------------------------------------------
            */

            openPreview(video, category) {

                console.log(
                    'Opening preview:',
                    video
                );


                this.playingTitle =
                    video.title || 'Masterclass';


                this.playingPrice =
                    Number(video.price || 0);


                this.playingAccent =
                    category.accent || '#8C3E32';


                this.playingPaid =
                    false;


                this.playingPaidVideoId =
                    video.paid_youtube_id || '';


                this.previewEnded =
                    false;


                this.playing =
                    video.preview_youtube_id;


                if (!this.playing) {

                    console.error(
                        'Missing preview YouTube ID.',
                        video
                    );

                    return;
                }


                window.__ytApiPromise.then(
                    (YT) => {

                        this.$nextTick(() => {

                            this.mountPlayer(
                                YT,
                                this.playing
                            );

                        });

                    }
                );

            },


            /*
            |--------------------------------------------------------------------------
            | OPEN PAID VIDEO
            |--------------------------------------------------------------------------
            |
            | THIS IS THE IMPORTANT FIX.
            |
            | Watch Now from the payment popup calls this.
            |
            */

            openPaidVideo(
                videoId,
                title,
                accent = '#8C3E32'
            ) {

                console.log(
                    'Opening PAID masterclass:',
                    videoId
                );


                if (!videoId) {

                    console.error(
                        'No paid YouTube ID received.'
                    );

                    alert(
                        'The purchased masterclass video could not be found.'
                    );

                    return;
                }


                this.playingTitle =
                    title || 'Purchased Masterclass';


                this.playingPrice =
                    0;


                this.playingAccent =
                    accent;


                this.playingPaid =
                    true;


                this.playingPaidVideoId =
                    videoId;


                this.previewEnded =
                    false;


                /*
                |--------------------------------------------------------------------------
                | IMPORTANT:
                | Set playing to the PAID video ID.
                |--------------------------------------------------------------------------
                */

                this.playing =
                    videoId;


                window.__ytApiPromise.then(
                    (YT) => {

                        this.$nextTick(() => {

                            this.mountPlayer(
                                YT,
                                videoId
                            );

                        });

                    }
                );

            },


            /*
            |--------------------------------------------------------------------------
            | MOUNT YOUTUBE PLAYER
            |--------------------------------------------------------------------------
            */

            mountPlayer(YT, videoId) {

                if (!YT || !YT.Player) {

                    console.error(
                        'YouTube API is not available.'
                    );

                    return;
                }


                if (!videoId) {

                    console.error(
                        'mountPlayer called without video ID.'
                    );

                    return;
                }


                const playerElement =
                    document.getElementById(
                        'yt-preview-player'
                    );


                if (!playerElement) {

                    console.error(
                        'YouTube player element not found.'
                    );

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | EXISTING PLAYER
                |--------------------------------------------------------------------------
                */

                if (this.player) {

                    try {

                        this.player.loadVideoById(
                            videoId
                        );

                        return;

                    } catch (error) {

                        console.warn(
                            'Existing YouTube player failed. Recreating.',
                            error
                        );

                        try {
                            this.player.destroy();
                        } catch (e) {}

                        this.player =
                            null;
                    }

                }


                /*
                |--------------------------------------------------------------------------
                | CREATE PLAYER
                |--------------------------------------------------------------------------
                */

                this.player =
                    new YT.Player(
                        'yt-preview-player',
                        {

                            videoId: videoId,

                            host:
                                'https://www.youtube-nocookie.com',

                            playerVars: {

                                autoplay: 1,

                                rel: 0,

                                modestbranding: 1,

                                playsinline: 1,

                                origin:
                                    window.location.origin

                            },

                            events: {

                                onReady: (event) => {

                                    console.log(
                                        'YouTube player ready.'
                                    );

                                    try {

                                        event.target.playVideo();

                                    } catch (error) {

                                        console.warn(
                                            'Autoplay was blocked.',
                                            error
                                        );

                                    }

                                },


                                onStateChange: (event) => {

                                    this.onPlayerStateChange(
                                        event,
                                        YT
                                    );

                                },


                                onError: (event) => {

                                    console.error(
                                        'YouTube player error:',
                                        event.data
                                    );

                                }

                            }

                        }
                    );

            },


            /*
            |--------------------------------------------------------------------------
            | YOUTUBE STATE
            |--------------------------------------------------------------------------
            */

            onPlayerStateChange(event, YT) {

                if (
                    event.data ===
                    YT.PlayerState.ENDED
                ) {

                    /*
                    |--------------------------------------------------------------------------
                    | ONLY FREE PREVIEWS HAVE A PURCHASE OVERLAY
                    |--------------------------------------------------------------------------
                    */

                    if (!this.playingPaid) {

                        this.previewEnded =
                            true;

                    }

                }


                if (
                    event.data ===
                    YT.PlayerState.PLAYING
                ) {

                    this.previewEnded =
                        false;

                }

            },


            /*
            |--------------------------------------------------------------------------
            | REPLAY PREVIEW
            |--------------------------------------------------------------------------
            */

            replayPreview() {

                this.previewEnded =
                    false;


                if (
                    this.player &&
                    typeof this.player.seekTo === 'function'
                ) {

                    this.player.seekTo(
                        0,
                        true
                    );

                    this.player.playVideo();

                }

            },


            /*
            |--------------------------------------------------------------------------
            | PURCHASE FROM PREVIEW
            |--------------------------------------------------------------------------
            */

            purchaseFromPreview() {

                if (
                    typeof window.openMasterclassPaymentModal !==
                    'function'
                ) {

                    console.error(
                        'openMasterclassPaymentModal() is not available.'
                    );

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | SEND THE PAID VIDEO ID.
                |--------------------------------------------------------------------------
                */

                window.openMasterclassPaymentModal(

                    this.playingTitle,

                    this.playingPrice,

                    this.playingPaidVideoId,

                    this.playingAccent

                );


                this.closePreview();

            },


            /*
            |--------------------------------------------------------------------------
            | CLOSE VIDEO
            |--------------------------------------------------------------------------
            */

            closePreview() {

                this.playing =
                    null;


                this.playingPaid =
                    false;


                this.playingPaidVideoId =
                    '';


                this.previewEnded =
                    false;


                /*
                |--------------------------------------------------------------------------
                | Stop current video.
                |--------------------------------------------------------------------------
                */

                if (
                    this.player &&
                    typeof this.player.stopVideo === 'function'
                ) {

                    try {

                        this.player.stopVideo();

                    } catch (error) {

                        console.warn(
                            'Unable to stop YouTube video.',
                            error
                        );

                    }

                }

            },


            /*
            |--------------------------------------------------------------------------
            | OPEN EMAIL MODAL
            |--------------------------------------------------------------------------
            */

            openEmailModal(video) {

                this.emailVideoTitle =
                    video.title || '';


                this.emailVideoId =
                    video.youtube_id || '';


                this.emailPrice =
                    Number(video.price || 0);


                this.emailAccent =
                    video.accent || '#8C3E32';


                this.emailAddress =
                    '';


                this.emailError =
                    '';


                this.emailSuccess =
                    false;


                this.emailSending =
                    false;


                this.emailModalOpen =
                    true;

            },


            /*
            |--------------------------------------------------------------------------
            | CLOSE EMAIL MODAL
            |--------------------------------------------------------------------------
            */

            closeEmailModal() {

                if (this.emailSending) {
                    return;
                }


                this.emailModalOpen =
                    false;


                this.emailError =
                    '';


                this.emailSuccess =
                    false;


                this.emailAddress =
                    '';

            },


            /*
            |--------------------------------------------------------------------------
            | SEND MASTERCLASS EMAIL
            |--------------------------------------------------------------------------
            */

            async sendMasterclassLink() {

                this.emailError =
                    '';


                this.emailSending =
                    true;


                this.emailSuccess =
                    false;


                try {

                    const csrfElement =
                        document.querySelector(
                            'meta[name="csrf-token"]'
                        );


                    const csrfToken =
                        csrfElement
                            ? csrfElement.getAttribute('content')
                            : '';


                    const response =
                        await fetch(
                            @json(route('masterclass.send-link')),
                            {

                                method: 'POST',

                                headers: {

                                    'Content-Type':
                                        'application/json',

                                    'Accept':
                                        'application/json',

                                    'X-Requested-With':
                                        'XMLHttpRequest',

                                    'X-CSRF-TOKEN':
                                        csrfToken

                                },


                                body:
                                    JSON.stringify({

                                        email:
                                            this.emailAddress,

                                        title:
                                            this.emailVideoTitle,

                                        youtube_id:
                                            this.emailVideoId,

                                        price:
                                            this.emailPrice

                                    })

                            }
                        );


                    const data =
                        await response.json();


                    console.log(
                        'Masterclass email response:',
                        data
                    );


                    if (
                        !response.ok ||
                        data.success !== true
                    ) {

                        throw new Error(
                            data.message ||
                            'Unable to send the email.'
                        );

                    }


                    this.emailSuccess =
                        true;


                    this.emailError =
                        '';


                } catch (error) {

                    console.error(
                        'Masterclass email error:',
                        error
                    );


                    this.emailSuccess =
                        false;


                    this.emailError =
                        error.message ||
                        'Something went wrong while sending the link. Please try again.';


                } finally {

                    this.emailSending =
                        false;

                }

            }

        };

    };


    /*
    |--------------------------------------------------------------------------
    | MAKE SURE ALPINE CAN FIND THE COMPONENT
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'alpine:init',
        () => {

            /*
            | The function is already attached to window.
            | This registration makes it explicitly available
            | to Alpine as well.
            */

            Alpine.data(
                'masterclassLibrary',
                window.masterclassLibrary
            );

        }
    );

})();

</script>

@endpush
@endonce

@endsection


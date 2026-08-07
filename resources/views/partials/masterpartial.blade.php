@extends('layouts.app')

@section('title', 'Masterclass Library | Thedi Advisors')
@section('meta_description', 'Explore Thedi Advisors masterclass library.')
@section('canonical_url', url('/Master-class'))
@section('og_image', asset('images/jane1.jpg'))

@section('content')

    <div class="relative overflow-hidden bg-[#FAF8F5] min-h-screen">

        {{-- soft ambient accents --}}
        <div class="pointer-events-none absolute -top-24 left-1/2 h-72 w-[36rem] -translate-x-1/2 rounded-full bg-[#E2B287]/20 blur-3xl"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.035]"
             style="background-image:radial-gradient(#000 1px,transparent 1px);background-size:22px 22px;"></div>

        <div class="relative mx-auto max-w-3xl px-4 py-24 text-center sm:px-6">

            {{-- ── Under Development tag ───────────────────────── --}}
            <span class="inline-flex items-center gap-2 rounded-full border border-dashed border-[#B9865A] bg-[#FAF3EC] px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.16em] text-[#B9865A]">
                <svg class="h-4 w-4 animate-pulse" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z" />
                </svg>
                Page Under Development
            </span>

            <h1 class="mt-6 text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl">
                Masterclass <span class="text-[#E2B287]">Library</span>
            </h1>

            <p class="mx-auto mt-4 max-w-xl text-base leading-8 text-gray-500 sm:text-lg">
                Our full library of recorded financial masterclasses is coming soon.
                Please check back shortly — we're working hard to bring you
                valuable, actionable content.
            </p>

            {{-- ── Placeholder card ───────────────────────────── --}}
            <div class="mx-auto mt-12 max-w-md rounded-3xl border border-dashed border-gray-200 bg-white/70 p-10">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#FAF3EC]">
                    <svg class="h-8 w-8 text-[#B9865A]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <rect x="2" y="5" width="20" height="14" rx="3" />
                        <path d="M10 9.5v5l4-2.5z" fill="currentColor" stroke="none" />
                    </svg>
                </div>
                <h2 class="mt-6 text-xl font-bold text-gray-900">Coming Soon</h2>
                <p class="mt-2 text-sm leading-6 text-gray-500">
                    Recorded sessions, budgeting guides, debt management and
                    goal-setting classes will be available here.
                </p>
            </div>
        </div>
    </div>

@endsection

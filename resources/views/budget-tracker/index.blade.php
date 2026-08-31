@extends('layouts.app')

@section('title', 'Budget Tracker | Thedi Advisors')
@section('meta_description', 'Thedi Advisors Budget Tracker is currently under development.')
@section('canonical_url', url('/budget-tracker'))
@section('og_image', asset('images/jane1.jpg'))

@section('content')

<div class="min-h-screen bg-[#FAF8F5] flex items-center justify-center px-6">

<div class="max-w-xl text-center">

    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#F8EEEB]">
        <svg class="h-8 w-8 text-[#A04F3F]"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="1.7"
             stroke-linecap="round"
             stroke-linejoin="round">

            <rect x="4" y="3" width="16" height="18" rx="2"/>
            <path d="M9 3v3"/>
            <path d="M15 3v3"/>
            <path d="M4 10h16"/>
            <path d="M8 16l2.5-2.5L14 16l4-5"/>

        </svg>
    </div>

    <p class="mt-6 text-xs font-semibold uppercase tracking-[0.2em] text-[#A04F3F]">
        Coming Soon
    </p>

    <h1 class="mt-3 text-4xl font-bold tracking-tight text-[#3a231c] sm:text-5xl">
        Budget Tracker
    </h1>


   
    {{-- Message --}}
    <div class="mt-8 rounded-2xl border border-[#A04F3F]/20 bg-white px-6 py-5">
        <p class="text-sm font-medium text-[#3a231c]">
            This page is currently under development.
        </p>

        <p class="mt-1 text-sm text-gray-500">
            We'll have it ready for you soon.
        </p>
    </div>

    {{-- Back button --}}
    <a href="{{ url('/') }}"
       class="mt-8 inline-flex items-center gap-2 rounded-full
              bg-[#A04F3F] px-6 py-3
              text-xs font-semibold uppercase tracking-[0.14em]
              text-white transition-all duration-200
              hover:bg-[#8f4436] hover:gap-3">

        Back to Home

        <svg class="h-4 w-4"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="2"
             stroke-linecap="round"
             stroke-linejoin="round">

            <path d="M5 12h14"/>
            <path d="M12 5l7 7-7 7"/>

        </svg>

    </a>

</div>


</div>

@endsection

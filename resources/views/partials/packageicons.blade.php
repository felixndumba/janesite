@php
$services = [
    [
        'label'       => 'Packages',
        'description' => "1. Individual Financial Planning\n2. Couples Financial Planning\n3. Business Financial Planning\n4. Chama Financial Planning\n5. Corporate Financial Wellness",
        'cta'         => 'View Packages',
        'href'        => route('services'),
        'tint'        => '#c99786',
    ],

    [
        'label'       => 'Masterclass',
        'description' => "1. Budgeting Masterclass\n2. Debt Management & Mobile Loans Masterclass\n3. Wealth Creation Masterclass\n4. Financial Freedom Masterclass",
        'cta'         => 'Browse Masterclass',
        'href'        => route('master'),
        'tint'        => '#a04f3f',
    ],

    [
        'label'       => 'Budget Tracker',
        'description' => "1. Budget Tracker\n2. Debt Tracker\n3. Financial Goals Tracker\n4. Investment Tracker\n5. Net Worth Calculator",
        'cta'         => 'Try the Tracker',
        'href'        => route('budget-tracker'),
        'tint'        => '#c99786',
    ],

    [
        'label'       => 'Financial Solutions',
        'description' => "1. Savings & Investment Accounts\n2. Trust Funds\n3. Insurance Solutions (Life, Medical, General & Business Insurance)",
        'cta'         => 'Talk to an Expert',
        'href'        => route('financial-products'),
        'tint'        => '#a04f3f',
        'dark'        => true,
    ],
];
@endphp

<section class="bg-[#fdf9f6] py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">

        <div class="max-w-4xl mb-14 sm:mb-16">

            <!-- Small Label -->
            <div class="flex items-center gap-3 mb-5">
                <span class="h-px w-10 bg-[#a04f3f]"></span>

                <span class="text-xs font-semibold uppercase tracking-[0.25em] text-[#a04f3f]">
                    Financial Services
                </span>

                <span class="h-px w-10 bg-[#a04f3f]"></span>
            </div>

            <!-- Main Message -->
            <h2 class="font-[Poppins] text-3xl sm:text-4xl md:text-5xl font-semibold leading-tight tracking-tight text-[#3a231c]">
                Explore our services.
            </h2>

        </div>

        <!-- Services Grid -->
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

            @foreach($services as $i => $s)

                @php
                    $dark = $s['dark'] ?? false;

                    // Make only the Masterclass text white
                    $masterclass = $s['label'] === 'Masterclass';

                    $index = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
                @endphp

                <article
                    class="group relative flex flex-col p-8 lg:p-7 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-2xl"
                    style="background-color: {{ $s['tint'] }}"
                >

                    <div
                        class="absolute top-0 left-6 right-6 h-px rounded-full {{ ($dark || $masterclass) ? 'bg-white/15' : 'bg-[#3a231c]/8' }}">
                    </div>

                    <!-- Icon -->
                    <div
                        class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-xl
                        {{ ($dark || $masterclass)
                            ? 'bg-white/10 text-white'
                            : 'bg-white/50 text-[#3a231c]' }}
                        backdrop-blur-sm transition-all duration-300
                        group-hover:scale-110 group-hover:shadow-lg"
                    >

                        @switch($i)

                            @case(0)
                                <!-- Packages: Layered bundle -->
                                <svg
                                    class="h-6 w-6"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path d="M12 2L2 7l10 5 10-5-10-5z" />
                                    <path d="M2 17l10 5 10-5" />
                                    <path d="M2 12l10 5 10-5" />
                                </svg>
                            @break

                            @case(1)
                                <!-- Masterclass: Video presentation -->
                                <svg
                                    class="h-6 w-6"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <rect x="2" y="4" width="20" height="14" rx="2" />
                                    <path
                                        d="M10 10l5 3.5-5 3.5V10z"
                                        fill="currentColor"
                                        stroke="none"
                                    />
                                    <path d="M2 20h20" />
                                    <path d="M12 18v2" />
                                </svg>
                            @break

                            @case(2)
                                <!-- Budget Tracker: Clipboard with trend -->
                                <svg
                                    class="h-6 w-6"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <rect x="4" y="3" width="16" height="18" rx="2" />
                                    <path d="M9 3v3" />
                                    <path d="M15 3v3" />
                                    <path d="M4 10h16" />
                                    <path d="M8 16l2.5-2.5L14 17l4-5" />
                                </svg>
                            @break

                            @case(3)
                                <!-- Financial Solutions: Expert consultation -->
                                <svg
                                    class="h-6 w-6"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                </svg>
                            @break

                        @endswitch

                    </div>

                    <!-- Content -->
                    <h3
                        class="text-lg font-bold tracking-tight
                        {{ ($dark || $masterclass)
                            ? 'text-white'
                            : 'text-[#3a231c]' }}"
                    >
                        {{ $s['label'] }}
                    </h3>

                    <!-- Description -->
                    <p
                        class="mt-1 mb-3 text-[15px] leading-normal whitespace-pre-line flex-grow
                        {{ ($dark || $masterclass)
                            ? 'text-white/80'
                            : 'text-[#3a231c]/65' }}"
                    >
                        {{ $s['description'] }}
                    </p>

                    <!-- CTA -->
                    <a
                        href="{{ $s['href'] }}"
                        class="inline-flex items-center gap-2 self-start rounded-full px-5 py-2.5 text-[11px] font-semibold uppercase tracking-[0.14em] transition-all duration-200
                        {{ ($dark || $masterclass)
                            ? 'bg-white text-[#a04f3f] hover:bg-white/90 hover:gap-3 hover:shadow-lg'
                            : 'bg-white/70 text-[#3a231c] hover:bg-white hover:gap-3 hover:shadow-md' }}"
                    >

                        {{ $s['label'] === 'Packages' ? 'Join ' . $s['label'] : $s['cta'] }}

                        <svg
                            class="h-3 w-3 transition-transform duration-200"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>

                    </a>

                </article>

            @endforeach

        </div>

    </div>
</section>
<section
    data-aos="zoom-in-left"
    data-aos-delay="400"
    data-aos-duration="1200"
    class="relative py-12 sm:py-16 md:py-24 px-4 sm:px-6 bg-[#a04f3f] overflow-hidden"
>

    <!-- =========================================================
         MOBILE BACKGROUND IMAGE
         Visible only below md (mobile)
    ========================================================== -->
    <div
        class="absolute inset-0  bg-cover bg-center-top md:hidden"
        style="background-image: url('{{ asset('images/one.jpeg') }}');"
    ></div>

    <!-- =========================================================
         MOBILE IMAGE OVERLAY
    ========================================================== -->
    <div class="
        absolute inset-0
        bg-[#3a1712]/70
        md:hidden
    "></div>


    <!-- =========================================================
         DESKTOP / TABLET GRADIENT OVERLAY
         The original background remains on md and above
    ========================================================== -->
    <div class="
        absolute inset-0
        bg-gradient-to-r
        from-[#a04f3f]/90
        via-[#a04f3f]/80
        to-[#a04f3f]/70
        hidden md:block
    "></div>


    <!-- =========================================================
         CONTENT
    ========================================================== -->
    <div
        class="
            relative
            max-w-7xl
            mx-auto
            grid
            grid-cols-1
            md:grid-cols-2
            items-center
            gap-8
            sm:gap-10
            md:gap-16
        "
    >

        <!-- =====================================================
             LEFT IMAGE
             Hidden on mobile
             Visible on tablet/laptop
        ====================================================== -->
        <div
            class="hidden md:flex justify-center"
            data-aos="zoom-in-right"
            data-aos-delay="200"
            data-aos-duration="1000"
        >

            <div class="
                relative
                w-52 h-52
                sm:w-64 sm:h-64
                md:w-80 md:h-80
                lg:w-96 lg:h-96
                overflow-hidden
                rounded-full
                shadow-xl
                border-8 sm:border-[10px]
                border-[#f9f7f4]
            ">

                <img
                    src="{{ asset('images/one.jpeg') }}"
                    alt="Jane Ndichu - Personal Financial Advisor in Kenya providing financial planning and coaching"
                    class="object-cover object-top w-full h-full"
                    loading="eager"
                />

            </div>

        </div>


        <!-- =====================================================
             RIGHT CONTENT
        ====================================================== -->
        <div
            data-aos="zoom-in-left"
            data-aos-delay="300"
            data-aos-duration="1000"
            class="
                text-center
                md:text-left
                md:col-span-1
            "
        >

            <!-- Heading -->
            <h1 class="
                text-3xl
                sm:text-4xl
                md:text-5xl
                lg:text-6xl
                font-bold
                leading-tight
                mb-4 sm:mb-6
                tracking-tight
                text-white
            ">

                Guiding You to Financial<br class="hidden md:block">

                <span class="text-white">
                    Freedom & Wealth Growth
                </span>

            </h1>


            <!-- Description -->
            <p class="
                text-base
                sm:text-lg
                mb-6 sm:mb-8
                leading-relaxed
                text-white
                max-w-2xl
                mx-auto md:mx-0
            ">

                Discover the power of smart financial planning in Kenya.
                With tailored personal financial coaching and hands-on
                investment guidance, we empower individuals, businesses,
                and chamas to thrive.

            </p>


            <!-- Button -->
            <div class="flex justify-center md:justify-start">

                <a
                    href="https://calendly.com/janendichu1/free_discovery_call"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="
                        inline-block
                        bg-white
                        text-black
                        font-semibold
                        px-6 sm:px-8
                        py-3
                        text-sm sm:text-base
                        rounded-full
                        shadow-md
                        hover:scale-105
                        hover:bg-gray-100
                        transition-all
                        duration-300
                        ease-in-out
                    "
                >

                    Book a Free Financial Discovery Call

                </a>

            </div>

        </div>

    </div>

</section>
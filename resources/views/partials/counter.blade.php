<section class="py-20 bg-[#f9f7f4] px-6 md:px-12">
    <div class="max-w-6xl mx-auto">

        <!-- Heading -->
        <div class="text-center mb-14">
            <h2 class="text-4xl font-bold text-[#a04f3f] mb-3">
                Our Impact in Numbers
            </h2>
            <p class="text-gray-600 italic text-lg">
                Trusted by individuals, businesses, and organizations across Kenya
            </p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">

             <div>
    <h3 class="text-5xl font-bold text-[#a04f3f]">
        <span class="counter" data-target="2500">0</span><span class="text-4xl">+</span>
    </h3>
    <p class="mt-2 text-gray-700 font-medium">Individuals</p>
</div>
  
         <div>
    <h3 class="text-5xl font-bold text-[#a04f3f]">
        <span class="counter" data-target="10">0</span><span class="text-4xl">+</span>
    </h3>
    <p class="mt-2 text-gray-700 font-medium">Companies</p>
</div>


             <div>
    <h3 class="text-5xl font-bold text-[#a04f3f]">
        <span class="counter" data-target="5">0</span><span class="text-4xl">+</span>
    </h3>
    <p class="mt-2 text-gray-700 font-medium">Business</p>
</div>

  <div>
    <h3 class="text-5xl font-bold text-[#a04f3f]">
        <span class="counter" data-target="10">0</span><span class="text-4xl">+</span>
    </h3>
    <p class="mt-2 text-gray-700 font-medium">Chamas & Groups</p>
</div>
        </div>
    </div>

    <!-- Count Up Script -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll(".counter");

            const animateCounter = (counter) => {
                const target = +counter.dataset.target;
                let current = 0;
                const increment = target / 120;

                const update = () => {
                    current += increment;
                    if (current < target) {
                        counter.textContent = Math.ceil(current);
                        requestAnimationFrame(update);
                    } else {
                        counter.textContent = target;
                    }
                };

                update();
            };

            const observer = new IntersectionObserver(
                entries => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            animateCounter(entry.target);
                            observer.unobserve(entry.target);
                        }
                    });
                },
                { threshold: 0.5 }
            );

            counters.forEach(counter => observer.observe(counter));
        });
    </script>
</section>

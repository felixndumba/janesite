<!-- ABOUT SECTION -->
<section class="grid grid-cols-1 md:grid-cols-4 min-h-screen" 
   data-aos="zoom-in-right" data-aos-delay="200" data-aos-duration="1000" >
  <!-- 01 Meet Jane -->
  <div class="relative bg-cover bg-center" style="background-image: url('/images/2.jpg');">
    <div class="bg-black/50 h-full p-6 flex flex-col justify-center">
      <span class="text-4xl font-extrabold text-white mb-4">01</span>
      <h3 class="text-2xl font-bold text-white mb-4">Meet Jane</h3>
      <p class="text-white leading-relaxed">
        Jane is a 4-time Top-Award winning Financial Advisor with 7 years of experience, 
        certified by IRA, CMA, and RBA. She offers a personalized financial freedom journey 
        with a friendly, results-driven approach to savings, investments, wealth building, 
        and protection.
      </p>
      <a href="/about-jane" class="mt-6 inline-block bg-black text-white font-bold px-4 py-2 rounded shadow">
        Learn More
      </a>
    </div>
  </div>

  <!-- 02 My Certifications & Awards -->
  <div class="bg-[#a04f3f] p-6 flex flex-col justify-center">
    <span class="text-4xl font-extrabold text-white mb-4">02</span>
    <h3 class="text-2xl font-bold mb-4">My Certifications & Awards</h3>
    <p class="text-gray-800 leading-relaxed">
      Certified by IRA, CMA, and RBA. Recognized with 4 Top-Awards in the financial 
      sector for excellence and outstanding client results.
    </p>
  </div>

  <!-- 03 My Portfolio -->
  <div class="relative bg-cover bg-center" style="background-image: url('/images/2.jpg');">
    <div class="bg-black/50 h-full p-6 flex flex-col justify-center">
      <span class="text-4xl font-extrabold text-white mb-4">03</span>
      <h3 class="text-2xl font-bold text-white mb-4">My Portfolio</h3>
      <p class="text-white leading-relaxed">
        Worked with 2000+ individuals, 10+ companies, 5+ businesses, and 10+ chamas, 
        delivering measurable financial growth and security.
      </p>
     
    </div>
  </div>

  <!-- 04 My Videos & Podcasts -->
  <div class="bg-[#a04f3f] p-6 flex flex-col justify-center">
    <span class="text-4xl font-extrabold text-white mb-4">04</span>
    <h3 class="text-2xl font-bold mb-4">My Videos & Podcasts</h3>
    <p class="text-gray-800 leading-relaxed">
      Explore a variety of videos and podcasts focused on financial literacy, 
      investment strategies, and wealth protection tips.
    </p>
    <a href="https://youtube.com" target="_blank" class="mt-6 inline-block bg-black text-white font-bold px-4 py-2 rounded shadow">
      Watch on YouTube
    </a>
  </div>
</section>


<!-- STATS SECTION -->
<section class=" py-16 px-6 md:px-12" data-aos="zoom-in-right" data-aos-delay="200" data-aos-duration="1000">
  <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
    <div>
      <span class="text-5xl font-bold text-[#a04f3f]" data-count="2000">0</span>
      <p class="text-lg font-medium text-black">Individuals</p>
    </div>
    <div>
      <span class="text-5xl font-bold text-[#a04f3f]" data-count="10">0</span>
      <p class="text-lg font-medium text-black">Companies</p>
    </div>
    <div>
      <span class="text-5xl font-bold text-[#a04f3f]" data-count="5">0</span>
      <p class="text-lg font-medium text-black">Businesses</p>
    </div>
    <div>
      <span class="text-5xl font-bold text-[#a04f3f]" data-count="10">0</span>
      <p class="text-lg font-medium text-black">Chamas</p>
    </div>
  </div>
</section>

<!-- COUNT-UP SCRIPT -->
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll("[data-count]");
    const speed = 20; // lower = faster

    const countUp = (counter) => {
      const target = +counter.getAttribute("data-count");
      const updateCount = () => {
        const current = +counter.innerText;
        const increment = Math.ceil(target / speed);
        if (current < target) {
          counter.innerText = current + increment;
          setTimeout(updateCount, 30);
        } else {
          counter.innerText = target + "+";
        }
      };
      updateCount();
    };

    const options = { threshold: 0.5 };
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          countUp(entry.target);
          observer.unobserve(entry.target);
        }
      });
    }, options);

    counters.forEach(counter => observer.observe(counter));
  });
</script>

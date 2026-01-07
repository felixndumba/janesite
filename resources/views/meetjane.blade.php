@extends('layouts.app')
@extends('layouts.header')

<br><br>

<!-- ABOUT SECTION (ALTERNATING LAYOUT) -->
<section class="py-16 px-6 md:px-12 space-y-20">

  <!-- 01 Meet Jane (Image Left, Text Right) -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

    <!-- Image -->
    <div class="w-full max-w-md mx-auto md:max-w-full">
      <img 
        src="{{ asset('images/two.jpeg') }}" 
        alt="Meet Jane"
        class="w-full h-auto rounded-xl shadow-md object-cover"
        loading="lazy"
      >
    </div>

    <!-- Text -->
    <div>
      <h3 class="text-3xl font-bold mt-3 mb-4 text-[#a04f3f]" style="font-family: 'Poppins', sans-serif;">
        Meet Jane
      </h3>

      <p class="text-gray-700 leading-relaxed italic text-lg">
        Jane is a 4-time Top-Award–winning Financial Advisor with 7 years of experience,
        certified by IRA, CMA, and RBA. She founded Thedi Advisors with a clear mission—to
        provide personalized, research-driven financial guidance that empowers clients
        to build lasting wealth. Through her friendly yet results-driven approach, she
        guides individuals and organizations on a tailored journey toward financial
        freedom, covering savings, investments, wealth building, and financial protection.
      </p>
    </div>
  </div>

  <!-- 02 Certifications (Text Left, Image Right) -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

    <!-- Text -->
    <div>
      <h3 class="text-3xl font-bold mt-3 mb-4 text-[#a04f3f]" style="font-family: 'Poppins', sans-serif;">
        My Certifications & Awards
      </h3>

      <p class="text-gray-700 text-lg leading-relaxed italic">
        Certified by IRA, CMA, and RBA, our firm has consistently demonstrated adherence
        to the highest industry standards. We have been honored with four distinguished
        awards in the financial sector, recognizing our commitment to excellence,
        innovation, and delivering exceptional results for our clients.
      </p>
    </div>

    <!-- Image -->
    <div class="w-full max-w-md mx-auto md:max-w-full">
      <img 
        src="{{ asset('images/certificate.jpg') }}" 
        alt="Certifications"
        class="w-full h-auto max-h-[350px] rounded-xl shadow-md object-cover"
        loading="lazy"
      >
    </div>
  </div>

  <!-- 03 Portfolio (Image Left, Text Right) -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

    <!-- Image -->
    <div class="w-full max-w-md mx-auto md:max-w-full">
      <img 
        src="{{ asset('images/four.jpeg') }}" 
        alt="Portfolio"
        class="w-full h-auto rounded-xl shadow-md object-cover"
        loading="lazy"
      >
    </div>

    <!-- Text -->
    <div>
      <h3 class="text-3xl font-bold mt-3 mb-4 text-[#a04f3f]" style="font-family: 'Poppins', sans-serif;">
        My Portfolio
      </h3>

      <p class="text-gray-700 text-lg leading-relaxed italic">
        With a portfolio of 3,200+ individuals, 22+ corporate partners, 14+ business
        clients, and 17+ chamas, we deliver strategic financial solutions that consistently
        drive performance, stability, and confident decision-making.
      </p>
    </div>
  </div>

  <!-- 04 Videos & Podcasts -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

    <!-- Text -->
    <div>
      <h3 class="text-3xl font-bold mt-3 mb-4 text-[#a04f3f] tracking-wide" style="font-family: 'Poppins', sans-serif;">
        My Videos & Podcasts
      </h3>

      <p class="text-gray-700 leading-relaxed text-lg italic">
        Discover insightful videos and podcasts covering financial literacy, smart
        investment strategies, wealth-building frameworks, and long-term financial
        security tips.
      </p>

      <div class="flex gap-4 mt-6">
        <a 
          href="https://www.youtube.com/results?search_query=janendichu"
          target="_blank"
          class="text-[#a04f3f] font-semibold underline hover:text-[#c45b1f] transition"
        >
          View More Videos →
        </a>
      </div>
    </div>

    <!-- Video -->
    <div class="rounded-xl overflow-hidden shadow-lg">
      <iframe 
        class="w-full aspect-video rounded-xl"
        src="https://www.youtube.com/embed/Vpri9a74TC0"
        title="YouTube video player"
        allowfullscreen>
      </iframe>
    </div>
  </div>

</section>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

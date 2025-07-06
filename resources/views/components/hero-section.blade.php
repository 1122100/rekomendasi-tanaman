{{-- Hero Section --}}
<section
  class="relative z-7 bg-cover bg-center min-h-[75vh] md:min-h-[85vh] flex items-center text-white pt-24 md:pt-32 pb-56 md:pb-0 overflow-visible"
  style="background-image: url('{{Vite::asset('resources/img/uiregister2.webp')}}')"
>
    {{-- Overlay hitam --}}
    <div class="absolute inset-0 bg-black opacity-30"></div>

    {{-- Konten Hero --}}
    <div class="container mx-auto px-6 lg:px-16 flex flex-col md:flex-row items-center relative z-10">
        {{-- Teks Hero --}}
        <div class="md:w-1/2 text-center md:text-left mb-10 md:mb-0 md:pr-10">
            <h1
              class="font-playfair text-3xl sm:text-4xl lg:text-7xl font-semibold text-yellow-400 mb-6 opacity-0 animate-fadeInUp"
              style="animation-delay: 0.2s;">
                Decorate your <br class="hidden md:block">Home with plants
            </h1>
            <p
              class="text-lg lg:text-xl mb-8 max-w-lg mx-auto md:mx-0 leading-relaxed md:leading-loose opacity-0 animate-fadeInUp text-white"
              style="animation-delay: 0.4s;"
            >
                Ingin rumah lebih hijau tapi bingung mulai dari mana? Gunakan aplikasi rekomendasi tanaman kami dan temukan tanaman hias favorit yang cocok dengan lingkunganmu!
            </p>
            <a
              href="#"
              class="bg-[#386641] hover:bg-[#2A4B30] text-white font-semibold py-4 px-10 rounded-full shadow-md transition duration-300 ease-in-out transform hover:scale-105 inline-block opacity-0 animate-fadeInUp"
              style="animation-delay: 0.6s;"
            >
                Coba sekarang
            </a>
        </div>

        {{-- Gambar Bulat Hero (pastikan overflow container tidak men‐clip dan z-index lebih tinggi) --}}
        <div class="md:w-1/2 flex justify-center md:justify-end relative z-20 overflow-visible">
            <div
              class="hidden md:block w-96 h-96 sm:w-76 sm:h-96 lg:w-94 lg:h-[500px] rounded-full border-8 border-white overflow-hidden shadow-2xl opacity-0 animate-fadeInScale -mb-32"
              style="animation-delay: 0.5s;"
            >
                <img
                  src="{{ Vite::asset('resources/img/uilogin.webp') }}"
                  alt="Interior with plants"
                  class="w-full h-full object-cover"
                >
            </div>
        </div>
    </div>


    <div class="absolute bottom-0 lg:-bottom-40 left-0 w-full overflow-hidden leading-[0] z-0">
      <svg
        class="relative block w-full h-56 md:h-56 lg:h-72"
        xmlns="http://www.w3.org/2000/svg"
        preserveAspectRatio="none"
        viewBox="0 0 1200 520"
      >
        <path
          d="M0,10 C300,500 800,-30 1200,120 L1200,520 L0,520 Z"
          class="fill-white"
        />
      </svg>
    </div>
</section>

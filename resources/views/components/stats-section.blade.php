{{-- Stats Section --}}
<section class="bg-white -z-0 relative pt-16 md:pt-24 pb-12 overflow-visible">
  <div class="container px-6 lg:px-16 mx-auto">
    <div class="max-w-3xl grid grid-cols-1 md:grid-cols-3 gap-4 text-center md:text-left">
      @php
        $stats = [
          ['number' => '2400+', 'label' => 'Varieties'],
          ['number' => '4600+', 'label' => 'Happy Customers'],
          ['number' => '300+',  'label' => 'Award Winning'],
        ];
      @endphp

      @foreach ($stats as $index => $stat)
        <div
          class="opacity-0 animate-fadeInUp"
          style="animation-delay: {{ 0.2 + $index * 0.2 }}s;"
        >
          <span class="block text-xl md:text-2xl lg:text-4xl font-bold text-[#386641] mb-0.5">
            {{ $stat['number'] }}
          </span>
          <span class="text-sm md:text-base text-gray-600">
            {{ $stat['label'] }}
          </span>
        </div>
      @endforeach
    </div>
  </div>
</section>

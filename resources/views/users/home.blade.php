@extends('layouts.appuser')

@section('content')
    <x-hero-section />
    <x-stats-section />
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 w-full h-full">
            <div class="absolute inset-0 bg-gradient-to-r from-green-900/80 to-black/50 z-10"></div>
        </div>
        <div class="container mx-auto px-4 relative z-20 text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                Temukan <span class="text-green-400">Tanaman Ideal</span> untuk Lingkungan Anda
            </h1>
            <p class="text-xl text-white/90 mb-8 max-w-3xl mx-auto">
                Sistem rekomendasi cerdas berbasis Fuzzy Mamdani untuk membantu Anda menemukan tanaman yang paling cocok dengan kondisi lingkungan Anda.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('rekomendasi') }}" class="px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-medium rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-green-500/30">
                    <i class="fas fa-leaf mr-2"></i> Dapatkan Rekomendasi
                </a>
                <a href="{{ route('galery') }}" class="px-8 py-4 bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white font-medium rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-images mr-2"></i> Lihat Galeri Tanaman
                </a>
            </div>
        </div>
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20 text-white animate-bounce">
            <i class="fas fa-chevron-down text-2xl"></i>
        </div>
    </section>

    <section class="py-20 bg-gradient-to-b from-green-50 to-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Fitur Utama</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    PlantCare menyediakan berbagai fitur untuk membantu Anda menemukan dan merawat tanaman dengan lebih baik
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6 text-green-600">
                        <i class="fas fa-brain text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Sistem Fuzzy Mamdani</h3>
                    <p class="text-gray-600">
                        Menggunakan algoritma Fuzzy Mamdani untuk memberikan rekomendasi tanaman yang paling sesuai dengan kondisi lingkungan Anda.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 text-blue-600">
                        <i class="fas fa-database text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Database Tanaman</h3>
                    <p class="text-gray-600">
                        Akses ke database lengkap berbagai jenis tanaman dengan informasi detail tentang kebutuhan dan cara perawatannya.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6 text-purple-600">
                        <i class="fas fa-history text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Riwayat Rekomendasi</h3>
                    <p class="text-gray-600">
                        Simpan dan akses riwayat rekomendasi tanaman yang pernah Anda dapatkan untuk referensi di masa mendatang.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Cara Kerja</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Sistem rekomendasi kami menggunakan metode Fuzzy Mamdani untuk memberikan hasil yang akurat
                </p>
            </div>

            <div class="grid md:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="text-center">
                    <div class="relative">
                        <div class="w-20 h-20 bg-green-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6 z-10 relative">
                            1
                        </div>
                        <div class="absolute top-10 left-1/2 h-0.5 bg-green-200 w-full hidden md:block"></div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Input Parameter</h3>
                    <p class="text-gray-600">
                        Masukkan kondisi lingkungan seperti suhu, kelembapan, dan intensitas cahaya.
                    </p>
                </div>

                <div class="text-center">
                    <div class="relative">
                        <div class="w-20 h-20 bg-green-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6 z-10 relative">
                            2
                        </div>
                        <div class="absolute top-10 left-1/2 h-0.5 bg-green-200 w-full hidden md:block"></div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Fuzzifikasi</h3>
                    <p class="text-gray-600">
                        Sistem mengubah input menjadi nilai fuzzy menggunakan fungsi keanggotaan.
                    </p>
                </div>

                <div class="text-center">
                    <div class="relative">
                        <div class="w-20 h-20 bg-green-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6 z-10 relative">
                            3
                        </div>
                        <div class="absolute top-10 left-1/2 h-0.5 bg-green-200 w-full hidden md:block"></div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Inferensi</h3>
                    <p class="text-gray-600">
                        Menerapkan aturan IF-THEN untuk menentukan tanaman yang cocok.
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-green-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">
                        4
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Hasil</h3>
                    <p class="text-gray-600">
                        Menampilkan rekomendasi tanaman yang paling sesuai dengan kondisi Anda.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Tanaman Section -->
    <section class="py-20 bg-green-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Tanaman Populer</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Tanaman yang paling banyak direkomendasikan berdasarkan kondisi lingkungan
                </p>
            </div>

           <div class="container mx-auto px-4 py-8 mt-10">
  <h2 class="text-2xl font-bold text-green-800 mb-6">Tanaman Pilihan</h2>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse($plants as $plant)
       <div class="plant-card bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300" data-name="{{ strtolower($plant->nama) }}">
            <div class="relative h-48 overflow-hidden">
                @if($plant->gambar)
                    <img src="{{ asset('storage/tanaman/' . $plant->gambar) }}" alt="{{ $plant->nama }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-green-100 flex items-center justify-center">
                        <i class="fas fa-leaf text-green-500 text-4xl"></i>
                    </div>
                @endif
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-3">
                    <h3 class="text-white font-semibold text-lg">{{ $plant->nama }}</h3>
                </div>
            </div>
            <div class="p-4">
                <div class="flex flex-wrap gap-2 mb-3">
                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">{{ $plant->parameterSuhu->label ?? 'N/A' }}</span>
                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">{{ $plant->parameterKelembapan->label ?? 'N/A' }}</span>
                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">{{ $plant->parameterCahaya->label ?? 'N/A' }}</span>
                </div>
                <p class="text-gray-600 text-sm line-clamp-2 mb-3">
                    {{ Str::limit($plant->deskripsi ?? 'Tidak ada deskripsi', 100) }}
                </p>
                <a href="{{ route('tanaman.detail', $plant->id) }}" class="inline-block w-full text-center py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-300">
                    Detail Tanaman
                </a>
            </div>
        </div>
    @empty
      <p class="text-center text-gray-500">Belum ada data tanaman.</p>
    @endforelse
  </div>
            <div class="text-center mt-10">
                <a href="{{ route('galery') }}" class="inline-block px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-300">
                    Lihat Semua Tanaman <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimoni pengguna Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Testimoni Pengguna</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Apa kata pengguna tentang sistem rekomendasi tanaman kami
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimoni 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 mr-4">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Rahmat Maliki</h4>
                            <p class="text-sm text-gray-500">Pecinta Tanaman</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">
                        "Sistem rekomendasi ini sangat membantu saya menemukan tanaman yang cocok untuk apartemen saya yang minim cahaya matahari. Hasilnya sangat akurat!"
                    </p>
                    <div class="mt-4 flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Testimoni 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 mr-4">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Muhammad Edebali</h4>
                            <p class="text-sm text-gray-500">Petani Urban</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">
                        "Sebagai pemula dalam berkebun, aplikasi ini memberikan rekomendasi yang tepat untuk kondisi teras rumah saya yang panas dan terik."
                    </p>
                    <div class="mt-4 flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>

                <!-- Testimoni 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 mr-4">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Asmaul Khusna</h4>
                            <p class="text-sm text-gray-500">Interior Designer</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">
                        "Saya menggunakan sistem ini untuk merekomendasikan tanaman kepada klien saya. Hasilnya selalu memuaskan dan tanaman tumbuh dengan baik di interior yang saya desain."
                    </p>
                    <div class="mt-4 flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="-z-10 -mt-10 py-20 bg-gradient-to-r from-green-800 to-green-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Siap Menemukan Tanaman Ideal Anda?</h2>
            <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
                Dapatkan rekomendasi tanaman yang paling cocok dengan kondisi lingkungan Anda sekarang juga.
            </p>
            <a href="{{ route('rekomendasi') }}" class="inline-block px-8 py-4 bg-white text-green-700 font-bold rounded-full transition-all duration-300 transform hover:scale-105 hover:bg-green-100 shadow-lg">
                Mulai Sekarang <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </section>
@endsection

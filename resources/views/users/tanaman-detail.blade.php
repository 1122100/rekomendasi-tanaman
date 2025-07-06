@extends('layouts.appuser')

@section('content')
<div class="container mx-auto px-4 py-8 mt-10">
    <div class="mb-6">
        <a href="{{ route('galery') }}" class="text-green-600 hover:text-green-800 transition-colors duration-300">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Galeri
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="md:flex">
            <div class="md:w-1/3">
                @if($tanaman->gambar)
                    <img src="{{ asset('storage/tanaman/' . $tanaman->gambar) }}" alt="{{ $tanaman->nama }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-64 md:h-full bg-green-100 flex items-center justify-center">
                        <i class="fas fa-leaf text-green-500 text-6xl"></i>
                    </div>
                @endif
            </div>
            <div class="md:w-2/3 p-6">
                <h1 class="text-3xl font-bold text-green-800 mb-4">{{ $tanaman->nama }}</h1>
                
                <div class="flex flex-wrap gap-2 mb-6">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full flex items-center">
                        <i class="fas fa-temperature-low mr-2"></i>{{ $tanaman->parameterSuhu->label ?? 'N/A' }}
                    </span>
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full flex items-center">
                        <i class="fas fa-tint mr-2"></i>{{ $tanaman->parameterKelembapan->label ?? 'N/A' }}
                    </span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full flex items-center">
                        <i class="fas fa-sun mr-2"></i>{{ $tanaman->parameterCahaya->label ?? 'N/A' }}
                    </span>
                </div>
                
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Deskripsi</h2>
                    <p class="text-gray-600">
                        {{ $tanaman->deskripsi ?? 'Tidak ada deskripsi tersedia untuk tanaman ini.' }}
                    </p>
                </div>
                
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Cara Perawatan</h2>
                    <div class="text-gray-600">
                        @if($tanaman->cara_perawatan)
                            {!! nl2br(e($tanaman->cara_perawatan)) !!}
                        @else
                            <p>Tidak ada informasi perawatan tersedia untuk tanaman ini.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pt-20">
    </div>
</div>
@endsection
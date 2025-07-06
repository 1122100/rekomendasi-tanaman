@extends('layouts.appuser')

@section('content')
<div class="min-h-screen flex items-center justify-center pt-16 pb-32">
    <div class="max-w-md w-full p-8 bg-white rounded-2xl shadow-xl">
        <div class="text-center">
            <!-- 500 SVG Illustration -->
            <div class="w-48 h-48 mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" class="w-full h-full">
                    <g fill="none" fill-rule="evenodd">
                        <path fill="#F2F2F2" d="M250 400c82.843 0 150-67.157 150-150S332.843 100 250 100 100 167.157 100 250s67.157 150 150 150z"/>
                        <path fill="#4CAF50" d="M250 380c71.797 0 130-58.203 130-130S321.797 120 250 120 120 178.203 120 250s58.203 130 130 130z" opacity=".2"/>
                        <path fill="#3F3D56" d="M250 380c71.797 0 130-58.203 130-130S321.797 120 250 120 120 178.203 120 250s58.203 130 130 130zm0-250c66.274 0 120 53.726 120 120s-53.726 120-120 120-120-53.726-120-120 53.726-120 120-120z"/>
                        <path fill="#FF6584" d="M200 230c0-5.523 4.477-10 10-10h80c5.523 0 10 4.477 10 10v20c0 5.523-4.477 10-10 10h-80c-5.523 0-10-4.477-10-10v-20z"/>
                        <path fill="#3F3D56" d="M200 280c0-5.523 4.477-10 10-10h80c5.523 0 10 4.477 10 10v20c0 5.523-4.477 10-10 10h-80c-5.523 0-10-4.477-10-10v-20z"/>
                        <path fill="#FFF" d="M220 240a5 5 0 1 1-10 0 5 5 0 0 1 10 0zM250 240a5 5 0 1 1-10 0 5 5 0 0 1 10 0zM280 240a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                        <path fill="#FFF" d="M220 290a5 5 0 1 1-10 0 5 5 0 0 1 10 0zM250 290a5 5 0 1 1-10 0 5 5 0 0 1 10 0zM280 290a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                    </g>
                </svg>
            </div>
            
            <!-- Error Message -->
            <h1 class="text-6xl font-bold text-gray-800 mb-2">500</h1>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Kesalahan Server</h2>
            <p class="text-gray-600 mb-8">
                Maaf, terjadi kesalahan pada server kami. Tim teknis kami sedang bekerja untuk memperbaikinya.
            </p>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('home') }}" class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-home mr-2"></i> Kembali ke Beranda
                </a>
                <a href="javascript:history.back()" class="px-6 py-3 bg-gray-200 text-gray-800 font-medium rounded-lg hover:bg-gray-300 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
            
            <!-- Plant Decoration -->
            <div class="mt-10 flex justify-center">
                <div class="w-16 h-16 relative">
                    <div class="absolute bottom-0 w-full h-4 bg-green-800 rounded-full"></div>
                    <div class="absolute bottom-3 left-1/2 transform -translate-x-1/2 w-2 h-8 bg-green-700"></div>
                    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 w-8 h-8 bg-green-500 rounded-full"></div>
                </div>
                <div class="w-12 h-12 relative mx-4">
                    <div class="absolute bottom-0 w-full h-3 bg-green-800 rounded-full"></div>
                    <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 w-1 h-6 bg-green-700"></div>
                    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 w-6 h-6 bg-green-500 rounded-full"></div>
                </div>
                <div class="w-14 h-14 relative">
                    <div class="absolute bottom-0 w-full h-3 bg-green-800 rounded-full"></div>
                    <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 w-1 h-7 bg-green-700"></div>
                    <div class="absolute bottom-7 left-1/2 transform -translate-x-1/2 w-7 h-7 bg-green-500 rounded-full"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.appuser')

@section('content')
<div class="min-h-screen flex items-center justify-center pt-16 pb-32">
    <div class="max-w-md w-full p-8 bg-white rounded-2xl shadow-xl">
        <div class="text-center">
            <!-- Error SVG Illustration -->
            <div class="w-48 h-48 mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" class="w-full h-full">
                    <g fill="none" fill-rule="evenodd">
                        <circle cx="250" cy="250" r="130" fill="#F2F2F2"/>
                        <path fill="#4CAF50" d="M250 350c-55.228 0-100-44.772-100-100s44.772-100 100-100 100 44.772 100 100-44.772 100-100 100z" opacity=".2"/>
                        <path fill="#3F3D56" d="M250 350c-55.228 0-100-44.772-100-100s44.772-100 100-100 100 44.772 100 100-44.772 100-100 100zm0-190c-49.626 0-90 40.374-90 90s40.374 90 90 90 90-40.374 90-90-40.374-90-90-90z"/>
                        <path fill="#3F3D56" d="M310 250c0-33.137-26.863-60-60-60s-60 26.863-60 60 26.863 60 60 60 60-26.863 60-60zm-100 0c0-22.091 17.909-40 40-40s40 17.909 40 40-17.909 40-40 40-40-17.909-40-40z"/>
                        <path fill="#FF6584" d="M250 270c-11.046 0-20-8.954-20-20s8.954-20 20-20 20 8.954 20 20-8.954 20-20 20z"/>
                    </g>
                </svg>
            </div>
            
            <!-- Error Message -->
            <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $errorCode ?? '500' }}</h1>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">{{ $errorTitle ?? 'Terjadi Kesalahan' }}</h2>
            <p class="text-gray-600 mb-8">
                {{ $errorMessage ?? 'Maaf, terjadi kesalahan pada server. Silakan coba lagi nanti atau hubungi administrator.' }}
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
        </div>
    </div>
</div>
@endsection
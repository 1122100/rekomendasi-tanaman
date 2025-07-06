@extends('layouts.appuser')

@section('content')
<div class="min-h-screen flex items-center justify-center pt-16 pb-32">
    <div class="max-w-md w-full p-8 bg-white rounded-2xl shadow-xl">
        <div class="text-center">
            <!-- 404 SVG Illustration -->
            <div class="w-48 h-48 mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" class="w-full h-full">
                    <g fill="none" fill-rule="evenodd">
                        <path fill="#F2F2F2" d="M139.721 125.842c-1.697-8.649-10.43-14.114-19.079-12.417l-43.12 8.46c-8.648 1.697-14.113 10.43-12.416 19.079l24.913 127.066c1.697 8.648 10.43 14.113 19.079 12.416l43.12-8.46c8.648-1.697 14.113-10.43 12.416-19.079l-24.913-127.065z"/>
                        <path fill="#3F3D56" d="M121.1 115.422c-8.648 1.697-14.113 10.43-12.416 19.079l24.913 127.065c1.697 8.649 10.43 14.114 19.079 12.417l43.12-8.46c8.648-1.697 14.113-10.43 12.416-19.079l-24.913-127.066c-1.697-8.648-10.43-14.113-19.079-12.416l-43.12 8.46z"/>
                        <path fill="#FFF" d="M125.532 133.365l1.697 8.649 43.12-8.46-1.697-8.648z"/>
                        <path fill="#FFF" d="M129.749 154.79l1.697 8.649 43.12-8.46-1.697-8.648z"/>
                        <path fill="#FFF" d="M133.966 176.216l1.697 8.649 43.12-8.46-1.697-8.648z"/>
                        <path fill="#FFF" d="M138.183 197.642l1.697 8.649 43.12-8.46-1.697-8.648z"/>
                        <path fill="#FFF" d="M142.4 219.068l1.697 8.649 43.12-8.46-1.697-8.648z"/>
                        <path fill="#FFF" d="M146.617 240.494l1.697 8.649 43.12-8.46-1.697-8.648z"/>
                        <path fill="#F2F2F2" d="M377.721 125.842c-1.697-8.649-10.43-14.114-19.079-12.417l-43.12 8.46c-8.648 1.697-14.113 10.43-12.416 19.079l24.913 127.066c1.697 8.648 10.43 14.113 19.079 12.416l43.12-8.46c8.648-1.697 14.113-10.43 12.416-19.079l-24.913-127.065z"/>
                        <path fill="#3F3D56" d="M359.1 115.422c-8.648 1.697-14.113 10.43-12.416 19.079l24.913 127.065c1.697 8.649 10.43 14.114 19.079 12.417l43.12-8.46c8.648-1.697 14.113-10.43 12.416-19.079l-24.913-127.066c-1.697-8.648-10.43-14.113-19.079-12.416l-43.12 8.46z"/>
                        <path fill="#FFF" d="M363.532 133.365l1.697 8.649 43.12-8.46-1.697-8.648z"/>
                        <path fill="#FFF" d="M367.749 154.79l1.697 8.649 43.12-8.46-1.697-8.648z"/>
                        <path fill="#FFF" d="M371.966 176.216l1.697 8.649 43.12-8.46-1.697-8.648z"/>
                        <path fill="#FFF" d="M376.183 197.642l1.697 8.649 43.12-8.46-1.697-8.648z"/>
                        <path fill="#FFF" d="M380.4 219.068l1.697 8.649 43.12-8.46-1.697-8.648z"/>
                        <path fill="#FFF" d="M384.617 240.494l1.697 8.649 43.12-8.46-1.697-8.648z"/>
                        <path fill="#4CAF50" d="M250 326.875c-41.421 0-75-33.579-75-75s33.579-75 75-75 75 33.579 75 75-33.579 75-75 75z" opacity=".2"/>
                        <path fill="#3F3D56" d="M250 326.875c-41.421 0-75-33.579-75-75s33.579-75 75-75 75 33.579 75 75-33.579 75-75 75zm0-140c-35.841 0-65 29.159-65 65s29.159 65 65 65 65-29.159 65-65-29.159-65-65-65z"/>
                        <path fill="#3F3D56" d="M250 266.875c-8.284 0-15-6.716-15-15s6.716-15 15-15 15 6.716 15 15-6.716 15-15 15z"/>
                    </g>
                </svg>
            </div>
            
            <!-- Error Message -->
            <h1 class="text-6xl font-bold text-gray-800 mb-2">404</h1>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Halaman Tidak Ditemukan</h2>
            <p class="text-gray-600 mb-8">
                Maaf, halaman yang Anda cari tidak dapat ditemukan atau telah dipindahkan.
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
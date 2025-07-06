<header id="mainHeader" class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
    <div class="container mx-auto px-4">
        <nav class="flex items-center justify-between h-20">
            <!-- Logo -->
            <a href="{{ route('home') }}"class="flex items-center space-x-2 group">
                <div class="relative overflow-hidden rounded-full bg-white/10 p-2 backdrop-blur-sm transition-all duration-300 group-hover:bg-white/20">
                    <svg width="32" height="32" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="fill-white transition-transform duration-500 group-hover:rotate-12">
                        <path d="M50 0C22.3858 0 0 22.3858 0 50C0 77.6142 22.3858 100 50 100C77.6142 100 100 77.6142 100 50C100 36.8165 94.7313 24.7805 86.0112 16.0579C74.5537 25.3251 60.0937 30.5187 44.0448 29.193C48.3993 20.4183 50.0013 10.3037 50 0Z"/>
                    </svg>
                </div>
                <span class="text-yellow-300 font-semibold text-lg hidden sm:inline tracking-wide">PlantCare</span>
            </a>

            <div class="hidden md:flex items-center space-x-4">
                @php
                    $menus = [
                    'home'        => ['icon' => 'fas fa-home',   'label' => 'Home'],
                    'galery'      => ['icon' => 'fas fa-images', 'label' => 'Galeri'],
                    'rekomendasi' => ['icon' => 'fas fa-leaf',   'label' => 'Rekomendasi'],
                    ];
                @endphp

                @foreach($menus as $route => $data)
                    @php $isActive = request()->routeIs($route); @endphp

                    <a
                    href="{{ route($route) }}"
                    class="
                        relative px-4 py-2
                        text-yellow-300 hover:text-yellow-400
                        transition-colors duration-300

                        {{-- Pseudo-element underline default hidden --}}
                        after:content-[''] after:absolute after:left-0 after:bottom-0
                        after:w-full after:h-0.5 after:bg-yellow-300
                        after:origin-left after:scale-x-0
                        after:transition-transform after:duration-300

                        {{-- Jika aktif, munculkan underline & ubah teks --}}
                        {{ $isActive ? 'text-white after:scale-x-100' : '' }}
                    "
                    >
                    <i class="{{ $data['icon'] }} mr-2"></i>
                    {{ $data['label'] }}
                    </a>
                @endforeach
                </div>


            <!-- User Menu -->
            <div class="flex items-center">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-yellow-300 hover:text-yellow-400 transition-colors px-3 py-1 rounded-full hover:bg-white/10 backdrop-blur-sm">
                            <span class="mr-2 hidden sm:inline">{{ Auth::user()->name }}</span>
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <i class="fas fa-chevron-down ml-2 text-xs transition-transform duration-300" :class="{'rotate-180': open}"></i>
                        </button>
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             @click.away="open = false"
                             class="absolute right-0 mt-3 w-56 bg-white/90 backdrop-blur-md rounded-xl shadow-xl py-2 z-10 border border-gray-100">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm text-gray-500">Signed in as</p>
                                <p class="text-sm font-medium text-gray-800 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user-edit mr-3 text-gray-400"></i> Edit Profile
                            </a>
                            <a href="{{ route('rekomendasi.history') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-history mr-3 text-gray-400"></i> History
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <i class="fas fa-sign-out-alt mr-3 text-red-400"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-green-200 transition-colors px-4 py-2 rounded-full hover:bg-white/10 backdrop-blur-sm">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        <span class="hidden sm:inline">Login</span>
                    </a>
                @endauth

                <!-- Mobile menu button -->
                <button id="mobileMenuBtn" class="ml-4 md:hidden text-white hover:text-green-200 focus:outline-none p-2 rounded-full hover:bg-white/10 backdrop-blur-sm">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </nav>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden md:hidden bg-black/80 backdrop-blur-md">
        <div class="px-4 pt-4 pb-6 space-y-3">
            <a href="{{ route('home') }}" class="flex items-center px-4 py-3 rounded-xl text-white hover:bg-white/10 {{ request()->routeIs('home') ? 'bg-white/20' : '' }}">
                <i class="fas fa-home mr-3 w-6 text-center"></i> Home
            </a>
            <a href="{{ route('galery') }}" class="flex items-center px-4 py-3 rounded-xl text-white hover:bg-white/10 {{ request()->routeIs('galery') ? 'bg-white/20' : '' }}">
                <i class="fas fa-images mr-3 w-6 text-center"></i> Galeri
            </a>
            <a href="{{ route('rekomendasi') }}" class="flex items-center px-4 py-3 rounded-xl text-white hover:bg-white/10 {{ request()->routeIs('rekomendasi') ? 'bg-white/20' : '' }}">
                <i class="fas fa-leaf mr-3 w-6 text-center"></i> Rekomendasi
            </a>
        </div>
    </div>
</header>

<!-- Add padding to body to account for fixed navbar -->
{{-- <div class="pt-20"></div> --}}

<script>
    // Toggle mobile menu
    document.getElementById('mobileMenuBtn').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('hidden');

        // Change icon based on menu state
        const icon = this.querySelector('i');
        if (mobileMenu.classList.contains('hidden')) {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        } else {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        }
    });

    // Change navbar background on scroll
    window.addEventListener('scroll', function() {
        const header = document.getElementById('mainHeader');
        if (window.scrollY > 50) {
            header.classList.add('bg-transparent','backdrop-blur-md', 'shadow-md');
        } else {
            header.classList.remove('bg-transparent','backdrop-blur-md', 'shadow-md');
        }
    });

    // Trigger scroll event on page load to set initial state
    window.dispatchEvent(new Event('scroll'));
</script>

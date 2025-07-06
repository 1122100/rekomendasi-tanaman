{{-- resources/views/auth/login.blade.php --}}
<x-guest-layout>
    <div class="min-h-screen flex">
        {{-- Left: Form --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center bg-white">
            <div class="max-w-sm w-full space-y-6 p-8">
                <h1 class="text-3xl font-bold text-gray-800">Selamat Datang</h1>
                <p class="text-gray-500">
                    Login untuk memulai pilihan tanaman anda.
                </p>

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input
                            id="email"
                            class="block mt-1 w-full"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            placeholder="abc123@gmail.com"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    {{-- Password --}}
                    <div>
                        <div class="flex items-center justify-between">
                            <x-input-label for="password" :value="__('Password')" />
                            @if (Route::has('password.request'))
                                <a class="text-sm text-gray-600 hover:underline" href="{{ route('password.request') }}">
                                    {{ __('Forgot password?') }}
                                </a>
                            @endif
                        </div>
                        <x-text-input
                            id="password"
                            class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Masukkan Password Anda"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    {{-- Submit --}}
                    <div>
                        <x-primary-button class="w-full">
                            {{ __('Sign in') }}
                        </x-primary-button>
                    </div>
                </form>

                {{-- Register Link --}}
                <p class="text-center text-sm text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-blue-600 hover:underline">
                        Register
                    </a>
                </p>
                {{-- Or separator --}}
                <div class="flex items-center my-4">
                    <hr class="flex-grow border-gray-300">
                    <span class="mx-2 text-gray-400">or</span>
                    <hr class="flex-grow border-gray-300">
                </div>

                {{-- Social Login --}}
                <div class="space-y-2">
                    <a href="#" class="w-full flex items-center justify-center border border-gray-200 rounded-md py-2 hover:bg-gray-50 transition">
                        <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google" class="h-5 w-5 mr-2">
                        Sign in with Google
                    </a>
                </div>
            </div>
        </div>

        {{-- Right: Illustration --}}
        <div class="hidden lg:block lg:w-1/2">
            <div
                class="h-full bg-cover bg-center "
                style="background-image: url('{{ Vite::asset('resources/img/uilogin.webp') }}');">
            </div>
        </div>
    </div>
</x-guest-layout>

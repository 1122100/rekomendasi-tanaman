{{-- resources/views/auth/register.blade.php --}}
<x-guest-layout>
    <div class="min-h-screen flex">
        {{-- Left: Illustration --}}
        <div class="hidden lg:block lg:w-1/2">
            <div
                class="h-full bg-cover bg-center "
                style="background-image: url('{{ Vite::asset('resources/img/uiregister2.webp') }}');"
            ></div>
        </div>

        {{-- Right: Form --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center bg-white">
            <div class="max-w-sm w-full space-y-6 p-8">
                <h1 class="text-3xl font-bold text-gray-800">Silahkan Daftarkan Akun Kamu</h1>
                <p class="text-gray-500">
                    Bergabunglah bersama kami untuk membantu anda mencari tanaman yang cocok dengan lingkungan anda<br>
                    Cepat dan mudah untuk memulai!
                </p>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input
                            id="name"
                            class="block mt-1 w-full"
                            type="text"
                            name="name"
                            :value="old('name')"
                            required
                            autofocus
                            placeholder="Nama Lengkap Anda"
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

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
                            placeholder="you@example.com"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    {{-- Password --}}
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input
                            id="password"
                            class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="••••••••"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input
                            id="password_confirmation"
                            class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation"
                            required
                            placeholder="••••••••"
                        />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>

                    {{-- Submit --}}
                    <div>
                        <x-primary-button class="w-full">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>

                {{-- Link to Login --}}
                <p class="text-center text-sm text-gray-600">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">
                        Sign in
                    </a>
                </p>

                {{-- Or separator --}}
                <div class="flex items-center my-4">
                    <hr class="flex-grow border-gray-300">
                    <span class="mx-2 text-gray-400">or</span>
                    <hr class="flex-grow border-gray-300">
                </div>

                {{-- Social Register/Login --}}
                <div class="space-y-2">
                    <a href="#" class="w-full flex items-center justify-center border border-gray-200 rounded-md py-2 hover:bg-gray-50 transition">
                        <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google" class="h-5 w-5 mr-2">
                        Register with Google
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

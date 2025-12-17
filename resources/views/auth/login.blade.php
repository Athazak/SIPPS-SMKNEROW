<x-guest-layout>

    {{-- STATUS --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        {{-- USERNAME --}}
        <div>
            <x-input-label for="username" value="Username" />
            <x-text-input id="username" type="text" name="username" :value="old('username')" required autofocus
                placeholder="Masukkan username" class="mt-1 w-full rounded-xl" />
            <x-input-error :messages="$errors->get('username')" class="mt-1" />
        </div>

        {{-- PASSWORD --}}
        <div class="relative">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" type="password" name="password" required placeholder="Masukkan password"
                class="mt-1 w-full rounded-xl pr-10" />

            {{-- TOGGLE PASSWORD --}}
            <button type="button" id="togglePassword" class="absolute right-3 top-9 text-gray-400 hover:text-gray-600">
                <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7
                          -1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>

                <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18M10.585 10.585A2 2 0 0012 14
                          a2 2 0 001.415-3.415M9.88 9.88
                          A3 3 0 0114.12 14.12" />
                </svg>
            </button>

            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        {{-- REMEMBER --}}
        <div class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600">
            <span class="text-gray-600">Ingat saya</span>
        </div>

        {{-- BUTTON --}}
        <button type="submit" class="w-full mt-4 py-3 rounded-xl
                       bg-gradient-to-r from-[#2A166F] to-[#0092DF]
                       text-white font-semibold
                       hover:opacity-90 transition">
            Login
        </button>
    </form>

    {{-- SCRIPT TOGGLE PASSWORD --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const pwd = document.getElementById('password');
            const btn = document.getElementById('togglePassword');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClosed = document.getElementById('eyeClosed');

            btn.addEventListener('click', () => {
                const show = pwd.type === 'password';
                pwd.type = show ? 'text' : 'password';
                eyeOpen.classList.toggle('hidden', !show);
                eyeClosed.classList.toggle('hidden', show);
            });
        });
    </script>

</x-guest-layout>
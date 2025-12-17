<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w-7xl mx-auto px-3 lg:px-4">

            {{-- ===== HEADER PROFIL ===== --}}
            <div class="rounded-2xl shadow px-4 py-4 mb-3 flex items-center bg-white text-white">
                <div class="flex flex-col">
                    <h1 class="text-2xl font-bold text-[#2A166F]">
                        Kelola Profil & Keamanan
                    </h1>
                    <p class="text-gray-600 mt-1 text-sm">
                        Perbarui informasi akun dan jaga keamanan kata sandi Anda
                    </p>
                </div>
            </div>

            {{-- ===== UPDATE USERNAME ===== --}}
            <div class="bg-white shadow rounded-2xl p-5 mb-3">
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- ===== UPDATE PASSWORD ===== --}}
            <div class="bg-white shadow rounded-2xl p-5 mb-3">
                @include('profile.partials.update-password-form')
            </div>

        </div>
    </div>
</x-app-layout>
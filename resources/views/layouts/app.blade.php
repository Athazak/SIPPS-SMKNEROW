<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIPPS - SMKNEROW') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .translate-x-0 {
            transform: translateX(0);
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100">

    {{-- ALPINE STATE --}}
    <div x-data="{ sidebarOpen: false }" class="min-h-screen">

        {{-- MOBILE OVERLAY --}}
        <div class="fixed inset-0 bg-black/40 z-20 lg:hidden" x-show="sidebarOpen" @click="sidebarOpen = false"
            x-transition.opacity>
        </div>

        {{-- SIDEBAR --}}
        <aside id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-white shadow-md z-30 transform 
                -translate-x-64 lg:translate-x-0 transition-transform duration-300"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'">

            @include('layouts.sidebar')

        </aside>

        {{-- MAIN CONTENT --}}
        <div class="lg:ml-64 flex flex-col min-h-screen transition-all">

            {{-- TOPBAR --}}
            <header class="relative bg-white shadow px-6 py-4 flex items-center justify-between sticky top-0 z-20">

                {{-- MOBILE TOGGLE BUTTON --}}
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                {{-- PAGE TITLE --}}
                @isset($header)
                    <div class="text-xl font-semibold text-gray-800 absolute left-1/2 -translate-x-1/2 text-center
                                                        sm:static sm:translate-x-0 sm:text-left">
                        {{ $header }}
                    </div>
                @endisset

                <a href="{{ route('profile.edit') }}" class="p-1 rounded-md text-gray-700 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M4 21C4 17.4735 6.60771 14.5561 10 14.0709M19.8726 15.2038C19.8044 15.2079 19.7357 15.21 19.6667 15.21C18.6422 15.21 17.7077 14.7524 17 14C16.2923 14.7524 15.3578 15.2099 14.3333 15.2099C14.2643 15.2099 14.1956 15.2078 14.1274 15.2037C14.0442 15.5853 14 15.9855 14 16.3979C14 18.6121 15.2748 20.4725 17 21C18.7252 20.4725 20 18.6121 20 16.3979C20 15.9855 19.9558 15.5853 19.8726 15.2038ZM15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z"
                            stroke="#575757ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </header>

            {{-- ALERT --}}
            <div class="px-6 mt-3">
                @if (session('success'))
                    <x-alert type="success">{{ session('success') }}</x-alert>
                @endif
                @if (session('error'))
                    <x-alert type="error">{{ session('error') }}</x-alert>
                @endif
            </div>

            {{-- PAGE CONTENT --}}
            <main>
                {{ $slot }}
            </main>

            {{-- FOOTER --}}
            <footer class="mt-auto bg-gray-200 w-full border-t py-4">
                <div class="max-w-7xl mx-auto px-4 text-center text-sm text-gray-500">
                    <p>Sistem Informasi Pelanggaran & Penghargaan Siswa</p>
                    <p class="mt-1">Dibangun oleh Tim Magang - Polinema PSDKU Lumajang</p>
                    <p class="mt-1">&copy; {{ date('Y') }}. All Rights Reserved.</p>
                </div>
            </footer>

        </div>

    </div>

</body>

</html>
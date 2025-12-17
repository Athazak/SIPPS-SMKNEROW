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
</head>

<body class="font-sans antialiased">

    {{-- BACKGROUND --}}
    <div class="min-h-screen flex items-center justify-center
                bg-gradient-to-br from-[#2A166F]/10 to-[#0092DF]/10 px-4">

        {{-- CARD --}}
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-6">

            {{-- LOGO & TITLE --}}
            <div class="text-center mb-6">
                <div class="flex justify-center mb-3">
                    <x-logo-login class="w-14 h-14" />
                </div>
            </div>

            {{-- SLOT CONTENT --}}
            {{ $slot }}

            {{-- FOOTER --}}
            <p class="text-xs text-center text-gray-400 mt-6">
                © {{ date('Y') }} SIPPS SMK Negeri Rowokangkung
            </p>
        </div>
    </div>

</body>

</html>
{{-- SIDEBAR CONTENT ONLY (tanpa class posisi/translate) --}}
<div class="bg-white w-64 h-full flex flex-col">

    {{-- LOGO --}}
    <div class="flex items-center gap-2 py-3 border-b">
        <a href="{{ dashboard_route() }}" class="flex items-center gap-2">
            <x-application-logo />
        </a>
    </div>

    {{-- SCROLL AREA --}}
    <div class="flex-1 overflow-y-auto px-4 py-4">

        <nav class="space-y-1">

            {{-- Dashboard --}}
            <a href="{{ dashboard_route() }}" class="block px-4 py-2.5 rounded hover:bg-gray-100
                {{ request()->url() == dashboard_route() ? 'bg-gray-200 font-semibold' : '' }}">
                Dashboard
            </a>

            {{-- ADMIN --}}
            @if(Auth::user()->role === 'admin')

                <a href="{{ route('admin.guru.index') }}"
                    class="block px-4 py-2.5 rounded hover:bg-gray-100
                                                {{ request()->routeIs('admin.guru.*') ? 'bg-gray-200 font-semibold' : '' }}">
                    Guru
                </a>
                
                <a href="{{ route('admin.rombel.index') }}"
                    class="block px-4 py-2.5 rounded hover:bg-gray-100
                                                {{ request()->routeIs('admin.rombel.*') ? 'bg-gray-200 font-semibold' : '' }}">
                    Kelas
                </a>

                <a href="{{ route('admin.siswa.index') }}"
                    class="block px-4 py-2.5 rounded hover:bg-gray-100
                                                {{ request()->routeIs('admin.siswa.*') ? 'bg-gray-200 font-semibold' : '' }}">
                    Siswa
                </a>

                <a href="{{ route('admin.pelanggaran.index') }}"
                    class="block px-4 py-2.5 rounded hover:bg-gray-100
                                                {{ request()->routeIs('admin.pelanggaran.*') ? 'bg-gray-200 font-semibold' : '' }}">
                    Pelanggaran
                </a>

                <a href="{{ route('admin.penghargaan.index') }}"
                    class="block px-4 py-2.5 rounded hover:bg-gray-100
                                                {{ request()->routeIs('admin.penghargaan.*') ? 'bg-gray-200 font-semibold' : '' }}">
                    Penghargaan
                </a>

                <a href="{{ route('admin.penanganan.index') }}"
                    class="block px-4 py-2.5 rounded hover:bg-gray-100
                                                {{ request()->routeIs('admin.penanganan.*') ? 'bg-gray-200 font-semibold' : '' }}">
                    Penanganan Pelanggaran
                </a>

                <a href="{{ route('admin.laporan.index') }}"
                    class="block px-4 py-2.5 rounded hover:bg-gray-100
                                                {{ request()->routeIs('admin.laporan.*') ? 'bg-gray-200 font-semibold' : '' }}">
                    Laporan
                </a>

            @endif

            {{-- GURU --}}
            @if(Auth::user()->role === 'guru')
                <a href="{{ route('guru.kelas.index') }}"
                    class="block px-4 py-2.5 rounded hover:bg-gray-100
                                                {{ request()->routeIs('guru.kelas.*') ? 'bg-gray-200 font-semibold' : '' }}">
                    Kelas
                </a>

                <a href="{{ route('guru.pelanggaran.index') }}"
                    class="block px-4 py-2.5 rounded hover:bg-gray-100
                                                {{ request()->routeIs('guru.pelanggaran.*') ? 'bg-gray-200 font-semibold' : '' }}">
                    Input Pelanggaran
                </a>

                <a href="{{ route('guru.penghargaan.index') }}"
                    class="block px-4 py-2.5 rounded hover:bg-gray-100
                                                {{ request()->routeIs('guru.penghargaan.*') ? 'bg-gray-200 font-semibold' : '' }}">
                    Input Penghargaan
                </a>
            @endif

            {{-- SISWA --}}
            @if(Auth::user()->role === 'siswa')
                <a href="{{ route('siswa.riwayat.index') }}"
                    class="block px-4 py-2.5 rounded hover:bg-gray-100
                                                {{ request()->routeIs('siswa.riwayat.*') ? 'bg-gray-200 font-semibold' : '' }}">
                    Riwayat Saya
                </a>
            @endif

            {{-- ORANG TUA --}}
            @if(Auth::user()->role === 'ortu')
                <a href="{{ route('ortu.riwayat') }}"
                    class="block px-4 py-2.5 rounded hover:bg-gray-100
                                                {{ request()->routeIs('ortu.riwayat') ? 'bg-gray-200 font-semibold' : '' }}">
                    Riwayat Anak
                </a>
            @endif

        </nav>
    </div>

    {{-- FOOTER --}}
    <div class="px-4 py-4 border-t bg-white">
        {{-- USER INFO CARD --}}
        <div class="flex items-center gap-3 bg-gray-100 p-2 rounded-lg mb-3">

            {{-- ICON USER --}}
            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14c-4.418 0-8 2.015-8 4.5V20h16v-1.5c0-2.485-3.582-4.5-8-4.5z" />
                </svg>
            </div>

            {{-- TEXT --}}
            <div class="flex flex-col">
                <span class="font-semibold text-gray-800 leading-tight">
                    {{ ucwords(strtolower(Auth::user()->nama)) }}
                </span>
                <div>
                    <span class="text-sm text-gray-500 -mt-0.5">
                        {{ Auth::user()->username }}
                    </span>

                    <span class="w-fit mt-1 px-2 py-0.5 text-xs rounded bg-blue-100 text-blue-700 font-medium">
                        {{ ucfirst(Auth::user()->role) }}
                    </span>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600">
                Logout
            </button>
        </form>
    </div>

</div>
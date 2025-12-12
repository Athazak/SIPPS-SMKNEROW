<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan') }}
        </h2>
    </x-slot>

    <div class="py-1 max-w-7xl mx-auto px-3 lg:px-4" x-data="{ tab: '{{ request()->get('tab', 'pelanggaran') }}' }">

        {{-- ====================== SUBHEADER ====================== --}}
        <div class="rounded-2xl shadow px-4 py-4 mb-3 flex items-center bg-white text-white">
            <div class="flex flex-col">
                <h1 class="text-2xl font-bold text-[#2A166F]">Laporan</h1>
                <p class="text-gray-600 mt-1 text-sm">
                    Halaman ini berisi laporan pelanggaran, penghargaan, dan rekap skor siswa.
                </p>
            </div>
        </div>

        {{-- ====================== NAVIGASI TAB DI DALAM CARD ====================== --}}
        <div class="bg-white shadow rounded-2xl px-3 py-2 mb-3">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">

                {{-- Tab Pelanggaran --}}
                <button @click="tab = 'pelanggaran'" :class="tab === 'pelanggaran'
                ? 'bg-[#512AD5] text-white shadow-md'
                : 'bg-gray-100 text-gray-700 border border-gray-300 hover:bg-gray-200'"
                    class="w-full px-3 py-2.5 rounded-xl font-semibold text-sm transition text-center">
                    Pelanggaran
                </button>

                {{-- Tab Penghargaan --}}
                <button @click="tab = 'penghargaan'" :class="tab === 'penghargaan'
                ? 'bg-[#512AD5] text-white shadow-md'
                : 'bg-gray-100 text-gray-700 border border-gray-300 hover:bg-gray-200'"
                    class="w-full px-3 py-2.5 rounded-xl font-semibold text-sm transition text-center">
                    Penghargaan
                </button>

                {{-- Tab Rekap Skor --}}
                <button @click="tab = 'rekap'" :class="tab === 'rekap'
                ? 'bg-[#512AD5] text-white shadow-md'
                : 'bg-gray-100 text-gray-700 border border-gray-300 hover:bg-gray-200'"
                    class="w-full px-3 py-2.5 rounded-xl font-semibold text-sm transition text-center">
                    Rekap Skor
                </button>

            </div>
        </div>

        {{-- ===================== TAB CONTENT ===================== --}}
        <div x-show="tab === 'pelanggaran'" x-transition>
            @include('admin.laporan.partials.pelanggaran')
        </div>

        <div x-show="tab === 'penghargaan'" x-transition>
            @include('admin.laporan.partials.penghargaan')
        </div>

        <div x-show="tab === 'rekap'" x-transition>
            @include('admin.laporan.partials.rekap')
        </div>

    </div>
</x-app-layout>
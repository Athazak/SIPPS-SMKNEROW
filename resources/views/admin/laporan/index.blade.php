<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Siswa') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 lg:px-5" x-data="{ tab: '{{ request()->get('tab', 'pelanggaran') }}' }">

            {{-- Navigasi Tab --}}
            <div class="flex justify-center items gap-4 mb-6">
                <button @click="tab = 'pelanggaran'"
                    :class="tab === 'pelanggaran' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-300'"
                    class="px-2 py-2 rounded-lg font-semibold transition">Pelanggaran</button>

                <button @click="tab = 'penghargaan'"
                    :class="tab === 'penghargaan' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-300'"
                    class="px-2 py-2 rounded-lg font-semibold transition">Penghargaan</button>

                <button @click="tab = 'rekap'"
                    :class="tab === 'rekap' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-300'"
                    class="px-2 py-2 rounded-lg font-semibold transition">Rekap Skor</button>
            </div>

            {{-- ===================== TAB 1: LAPORAN PELANGGARAN ===================== --}}
            <div x-show="tab === 'pelanggaran'" x-transition>
                @include('admin.laporan.partials.pelanggaran')
            </div>

            {{-- ===================== TAB 2: LAPORAN PENGHARGAAN ===================== --}}
            <div x-show="tab === 'penghargaan'" x-transition>
                @include('admin.laporan.partials.penghargaan')
            </div>

            {{-- ===================== TAB 3: REKAP SKOR ===================== --}}
            <div x-show="tab === 'rekap'" x-transition>
                @include('admin.laporan.partials.rekap')
            </div>
        </>
    </div>
</x-app-layout>
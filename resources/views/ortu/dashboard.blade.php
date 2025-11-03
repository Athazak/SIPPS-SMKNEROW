<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard Orang Tua
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            {{-- ====== INFORMASI ANAK & LEVEL ====== --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                            {{ $siswa->user->nama }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Rombel: {{ $siswa->rombel->nama_rombel ?? '-' }}
                        </p>
                        <p class="text-gray-600 dark:text-gray-400">
                            Jenis Kelamin: {{ $siswa->jenis_kelamin }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500 mb-1">Kategori</p>
                        <span class="px-3 py-1 rounded-lg font-semibold
                            @if($penanganan?->kategori === 'berat') bg-red-600 text-white
                            @elseif($penanganan?->kategori === 'sedang') bg-yellow-500 text-white
                            @else bg-green-500 text-white @endif">
                            {{ $penanganan->kategori ?? 'Aman' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- ====== KARTU STATISTIK ====== --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6">
                    {{-- Total Pelanggaran --}}
                    <div class="p-6 bg-red-500 dark:bg-red-700 text-white shadow rounded-xl hover:scale-105 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm opacity-80">Total Pelanggaran</p>
                                <p class="text-3xl font-bold">{{ $totalPelanggaran }}</p>
                            </div>
                            <x-heroicon-o-exclamation-triangle class="w-10 h-10 opacity-70" />
                        </div>
                    </div>

                    {{-- Total Penghargaan --}}
                    <div
                        class="p-6 bg-yellow-500 dark:bg-yellow-600 text-white shadow rounded-xl hover:scale-105 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm opacity-80">Total Penghargaan</p>
                                <p class="text-3xl font-bold">{{ $totalPenghargaan }}</p>
                            </div>
                            <x-heroicon-o-star class="w-10 h-10 opacity-70" />
                        </div>
                    </div>

                    {{-- Skor Akhir --}}
                    <div
                        class="p-6 bg-blue-500 dark:bg-blue-700 text-white shadow rounded-xl hover:scale-105 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm opacity-80">Skor Akhir</p>
                                <p class="text-3xl font-bold">{{ $skorAkhir }}</p>
                            </div>
                            <x-heroicon-o-scale class="w-10 h-10 opacity-70" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- ====== RIWAYAT TERBARU ====== --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">
                    Riwayat Terbaru Anak
                </h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                        <thead class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Tanggal</th>
                                <th class="px-4 py-2 border">Tipe</th>
                                <th class="px-4 py-2 border">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $riwayat = collect($pelanggaranTerbaru)
                                    ->map(fn($p) => [
                                        'tanggal' => \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y'),
                                        'tipe' => 'pelanggaran',
                                        'pesan' => $p->pelanggaran->bentuk ?? '-'
                                    ])
                                    ->merge(
                                        collect($penghargaanTerbaru)
                                            ->map(fn($h) => [
                                                'tanggal' => \Carbon\Carbon::parse($h->tanggal)->format('d/m/Y'),
                                                'tipe' => 'penghargaan',
                                                'pesan' => $h->penghargaan->bentuk ?? '-'
                                            ])
                                    )
                                    ->sortByDesc('tanggal')
                                    ->take(5)
                                    ->values();
                            @endphp

                            @forelse ($riwayat as $index => $item)
                                <tr class="border-b border-gray-300 dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $item['tanggal'] }}</td>
                                    <td class="px-4 py-2 capitalize font-semibold
                                            {{ $item['tipe'] === 'pelanggaran' ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $item['tipe'] }}
                                    </td>
                                    <td class="px-4 py-2">{{ $item['pesan'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-gray-500">
                                        Belum ada riwayat terbaru.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
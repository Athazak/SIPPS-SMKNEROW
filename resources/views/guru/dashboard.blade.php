<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard Guru
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 lg:px-5">
            <div class="bg-white dark:bg-gray-800 shadow rounded-2xl p-6 mb-6">
                <h3 class="text-lg font-semibold flex items-center gap-2 text-gray-700 dark:text-gray-200">
                    Selamat datang, {{ auth()->user()->nama }}
                </h3>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow mb-6">
                <!-- Kartu Statistik -->
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6">
                    <!-- Total Pelanggaran -->
                    <div class="p-6 bg-red-500 dark:bg-red-700 text-white shadow rounded-xl hover:scale-105 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm opacity-80">Total Pelanggaran Dicatat</p>
                                <p class="text-3xl font-bold">{{ $totalPelanggaran }}</p>
                            </div>
                            <x-heroicon-o-exclamation-triangle class="w-10 h-10 opacity-70" />
                        </div>
                    </div>

                    <!-- Total Penghargaan -->
                    <div
                        class="p-6 bg-yellow-500 dark:bg-yellow-600 text-white shadow rounded-xl hover:scale-105 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm opacity-80">Total Penghargaan Dicatat</p>
                                <p class="text-3xl font-bold">{{ $totalPenghargaan }}</p>
                            </div>
                            <x-heroicon-o-star class="w-10 h-10 opacity-70" />
                        </div>
                    </div>

                    <!-- Total Skor Akhir -->
                    <div
                        class="p-6 bg-blue-500 dark:bg-blue-700 text-white shadow rounded-xl hover:scale-105 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm opacity-80">Total Skor Akhir</p>
                                <p class="text-3xl font-bold">{{ $totalSkor }}</p>
                            </div>
                            <x-heroicon-o-scale class="w-10 h-10 opacity-70" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rekap Siswa -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">
                    Rekap Siswa yang Pernah Dicatat
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                        <thead class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Nama Siswa</th>
                                <th class="px-4 py-2 border">Rombel</th>
                                <th class="px-4 py-2 border text-center">Pelanggaran</th>
                                <th class="px-4 py-2 border text-center">Penghargaan</th>
                                <th class="px-4 py-2 border text-center">Skor Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataSiswa as $index => $item)
                                <tr class="border-b border-gray-300 dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $item['nama'] }}</td>
                                    <td class="px-4 py-2">{{ $item['rombel'] }}</td>
                                    <td class="px-4 py-2 text-center text-red-600 font-semibold">
                                        {{ $item['total_pelanggaran'] }}
                                    </td>
                                    <td class="px-4 py-2 text-center text-green-600 font-semibold">
                                        {{ $item['total_penghargaan'] }}
                                    </td>
                                    <td class="px-4 py-2 text-center font-bold">{{ $item['skor_akhir'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">Belum ada data dicatat oleh Anda.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
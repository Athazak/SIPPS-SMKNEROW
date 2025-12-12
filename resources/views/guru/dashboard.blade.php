<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto px-4 lg:px-5">
            <div
                class="rounded-2xl shadow-lg px-6 py-4 mb-4 flex items-center gap-5 bg-gradient-to-r from-[#2A166F] to-[#6133FF] text-white">

                <!-- Text -->
                <div class="flex flex-col">
                    <p class="text-sm opacity-80 tracking-wide">Guru</p>

                    <h2 class="text-2xl font-bold leading-tight">
                        Selamat Datang,
                        <span class="font-extrabold text-[#FFF601]">
                            {{ auth()->user()->nama }}
                        </span>
                    </h2>
                </div>
            </div>

            <!-- Kartu Statistik -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-4">
                <!-- Pelanggaran -->
                <div class="px-3 py-3 bg-[#DB261D] text-white rounded-xl shadow
                flex items-center gap-3
                hover:scale-[1.04] hover:-translate-y-1 hover:shadow-lg 
                transition-all duration-200">
                    <div class="p-2 bg-white/20 rounded-lg">
                        <x-heroicon-o-exclamation-triangle class="w-6 h-6" />
                    </div>
                    <div>
                        <p class="text-xs opacity-80">Total Pelanggaran Dicatat</p>
                        <p class="text-lg font-bold">{{ $totalPelanggaran }}</p>
                    </div>
                </div>

                <!-- Penghargaan -->
                <div class="px-3 py-3 bg-[#FFF601] text-black rounded-xl shadow 
                flex items-center gap-3
                hover:scale-[1.04] hover:-translate-y-1 hover:shadow-lg 
                transition-all duration-200">
                    <div class="p-2 bg-[#2A166F]/20 rounded-lg">
                        <x-heroicon-o-star class="w-6 h-6 text-black" />
                    </div>
                    <div>
                        <p class="text-xs text-black/70">Total Penghargaan Dicatat</p>
                        <p class="text-lg font-bold">{{ $totalPenghargaan }}</p>
                    </div>
                </div>
                
                <!-- Siswa -->
                <div class="px-3 py-3 bg-[#0092DF] text-white rounded-xl shadow 
                flex items-center gap-3
                hover:scale-[1.04] hover:-translate-y-1 hover:shadow-lg 
                transition-all duration-200">
                    <div class="p-2 bg-white/20 rounded-lg">
                        <x-heroicon-o-scale class="w-6 h-6" />
                    </div>
                    <div>
                        <p class="text-xs opacity-80">Total Skor Akhir</p>
                        <p class="text-lg font-bold">{{ $totalSkor }}</p>
                    </div>
                </div>
            </div>

            <!-- Rekap Siswa -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">
                    Daftar Siswa yang Pernah Dicatat
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
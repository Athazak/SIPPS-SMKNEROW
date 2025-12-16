<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w-7xl mx-auto px-3 lg:px-4">

            <!-- Header Welcome -->
            <div
                class="rounded-2xl shadow-lg px-4 py-4 mb-3 flex items-center bg-gradient-to-r from-[#2A166F] to-[#0092DF] text-white">
                <div class="flex flex-col">
                    <p class="text-sm opacity-80 tracking-wide">Guru</p>
                    <h2 class="text-2xl font-bold leading-tight">
                        Selamat Datang,
                        <span class="font-extrabold text-[#FFF601]">
                            {{ ucwords(strtolower(auth()->user()->nama)) }}
                        </span>
                    </h2>
                </div>
            </div>

            <!-- Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
                <!-- Siswa -->
                <div class="px-3 py-3 bg-[#0092DF] text-white rounded-xl shadow
                            flex items-center gap-3 hover:scale-[1.04]
                            hover:-translate-y-1 hover:shadow-lg transition-all">
                    <div class="p-2 bg-white/20 rounded-lg">
                        <x-heroicon-o-academic-cap class="w-6 h-6" />
                    </div>
                    <div>
                        <p class="text-xs opacity-80">Jumlah Siswa Dicatat</p>
                        <p class="text-lg font-bold">{{ $totalSiswaDicatat }}</p>
                    </div>
                </div>

                <!-- Pelanggaran -->
                <div class="px-3 py-3 bg-[#DB261D] text-white rounded-xl shadow
                            flex items-center gap-3 hover:scale-[1.04]
                            hover:-translate-y-1 hover:shadow-lg transition-all">
                    <div class="p-2 bg-white/20 rounded-lg">
                        <x-heroicon-o-exclamation-triangle class="w-6 h-6" />
                    </div>
                    <div>
                        <p class="text-xs opacity-80">Jumlah Pelanggaran Dicatat</p>
                        <p class="text-lg font-bold">{{ $totalPelanggaran }}</p>
                    </div>
                </div>

                <!-- Penghargaan -->
                <div class="px-3 py-3 bg-[#FFF601] text-black rounded-xl shadow
                            flex items-center gap-3 hover:scale-[1.04]
                            hover:-translate-y-1 hover:shadow-lg transition-all">
                    <div class="p-2 bg-black/20 rounded-lg">
                        <x-heroicon-o-star class="w-6 h-6 text-black" />
                    </div>
                    <div>
                        <p class="text-xs text-black/70">Jumlah Penghargaan Dicatat</p>
                        <p class="text-lg font-bold">{{ $totalPenghargaan }}</p>
                    </div>
                </div>
            </div>

            <!-- Rekap Siswa -->
            <div class="bg-white shadow rounded-xl px-4 py-3 mb-3 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-600 mb-2">
                    Rekap Siswa Berdasarkan Catatan Guru
                </h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead>
                            <tr class="bg-[#F4F5FF] text-[#2A166F] border-b">
                                <th class="px-4 py-3 font-semibold">No</th>
                                <th class="px-4 py-3 font-semibold">Nama Siswa</th>
                                <th class="px-4 py-3 font-semibold">Rombel</th>
                                <th class="px-4 py-3 font-semibold text-center">
                                    Total Pelanggaran
                                </th>
                                <th class="px-4 py-3 font-semibold text-center">
                                    Total Penghargaan
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataSiswa as $index => $item)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 font-medium">
                                        {{ $item['nama'] }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $item['rombel'] }}
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        <span
                                            class="bg-[#FEE2E2] text-[#B91C1C] px-3 py-1 rounded-full text-xs font-semibold">
                                            {{ $item['total_pelanggaran'] }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        <span
                                            class="bg-[#FFF4D6] text-[#D97706] px-3 py-1 rounded-full text-xs font-semibold">
                                            {{ $item['total_penghargaan'] }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-5 text-center text-gray-500">
                                        Belum ada data siswa yang dicatat oleh Anda.
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
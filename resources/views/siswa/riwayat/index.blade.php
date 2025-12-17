<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Saya') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w-7xl mx-auto px-3 lg:px-4">

            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-3">
                {{-- STATUS SIKAP --}}
                <div class="bg-white rounded-xl shadow px-3 py-3 hover:shadow-md transition">
                    <p class="text-xs text-gray-500 mb-1">Status Penanganan</p>

                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full
                            {{ $statusKategori === 'berat' ? 'bg-red-100 text-red-700' :
    ($statusKategori === 'sedang' ? 'bg-yellow-100 text-yellow-700' :
        ($statusKategori === 'ringan' ? 'bg-blue-100 text-blue-700' :
            'bg-green-100 text-green-700')) }}">
                            {{ strtoupper($statusKategori) }}
                        </span>

                        <x-heroicon-o-shield-check class="w-4 h-4
                            {{ $statusKategori === 'berat' ? 'text-red-600' :
    ($statusKategori === 'sedang' ? 'text-yellow-600' :
        ($statusKategori === 'ringan' ? 'text-blue-600' :
            'text-green-600')) }}" />
                    </div>
                </div>

                <div class="px-3 py-3 bg-white text-[#DB261D] rounded-xl shadow
                            flex items-center gap-3 hover:shadow-md transition">
                    <div class="p-2 bg-[#DB261D]/10 rounded-lg">
                        <x-heroicon-o-exclamation-triangle class="w-6 h-6" />
                    </div>
                    <div>
                        <p class="text-xs opacity-80">Pelanggaran</p>
                        <p class="text-lg font-bold">{{ $totalPelanggaran }}</p>
                    </div>
                </div>

                <div class="px-3 py-3 bg-white text-yellow-600 rounded-xl shadow
                            flex items-center gap-3 hover:shadow-md transition">
                    <div class="p-2 bg-[#FFF601]/20 rounded-lg">
                        <x-heroicon-o-star class="w-6 h-6" />
                    </div>
                    <div>
                        <p class="text-xs opacity-80">Penghargaan</p>
                        <p class="text-lg font-bold">{{ $totalPenghargaan }}</p>
                    </div>
                </div>

                <div class="px-3 py-3 bg-white text-[#0092DF] rounded-xl shadow
                            flex items-center gap-3 hover:shadow-md transition">
                    <div class="p-2 bg-[#0092DF]/10 rounded-lg">
                        <x-heroicon-o-scale class="w-6 h-6" />
                    </div>
                    <div>
                        <p class="text-xs opacity-80">Skor Saat Ini</p>
                        <p class="text-lg font-bold">{{ $skorAkhir }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-xl px-4 py-3 mb-3 border border-gray-100">
                <!-- Header -->
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-lg font-semibold text-gray-600">
                        Riwayat Pelanggaran
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead>
                            <tr class="bg-[#F4F5FF] text-[#2A166F] border-b">
                                <th class="px-4 py-2 font-semibold">No</th>
                                <th class="px-4 py-2 font-semibold">Tanggal</th>
                                <th class="px-4 py-2 font-semibold">Jenis Pelanggaran</th>
                                <th class="px-4 py-2 font-semibold">Bentuk</th>
                                <th class="px-4 py-2 font-semibold text-center">Skor</th>
                                <th class="px-4 py-2 font-semibold">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pelanggarans as $index => $item)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 font-medium">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-4 py-2 font-medium">{{ $item->pelanggaran->jenis_pelanggaran ?? '-' }}
                                    </td>
                                    <td class="px-4 py-2 text-gray-700">
                                        {{ $item->pelanggaran?->bentuk ?? '-' }}
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        <span
                                            class="bg-[#FEE2E2] text-[#B91C1C] px-3 py-1 rounded-full text-xs font-semibold">
                                            {{ $item->pelanggaran->skor ?? 0 }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-gray-700">
                                        {{ $item->pelanggaran->keterangan ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-5 text-center text-gray-500">
                                        Belum ada catatan pelanggaran.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $pelanggarans->appends(request()->query())->links('vendor.pagination.simple-modern') }}
                </div>
            </div>

            <div class="bg-white shadow rounded-xl px-4 py-3 mb-3 border border-gray-100">
                <!-- Header -->
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-lg font-semibold text-gray-600">
                        Riwayat Penghargaan
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead>
                            <tr class="bg-[#F4F5FF] text-[#2A166F] border-b">
                                <th class="px-4 py-2 font-semibold">No</th>
                                <th class="px-4 py-2 font-semibold">Tanggal</th>
                                <th class="px-4 py-2 font-semibold">Bentuk Penghargaan</th>
                                <th class="px-4 py-2 font-semibold">Kriteria</th>
                                <th class="px-4 py-2 font-semibold text-center">Skor</th>
                                <th class="px-4 py-2 font-semibold">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penghargaans as $index => $item)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 font-medium">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-4 py-2 font-medium">{{ $item->penghargaan->bentuk ?? '-' }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $item->penghargaan->kriteria ?? '-' }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <span
                                            class="bg-[#FFF4D6] text-[#D97706] px-3 py-1 rounded-full text-xs font-semibold">
                                            {{ $item->penghargaan->skor ?? 0 }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-gray-700">{{ $item->penghargaan->keterangan ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-5 text-center text-gray-500">
                                        Belum ada catatan penghargaan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $penghargaans->appends(request()->query())->links('vendor.pagination.simple-modern') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
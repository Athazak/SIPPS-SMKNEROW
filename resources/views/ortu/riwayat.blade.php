<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Riwayat Anak
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            {{-- ====== RIWAYAT PELANGGARAN ====== --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">
                    Riwayat Pelanggaran
                </h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                        <thead class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Tanggal</th>
                                <th class="px-4 py-2 border">Jenis</th>
                                <th class="px-4 py-2 border text-center">Skor</th>
                                <th class="px-4 py-2 border">Tindak Lanjut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pelanggarans as $index => $p)
                                <tr class="border-b border-gray-300 dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                                    <td class="px-4 py-2">{{ $p->pelanggaran->jenis_pelanggaran ?? '-' }}</td>
                                    <td class="px-4 py-2 text-center text-red-600 font-semibold">
                                        {{ $p->pelanggaran->skor ?? 0 }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $p->penanganan->tindak_lanjut ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-500">
                                        Belum ada catatan pelanggaran.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ====== RIWAYAT PENGHARGAAN ====== --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">
                    Riwayat Penghargaan
                </h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                        <thead class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Tanggal</th>
                                <th class="px-4 py-2 border">Bentuk</th>
                                <th class="px-4 py-2 border">Kriteria</th>
                                <th class="px-4 py-2 border text-center">Skor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penghargaan as $index => $h)
                                <tr class="border-b border-gray-300 dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($h->tanggal)->format('d/m/Y') }}</td>
                                    <td class="px-4 py-2">{{ $h->penghargaan->bentuk ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $h->penghargaan->kriteria ?? '-' }}</td>
                                    <td class="px-4 py-2 text-center text-green-600 font-semibold">
                                        {{ $h->penghargaan->skor ?? 0 }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-500">
                                        Belum ada catatan penghargaan.
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
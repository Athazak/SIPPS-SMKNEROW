<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Pelanggaran') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">
                    Riwayat Pelanggaran Saya
                </h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                        <thead class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Tanggal</th>
                                <th class="px-4 py-2 border">Jenis Pelanggaran</th>
                                <th class="px-4 py-2 border text-center">Skor</th>
                                <th class="px-4 py-2 border">Tindak Lanjut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pelanggarans as $index => $item)
                                <tr class="border-b border-gray-300 dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-4 py-2">{{ $item->pelanggaran->jenis_pelanggaran ?? '-' }}</td>
                                    <td class="px-4 py-2 text-center text-red-600 font-semibold">
                                        {{ $item->pelanggaran->skor ?? 0 }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $item->penanganan?->tindak_lanjut ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        Belum ada catatan pelanggaran.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $pelanggarans->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Penghargaan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 lg:px-5">
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">
                    Riwayat Penghargaan Saya
                </h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                        <thead class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Tanggal</th>
                                <th class="px-4 py-2 border">Bentuk Penghargaan</th>
                                <th class="px-4 py-2 border">Kriteria</th>
                                <th class="px-4 py-2 border text-center">Skor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penghargaans as $index => $item)
                                <tr class="border-b border-gray-300 dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-4 py-2">{{ $item->penghargaan->bentuk ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $item->penghargaan->kriteria ?? '-' }}</td>
                                    <td class="px-4 py-2 text-center text-green-600 font-semibold">
                                        {{ $item->penghargaan->skor ?? 0 }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        Belum ada catatan penghargaan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $penghargaans->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
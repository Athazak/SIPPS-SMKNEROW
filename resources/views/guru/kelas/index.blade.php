<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelas') }}
        </h2>
    </x-slot>

    <div class="py-6" x-data="{ openDetail: false, siswa: { nama: '', rombel: '', pelanggaran: [], penghargaan: [] } }">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            {{-- Pilih Rombel --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Pilih Rombel</h3>
                </div>

                <form method="GET" action="{{ route('guru.kelas.index') }}" class="flex gap-4">
                    <select name="rombel_id"
                        class="w-1/3 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200">
                        <option value="">-- Pilih Rombel --</option>
                        @foreach ($rombels as $rombel)
                            <option value="{{ $rombel->id }}" {{ $selectedRombel == $rombel->id ? 'selected' : '' }}>
                                {{ $rombel->nama_rombel }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        Tampilkan
                    </button>
                </form>
            </div>

            {{-- Daftar Siswa --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        @if ($selectedRombel)
                            Daftar Siswa - {{ $rombels->firstWhere('id', $selectedRombel)?->nama_rombel }}
                        @else
                            Daftar Siswa
                        @endif
                    </h3>
                </div>

                @if ($selectedRombel)
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                            <thead class="bg-gray-200 dark:bg-gray-700">
                                <tr>
                                    <th class="py-2 px-3">#</th>
                                    <th class="py-2 px-3">Nama Siswa</th>
                                    <th class="py-2 px-3 text-center">Skor Pelanggaran</th>
                                    <th class="py-2 px-3 text-center">Skor Penghargaan</th>
                                    <th class="py-2 px-3 text-center">Skor Akhir</th>
                                    <th class="py-2 px-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($siswaList as $index => $item)
                                    <tr
                                        class="border-b border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                        <td class="py-2 px-3">{{ $index + 1 }}</td>
                                        <td class="py-2 px-3">{{ $item['nama'] }}</td>
                                        <td class="py-2 px-3 text-center text-red-600 font-semibold">
                                            {{ $item['total_pelanggaran'] }}
                                        </td>
                                        <td class="py-2 px-3 text-center text-green-600 font-semibold">
                                            {{ $item['total_penghargaan'] }}
                                        </td>
                                        <td class="py-2 px-3 text-center font-bold">
                                            {{ $item['skor_akhir'] }}
                                        </td>
                                        <td class="py-2 px-3 text-center">
                                            <button @click="
                                                                    fetch(`/guru/kelas/{{ $item['id'] }}`)
                                                                        .then(res => res.json())
                                                                        .then(data => {
                                                                            siswa = data;
                                                                            openDetail = true;
                                                                        });
                                                                " class="text-blue-600 hover:underline font-medium">
                                                Detail
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-gray-500">
                                            Tidak ada data siswa ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $siswaList->appends(request()->all())->links() }}
                    </div>
                @else
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 rounded-lg">
                        <p>Silakan pilih rombel terlebih dahulu untuk melihat daftar siswa.</p>
                    </div>
                @endif
            </div>

            {{-- Modal Detail Siswa --}}
            <x-modal title="Detail Siswa" show="openDetail">
                <div class="space-y-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100" x-text="siswa.nama"></h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            Rombel: <span x-text="siswa.rombel"></span> |
                            Skor Total:
                            <span x-text="siswa.total_pelanggaran - siswa.total_penghargaan"></span>
                        </p>
                    </div>

                    <div>
                        <h4 class="font-semibold text-gray-700 dark:text-gray-200 mb-2">Riwayat Pelanggaran</h4>
                        <template x-if="siswa.riwayat_pelanggaran?.length">
                            <table class="w-full border text-sm">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-2 py-1">Tanggal</th>
                                        <th class="px-2 py-1">Jenis</th>
                                        <th class="px-2 py-1">Bentuk</th>
                                        <th class="px-2 py-1">Skor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="(p, i) in siswa.riwayat_pelanggaran" :key="i">
                                        <tr class="border-t">
                                            <td class="px-2 py-1" x-text="p.tanggal"></td>
                                            <td class="px-2 py-1" x-text="p.jenis"></td>
                                            <td class="px-2 py-1" x-text="p.bentuk"></td>
                                            <td class="px-2 py-1 text-center" x-text="p.skor"></td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </template>
                        <template x-if="!siswa.riwayat_pelanggaran?.length">
                            <p class="text-gray-500 text-sm">Tidak ada riwayat pelanggaran.</p>
                        </template>
                    </div>

                    <div>
                        <h4 class="font-semibold text-gray-700 dark:text-gray-200 mb-2">Riwayat Penghargaan</h4>
                        <template x-if="siswa.riwayat_penghargaan?.length">
                            <table class="w-full border text-sm">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-2 py-1">Tanggal</th>
                                        <th class="px-2 py-1">Bentuk</th>
                                        <th class="px-2 py-1">Kriteria</th>
                                        <th class="px-2 py-1">Skor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="(p, i) in siswa.riwayat_penghargaan" :key="i">
                                        <tr class="border-t">
                                            <td class="px-2 py-1" x-text="p.tanggal"></td>
                                            <td class="px-2 py-1" x-text="p.bentuk"></td>
                                            <td class="px-2 py-1" x-text="p.kriteria"></td>
                                            <td class="px-2 py-1 text-center" x-text="p.skor"></td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </template>
                        <template x-if="!siswa.riwayat_penghargaan?.length">
                            <p class="text-gray-500 text-sm">Tidak ada riwayat penghargaan.</p>
                        </template>
                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="button" @click="openDetail = false"
                            class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                            Tutup
                        </button>
                    </div>
                </div>
            </x-modal>

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelas') }}
        </h2>
    </x-slot>

    <div class="py-1" x-data="{ openDetail: false, siswa: { nama: '', rombel: '', pelanggaran: [], penghargaan: [] } }">

        <div class="max-w-7xl mx-auto px-3 lg:px-4">

            {{-- ====================== SUBHEADER ====================== --}}
            <div class="rounded-2xl shadow px-4 py-4 mb-3 flex items-center bg-white text-white">
                <div class="flex flex-col">
                    <h1 class="text-2xl font-bold text-[#2A166F]">Manajemen Kelas</h1>
                    <p class="text-gray-600 mt-1 text-sm">
                        Menampilkan daftar siswa per kelas beserta rekap pelanggaran dan penghargaan.
                    </p>
                </div>
            </div>

            {{-- Pilih Rombel --}}
            <div class="bg-white shadow rounded-xl px-4 py-2 mb-3 border border-gray-100">
                <div class="flex justify-between items-center">
                </div>

                <form method="GET" action="{{ route('guru.kelas.index') }}"
                    class="flex flex-col md:flex-row md:items-end gap-2">
                    {{-- Filter Kelas --}}
                    <div class="w-full md:w-100">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Kelas</label>
                        <select name="rombel_id"
                            class="w-full border-gray-300 rounded-xl px-3 py-2 focus:ring-[#512AD5] focus:border-[#512AD5]">
                            <option value="">Pilih Kelas</option>
                            @foreach ($rombels as $rombel)
                                <option value="{{ $rombel->id }}" {{ $selectedRombel == $rombel->id ? 'selected' : '' }}>
                                    {{ $rombel->nama_rombel }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Tombol --}}
                    <div>
                        <button type="submit"
                            class="w-full md:w-auto px-4 py-2 rounded-xl bg-[#512AD5] hover:bg-[#2A166F] text-white transition">
                            Tampilkan
                        </button>
                    </div>
                </form>
            </div>

            {{-- Daftar Siswa --}}
            <div class="bg-white shadow rounded-xl px-4 py-2 mb-3 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-600 mb-2">
                    @if ($selectedRombel)
                        Daftar Siswa - {{ $rombels->firstWhere('id', $selectedRombel)?->nama_rombel }}
                    @else
                        Daftar Siswa
                    @endif
                </h3>

                @if ($selectedRombel)
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left">
                            <thead>
                                <tr class="bg-[#F4F5FF] text-[#2A166F] border-b">
                                    <th class="px-4 py-2 font-semibold">#</th>
                                    <th class="px-4 py-2 font-semibold">Nama Siswa</th>
                                    <th class="px-4 py-2 font-semibold text-center">Skor Pelanggaran</th>
                                    <th class="px-4 py-2 font-semibold text-center">Skor Penghargaan</th>
                                    <th class="px-4 py-2 font-semibold text-center">Skor Akhir</th>
                                    <th class="px-4 py-2 font-semibold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($siswaList as $index => $item)
                                    <tr class="border-b hover:bg-gray-50 transition">
                                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="px-4 py-2 font-medium">{{ $item['nama'] }}</td>
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
                                        <td class="px-4 py-2 text-center">
                                            <span
                                                class="bg-[#E0F2FE] text-[#0092DF] px-3 py-1 rounded-full text-xs font-semibold">
                                                {{ $item['skor_akhir'] }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 text-center">
                                            <button
                                                @click="fetch(`/guru/kelas/{{ $item['id'] }}`) .then(res => res.json()) .then(data => { siswa = data; openDetail = true; });"
                                                class="inline-flex items-center justify-center w-6 h-6 rounded-lg text-xs font-medium bg-blue-500 text-white border border-blue-600 hover:bg-blue-600 hover:shadow transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12s-3.75 6.75-9.75 6.75S2.25 12 2.25 12z" />
                                                    <circle cx="12" cy="12" r="3" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-5 text-center text-gray-500">
                                            Tidak ada data siswa ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $siswaList->appends(request()->all())->links('vendor.pagination.simple-modern') }}
                    </div>
                @else
                    <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg">
                        <p>Silakan pilih kelas terlebih dahulu untuk melihat daftar siswa.</p>
                    </div>
                @endif
            </div>

            {{-- Modal Detail Siswa --}}
            <x-modal title="Detail Siswa" show="openDetail">
                <div class="mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100" x-text="siswa.nama"></h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            Rombel: <span x-text="siswa.rombel"></span> |
                            Skor Total:
                            <span x-text="siswa.skor_akhir"></span>
                        </p>
                    </div>

                    <div class="overflow-x-auto mb-2">
                        <h4 class="font-semibold text-gray-700 dark:text-gray-200 mb-2">Riwayat Pelanggaran</h4>
                        <div class="max-h-[200px] overflow-y-auto border rounded">
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
                        </div>
                        <template x-if="!siswa.riwayat_pelanggaran?.length">
                            <p class="text-gray-500 text-sm">Tidak ada riwayat pelanggaran.</p>
                        </template>
                    </div>

                    <div class="overflow-x-auto">
                        <h4 class="font-semibold text-gray-700 dark:text-gray-200 mb-2">Riwayat Penghargaan</h4>
                        <div class="max-h-[200px] overflow-y-auto border rounded">
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
                        </div>
                        <template x-if="!siswa.riwayat_penghargaan?.length">
                            <p class="text-gray-500 text-sm">Tidak ada riwayat penghargaan.</p>
                        </template>
                    </div>

                </div>
                <div class="flex justify-end space-x-2 mt-2">
                    <button type="button" @click="openDetail = false"
                        class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                        Tutup
                    </button>
                </div>
            </x-modal>

        </div>
    </div>
</x-app-layout>
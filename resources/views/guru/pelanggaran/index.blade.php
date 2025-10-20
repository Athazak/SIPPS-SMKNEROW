<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Catatan Pelanggaran Siswa') }}
        </h2>
    </x-slot>

    <div class="py-8" x-data="{ openTambah: false }">
        {{-- ===== BAGIAN TABEL UTAMA ===== --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ selectedRombel: '' }">
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        Daftar Pelanggaran
                    </h3>
                    <button @click="openTambah = true" x-data @click="$dispatch('open-modal')"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        + Tambah Pelanggaran
                    </button>
                </div>

                {{-- Filter Rombel (hanya memengaruhi tabel) --}}
                <div class="flex gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Filter Rombel</label>
                        <select x-model="selectedRombel"
                            class="mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Rombel</option>
                            @foreach ($siswa->pluck('rombel.nama_rombel')->unique() as $rombel)
                                <option value="{{ $rombel }}">{{ $rombel }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Tabel --}}
                <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                    <thead class="bg-gray-200 dark:bg-gray-700">
                        <tr>
                            <th class="py-2 px-3">#</th>
                            <th class="py-2 px-3">Tanggal</th>
                            <th class="py-2 px-3">Nama Siswa</th>
                            <th class="py-2 px-3">Rombel</th>
                            <th class="py-2 px-3">Jenis</th>
                            <th class="py-2 px-3">Bentuk</th>
                            <th class="py-2 px-3 text-center">Skor</th>
                            <th class="py-2 px-3">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($catatan as $item)
                            <tr x-show="!selectedRombel || selectedRombel === '{{ $item->siswa->rombel->nama_rombel }}'"
                                class="border-b border-gray-300 dark:border-gray-700">
                                <td class="py-2 px-3">{{ $loop->iteration }}</td>
                                <td class="py-2 px-3">
                                    {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') : '-' }}
                                </td>
                                <td class="py-2 px-3">{{ $item->siswa->user->nama }}</td>
                                <td class="py-2 px-3">{{ $item->siswa->rombel->nama_rombel ?? '-' }}</td>
                                <td class="py-2 px-3">{{ $item->pelanggaran->jenis_pelanggaran }}</td>
                                <td class="py-2 px-3">{{ $item->pelanggaran->bentuk }}</td>
                                <td class="py-2 px-3 text-center font-semibold text-red-600">
                                    {{ $item->pelanggaran->skor }}
                                </td>
                                <td class="py-2 px-3">{{ $item->keterangan ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">Belum ada data pelanggaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">{{ $catatan->links() }}</div>
            </div>
        </div>

        {{-- ===== MODAL TAMBAH ===== --}}
        <x-modal title="Tambah Catatan Pelanggaran" show="openTambah" size="3xl">
            <div x-data="{ selectedRombelModal: '', selectedJenisModal: '' }">
                <form action="{{ route('guru.pelanggaran.store') }}" method="POST">
                    @csrf

                    {{-- Filter rombel khusus modal --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Rombel</label>
                        <select x-model="selectedRombelModal"
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Rombel --</option>
                            @foreach ($siswa->pluck('rombel.nama_rombel')->unique() as $rombel)
                                <option value="{{ $rombel }}">{{ $rombel }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Pilih siswa --}}
                    <div class="mb-4" x-data="{ siswaList: @js($siswa) }">
                        <label class="block text-sm font-medium text-gray-700">Siswa</label>
                        <select name="siswa_id" :disabled="!selectedRombelModal"
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 disabled:bg-gray-100 disabled:cursor-not-allowed">

                            {{-- opsi default dinamis --}}
                            <option value=""
                                x-text="selectedRombelModal ? '-- Pilih Siswa --' : 'Pilih Rombel Terlebih Dahulu'">
                            </option>

                            <template
                                x-for="item in siswaList.filter(s => s.rombel.nama_rombel === selectedRombelModal)"
                                :key="item.id">
                                <option :value="item.id" x-text="`${item.user.nama} (${item.rombel.nama_rombel})`">
                                </option>
                            </template>
                        </select>
                    </div>

                    {{-- Filter Jenis Pelanggaran --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Jenis Pelanggaran</label>
                        <select x-model="selectedJenisModal"
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Semua Jenis --</option>
                            @foreach ($pelanggarans->pluck('jenis_pelanggaran')->unique() as $jenis)
                                <option value="{{ $jenis }}">{{ $jenis }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Pilih Pelanggaran --}}
                    <div class="mb-4" x-data="{ pelanggaranList: @js($pelanggarans) }">
                        <label class="block text-sm font-medium text-gray-700">Pelanggaran</label>
                        <select name="pelanggaran_id" :disabled="!selectedJenisModal"
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 disabled:bg-gray-100 disabled:cursor-not-allowed">

                            <option value=""
                                x-text="selectedJenisModal ? '-- Pilih Pelanggaran --' : 'Pilih Jenis Pelanggaran Terlebih Dahulu'">
                            </option>

                            <template
                                x-for="p in pelanggaranList.filter(pl => pl.jenis_pelanggaran === selectedJenisModal)"
                                :key="p.id">
                                <option :value="p.id" x-text="`${p.jenis_pelanggaran} - ${p.bentuk} (${p.skor} skor)`">
                                </option>
                            </template>
                        </select>
                    </div>

                    {{-- Keterangan --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                        <textarea name="keterangan" rows="3"
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Tuliskan keterangan (opsional)"></textarea>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end space-x-2 mt-6">
                        <button type="button" @click="openTambah = false"
                            class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </x-modal>
    </div>
</x-app-layout>
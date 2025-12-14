<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Input Penghargaan') }}
        </h2>
    </x-slot>

    <div class="py-1" x-data="{ openTambah: false }">
        <div class="max-w-7xl mx-auto px-3 lg:px-4" x-data="{ selectedRombel: '' }">

            {{-- ====================== SUBHEADER ====================== --}}
            <div class="rounded-2xl shadow px-4 py-4 mb-3 flex items-center bg-white text-white">
                <div class="flex flex-col">
                    <h1 class="text-2xl font-bold text-[#2A166F]">Pencatatan Penghargaan Siswa</h1>
                    <p class="text-gray-600 mt-1 text-sm">
                        Halaman ini digunakan untuk mencatat penghargaan siswa per kelas.
                    </p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-3 gap-3">
                <button @click="openTambah = true" x-data @click="$dispatch('open-modal')"
                    class="flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl text-sm font-medium bg-[#512AD5] text-white shadow hover:bg-[#2A166F] transition w-full sm:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 3.487l3.651 3.651-10.98 10.98-4.242.591.591-4.242 10.98-10.98z" />
                    </svg>
                    Catat Penghargaan
                </button>
            </div>

            <div class="bg-white shadow rounded-xl px-4 py-3 mb-3 border border-gray-100">
                <!-- Header -->
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-lg font-semibold text-gray-600">
                        Data Catatan Penghargaan
                    </h3>
                </div>

                {{-- Filter Rombel --}}
                <div class="mb-4">
                    <select x-model="selectedRombel"
                        class="w-[50%] border-gray-300 rounded-xl px-3 py-2 focus:ring-[#512AD5] focus:border-[#512AD5]">
                        <option value="">Semua Rombel</option>
                        @foreach ($siswa->pluck('rombel.nama_rombel')->unique() as $rombel)
                            <option value="{{ $rombel }}">{{ $rombel }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead>
                            <tr class="bg-[#F4F5FF] text-[#2A166F] border-b">
                                <th class="px-4 py-2 font-semibold">#</th>
                                <th class="px-4 py-2 font-semibold">Tanggal</th>
                                <th class="px-4 py-2 font-semibold">Nama Siswa</th>
                                <th class="px-4 py-2 font-semibold">Rombel</th>
                                <th class="px-4 py-2 font-semibold">Bentuk</th>
                                <th class="px-4 py-2 font-semibold">Kriteria</th>
                                <th class="px-4 py-2 font-semibold text-center">Skor</th>
                                <th class="px-4 py-2 font-semibold">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($catatan as $item)
                                <tr x-show="!selectedRombel || selectedRombel === '{{ $item->siswa->rombel->nama_rombel }}'"
                                    class="border-b hover:bg-gray-50 transition">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2 font-medium">
                                        {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') : '-' }}
                                    </td>
                                    <td class="px-4 py-2 font-medium">{{ $item->siswa->user->nama }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $item->siswa->rombel->nama_rombel ?? '-' }}</td>
                                    <td class="px-4 py-2 font-medium">{{ $item->penghargaan->bentuk }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $item->penghargaan->kriteria }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <span
                                            class="bg-[#FFF4D6] text-[#D97706] px-3 py-1 rounded-full text-xs font-semibold">
                                            {{ $item->penghargaan->skor }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-gray-700">{{ $item->keterangan ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-5 text-center text-gray-500">
                                        Belum ada data catatan penghargaan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
                <div class="mt-4">
                    {{ $catatan->appends(request()->query())->links('vendor.pagination.simple-modern') }}
                </div>
            </div>
        </div>

        {{-- ===== MODAL TAMBAH ===== --}}
        <x-modal title="Tambah Catatan Penghargaan" show="openTambah">
            <div
                x-data="{ selectedRombelModal: '', selectedBentukModal: '', siswaList: @js($siswa), penghargaanList: @js($penghargaans) }">
                <form action="{{ route('guru.penghargaan.store') }}" method="POST">
                    @csrf
                    {{-- Filter Rombel --}}
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

                    {{-- Pilih Siswa --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Siswa</label>
                        <select name="siswa_id" :disabled="!selectedRombelModal"
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 disabled:bg-gray-100 disabled:cursor-not-allowed">
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

                    {{-- Filter Bentuk Penghargaan --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Bentuk Penghargaan</label>
                        <select x-model="selectedBentukModal"
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Bentuk --</option>
                            @foreach ($penghargaans->pluck('bentuk')->unique() as $bentuk)
                                <option value="{{ $bentuk }}">{{ $bentuk }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Pilih Penghargaan --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Penghargaan</label>
                        <select name="penghargaan_id" :disabled="!selectedBentukModal"
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 disabled:bg-gray-100 disabled:cursor-not-allowed">
                            <option value=""
                                x-text="selectedBentukModal ? '-- Pilih Penghargaan --' : 'Pilih Bentuk Penghargaan Terlebih Dahulu'">
                            </option>
                            <template x-for="p in penghargaanList.filter(pg => pg.bentuk === selectedBentukModal)"
                                :key="p.id">
                                <option :value="p.id" x-text="`${p.kriteria} (${p.skor} skor)`">
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
                            class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-[#512AD5] text-white rounded-lg hover:bg-[#2A166F]">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </x-modal>
    </div>
</x-app-layout>
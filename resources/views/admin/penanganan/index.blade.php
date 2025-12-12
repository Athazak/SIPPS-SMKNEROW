<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Penanganan Pelanggaran') }}
        </h2>
    </x-slot>

    <div class="py-1"
        x-data="{openTambah: false, openEdit: false, openDelete: false, deleteId: '', selected: { id: '', kategori: '', skor_min: '', skor_max: '', tindak_lanjut: '' }}">
        <div class="max-w-7xl mx-auto px-3 lg:px-4">

            <!-- Subheader -->
            <div class="rounded-2xl shadow px-4 py-4 mb-3 flex items-center bg-white text-white">
                <div class="flex flex-col">
                    <h1 class="text-2xl font-bold text-[#2A166F]">
                        Kelola Data Penanganan
                    </h1>
                    <p class="text-gray-600 mt-1 text-sm">
                        Halaman ini digunakan untuk mengelola penanganan pelanggaran.
                    </p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-3 gap-3">
                <!-- Tombol Tambah -->
                <button @click="openTambah = true"
                    class="flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl text-sm font-medium bg-[#512AD5] text-white shadow hover:bg-[#2A166F] transition w-full sm:w-auto">
                    <!-- Icon Plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Penanganan
                </button>

                <!-- Search Bar -->
                <form method="GET" class="w-full sm:max-w-xs">
                    <div class="relative w-full">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari bentuk, kriteria, skor..."
                            class="w-full pl-11 pr-10 py-2.5 text-sm rounded-xl border border-gray-400 shadow-sm bg-white placeholder-gray-400 focus:ring-1 focus:ring-[#512AD5]/40 transition-all duration-200">

                        <!-- Icon Search -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>

                        <!-- Tombol Reset -->
                        @if (request('search'))
                            <a href="{{ route('admin.penanganan.index') }}"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#512AD5] transition"
                                title="Hapus pencarian">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 25 25" stroke-width="2"
                                    stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="bg-white shadow rounded-xl px-4 py-3 mb-3 border border-gray-100">
                <!-- Header -->
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-lg font-semibold text-gray-600">
                        Data Penanganan
                    </h3>
                </div>

                <!-- Table Wrapper -->
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <!-- Table Header -->
                        <thead>
                            <tr class="bg-[#F4F5FF] dark:bg-gray-700 text-[#2A166F] dark:text-gray-200 border-b">
                                <th class="px-4 py-3 font-semibold">#</th>
                                <th class="px-4 py-3 font-semibold">Kategori</th>
                                <th class="px-4 py-3 font-semibold">Skor Minimum</th>
                                <th class="px-4 py-3 font-semibold">Skor Maksimum</th>
                                <th class="px-4 py-3 font-semibold">Tindak Lanjut</th>
                                <th class="px-4 py-3 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penanganans as $p)
                                <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2 capitalize">
                                        @php
                                            $badge = [
                                                'ringan' => 'bg-[#E0F2FE] text-[#0092DF]',
                                                'sedang' => 'bg-[#FFF4D6] text-[#D97706]',
                                                'berat' => 'bg-[#FEE2E2] text-[#B91C1C]',
                                            ];
                                        @endphp
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full {{ $badge[$p->kategori] ?? 'bg-gray-200 text-gray-700' }}">
                                            {{ $p->kategori }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 font-medium">{{ $p->skor_min }}</td>
                                    <td class="px-4 py-2 font-medium">{{ $p->skor_max }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $p->tindak_lanjut }}</td>
                                    <td class="px-4 py-2">
                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-center gap-2">
                                            <!-- Tombol Edit -->
                                            <button
                                                @click=" openEdit = true; selected.id = '{{ $p->id }}'; selected.kategori = '{{ $p->kategori }}'; selected.skor_min = '{{ $p->skor_min }}'; selected.skor_max = '{{ $p->skor_max }}'; selected.tindak_lanjut = '{{ $p->tindak_lanjut }}';"
                                                class="inline-flex items-center justify-center w-6 h-6 rounded-lg text-xs font-medium bg-yellow-500 text-white border border-yellow-600 hover:bg-yellow-600 hover:shadow transition"
                                                title="Edit">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 3.487l3.651 3.651-10.98 10.98-4.242.591.591-4.242 10.98-10.98z" />
                                                </svg>
                                            </button>

                                            <!-- Tombol Hapus -->
                                            <button @click="openDelete = true; deleteId = '{{ $p->id }}'"
                                                class="inline-flex items-center justify-center w-6 h-6 rounded-lg text-xs font-medium bg-red-500 text-white border border-red-600 hover:bg-red-600 hover:shadow transition"
                                                title="Hapus">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="5" class="py-5 text-center text-gray-500">
                                    Belum ada data penanganan.
                                </td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="mt-4">
                    {{ $penanganans->appends(request()->query())->links('vendor.pagination.simple-modern') }}
                </div>
            </div>

            <!-- Modal Tambah -->
            <x-modal title="Tambah Penanganan Pelanggaran" show="openTambah">
                <form action="{{ route('admin.penanganan.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="kategori" required
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="ringan">Ringan</option>
                            <option value="sedang">Sedang</option>
                            <option value="berat">Berat</option>
                        </select>
                    </div>
                    <div class="mb-4 grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Skor Minimum</label>
                            <input type="number" name="skor_min" min="1" required
                                class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Skor Maksimum</label>
                            <input type="number" name="skor_max" min="1" required
                                class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Tindak Lanjut</label>
                        <textarea name="tindak_lanjut" rows="3" required
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

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
            </x-modal>

            <!-- Modal Edit -->
            <x-modal title="Edit Penanganan Pelanggaran" show="openEdit">
                <form :action="`{{ url('admin/penanganan') }}/${selected.id}`" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="kategori" x-model="selected.kategori" required
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="ringan">Ringan</option>
                            <option value="sedang">Sedang</option>
                            <option value="berat">Berat</option>
                        </select>
                    </div>
                    <div class="mb-4 grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Skor Minimum</label>
                            <input type="number" name="skor_min" min="1" x-model="selected.skor_min" required
                                class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Skor Maksimum</label>
                            <input type="number" name="skor_max" min="1" x-model="selected.skor_max" required
                                class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Tindak Lanjut</label>
                        <textarea name="tindak_lanjut" rows="3" x-model="selected.tindak_lanjut" required
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

                    <div class="flex justify-end space-x-2 mt-6">
                        <button type="button" @click="openEdit = false"
                            class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                            Update
                        </button>
                    </div>
                </form>
            </x-modal>

            <!-- Modal Delete -->
            <x-modal title="Konfirmasi Hapus" show="openDelete">
                <form :action="`{{ url('admin/penanganan') }}/${deleteId}`" method="POST">
                    @csrf
                    @method('DELETE')

                    <p class="text-gray-700 mb-4">
                        Apakah Anda yakin ingin menghapus data Penanganan ini?
                        Tindakan ini tidak dapat dibatalkan.
                    </p>

                    <div class="flex justify-end space-x-2 mt-6">
                        <button type="button" @click="openDelete = false"
                            class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                            Batal
                        </button>

                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                            Hapus
                        </button>
                    </div>
                </form>
            </x-modal>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Penanganan Pelanggaran') }}
        </h2>
    </x-slot>

    <div class="py-6" x-data="{ 
            openTambah: false, 
            openEdit: false, 
            selected: { id: '', kategori: '', skor_min: '', skor_max: '', tindak_lanjut: '' } 
        }">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Daftar Penanganan Pelanggaran
                    </h3>
                    <button @click="openTambah = true"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        + Tambah Penanganan
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                        <thead class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <th class="py-2 px-3">#</th>
                                <th class="py-2 px-3">Kategori</th>
                                <th class="py-2 px-3">Skor Minimum</th>
                                <th class="py-2 px-3">Skor Maksimum</th>
                                <th class="py-2 px-3">Tindak Lanjut</th>
                                <th class="py-2 px-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penanganans as $p)
                                <tr class="border-b border-gray-300 dark:border-gray-700">
                                    <td class="py-2 px-3">{{ $loop->iteration }}</td>
                                    <td class="py-2 px-3 capitalize">{{ $p->kategori }}</td>
                                    <td class="py-2 px-3">{{ $p->skor_min }}</td>
                                    <td class="py-2 px-3">{{ $p->skor_max }}</td>
                                    <td class="py-2 px-3">{{ $p->tindak_lanjut }}</td>
                                    <td class="py-2 px-3 text-center space-x-2">
                                        <button @click="
                                                openEdit = true;
                                                selected.id = '{{ $p->id }}';
                                                selected.kategori = '{{ $p->kategori }}';
                                                selected.skor_min = '{{ $p->skor_min }}';
                                                selected.skor_max = '{{ $p->skor_max }}';
                                                selected.tindak_lanjut = '{{ $p->tindak_lanjut }}';
                                            " class="text-blue-600 hover:underline">
                                            Edit
                                        </button>

                                        <form action="{{ route('admin.penanganan.destroy', $p->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">Belum ada data Penanganan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $penanganans->links() }}</div>
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
                            class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
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
                            class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">
                            Update
                        </button>
                    </div>
                </form>
            </x-modal>
        </div>
    </div>
</x-app-layout>
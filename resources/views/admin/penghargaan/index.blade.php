<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Penghargaan') }}
        </h2>
    </x-slot>

    <div class="py-6" x-data="{ 
            openTambah: false, 
            openEdit: false, 
            selected: { id: '', bentuk: '', kriteria: '', skor: '' } 
        }">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Daftar Penghargaan</h3>
                    <button @click="openTambah = true"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        + Tambah Penghargaan
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                        <thead class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <th class="py-2 px-3">#</th>
                                <th class="py-2 px-3">Bentuk Penghargaan</th>
                                <th class="py-2 px-3">Kriteria</th>
                                <th class="py-2 px-3">Skor</th>
                                <th class="py-2 px-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penghargaans as $penghargaan)
                                <tr class="border-b border-gray-300 dark:border-gray-700">
                                    <td class="py-2 px-3">{{ $loop->iteration }}</td>
                                    <td class="py-2 px-3">{{ $penghargaan->bentuk }}</td>
                                    <td class="py-2 px-3">{{ $penghargaan->kriteria }}</td>
                                    <td class="py-2 px-3">{{ $penghargaan->skor }}</td>
                                    <td class="py-2 px-3 text-center space-x-2">
                                        <button @click="
                                                                openEdit = true;
                                                                selected.id = '{{ $penghargaan->id }}';
                                                                selected.bentuk = '{{ $penghargaan->bentuk }}';
                                                                selected.kriteria = '{{ $penghargaan->kriteria }}';
                                                                selected.skor = '{{ $penghargaan->skor }}';
                                                            " class="text-blue-600 hover:underline">
                                            Edit
                                        </button>

                                        <form action="{{ route('admin.penghargaan.destroy', $penghargaan->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline"
                                                onclick="return confirm('Yakin ingin menghapus pelanggaran ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">Belum ada data Penghargaan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $penghargaans->links() }}</div>
            </div>

            <!-- Modal Tambah -->
            <x-modal title="Tambah Penghargaan" show="openTambah">
                <form action="{{ route('admin.penghargaan.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Jenis Penghargaan</label>
                        <select name="bentuk"
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Bentuk --</option>
                            <option value="Berprestasi akademik & non akademik">Berprestasi akademik & non
                                akademik</option>
                            <option value="Tidak berprestasi akademik & non akademik">Tidak berprestasi akademik & non
                                akademik</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Kriteria</label>
                        <input type="text" name="kriteria"
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Skor</label>
                        <input type="number" name="skor" min="1"
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
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
            <x-modal title="Edit Penghargaan" show="openEdit">
                <form :action="`{{ url('admin/penghargaan') }}/${selected.id}`" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Jenis Penghargaan</label>
                        <select name="bentuk" x-model="selected.bentuk"
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Bentuk --</option>
                            <option value="Berprestasi akademik & non akademik">Berprestasi akademik & non
                                akademik</option>
                            <option value="Tidak berprestasi akademik & non akademik">Tidak berprestasi akademik & non
                                akademik</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Kriteria</label>
                        <input type="text" name="kriteria" x-model="selected.kriteria"
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Skor</label>
                        <input type="number" name="skor" min="1" x-model="selected.skor"
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
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
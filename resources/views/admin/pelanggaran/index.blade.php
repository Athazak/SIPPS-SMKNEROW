<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Pelanggaran') }}
        </h2>
    </x-slot>

    <div class="py-6" x-data="{ 
            openTambah: false, 
            openEdit: false, 
            selected: { id: '', jenis_pelanggaran: '', bentuk: '', skor: '' } 
        }">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Daftar Pelanggaran</h3>
                    <button @click="openTambah = true"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        + Tambah Pelanggaran
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                        <thead class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <th class="py-2 px-3">#</th>
                                <th class="py-2 px-3">Jenis Pelanggaran</th>
                                <th class="py-2 px-3">Bentuk</th>
                                <th class="py-2 px-3">Skor</th>
                                <th class="py-2 px-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pelanggarans as $pelanggaran)
                                <tr class="border-b border-gray-300 dark:border-gray-700">
                                    <td class="py-2 px-3">{{ $loop->iteration }}</td>
                                    <td class="py-2 px-3">{{ $pelanggaran->jenis_pelanggaran }}</td>
                                    <td class="py-2 px-3">{{ $pelanggaran->bentuk }}</td>
                                    <td class="py-2 px-3">{{ $pelanggaran->skor }}</td>
                                    <td class="py-2 px-3 text-center space-x-2">
                                        <button @click="
                                                openEdit = true;
                                                selected.id = '{{ $pelanggaran->id }}';
                                                selected.jenis_pelanggaran = '{{ $pelanggaran->jenis_pelanggaran }}';
                                                selected.bentuk = '{{ $pelanggaran->bentuk }}';
                                                selected.skor = '{{ $pelanggaran->skor }}';
                                            " class="text-blue-600 hover:underline">
                                            Edit
                                        </button>

                                        <form action="{{ route('admin.pelanggaran.destroy', $pelanggaran->id) }}"
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
                                    <td colspan="5" class="text-center py-4">Belum ada data pelanggaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $pelanggarans->links() }}</div>
            </div>

            <!-- Modal Tambah -->
            <x-modal title="Tambah Pelanggaran" show="openTambah">
                <form action="{{ route('admin.pelanggaran.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Jenis Pelanggaran</label>
                        <select name="jenis_pelanggaran"
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Sikap perilaku">Sikap perilaku</option>
                            <option value="Kerapian">Kerapian</option>
                            <option value="Kerajinan">Kerajinan</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Bentuk</label>
                        <input type="text" name="bentuk"
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
            <x-modal title="Edit Pelanggaran" show="openEdit">
                <form :action="`{{ url('admin/pelanggaran') }}/${selected.id}`" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Jenis Pelanggaran</label>
                        <select name="jenis_pelanggaran" x-model="selected.jenis_pelanggaran"
                            class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Sikap perilaku">Sikap perilaku</option>
                            <option value="Kerapian">Kerapian</option>
                            <option value="Kerajinan">Kerajinan</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Bentuk</label>
                        <input type="text" name="bentuk" x-model="selected.bentuk"
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
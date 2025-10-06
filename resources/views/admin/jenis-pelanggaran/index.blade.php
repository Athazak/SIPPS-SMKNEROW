<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jenis Pelanggaran') }}
        </h2>
    </x-slot>

    <div class="py-6" x-data="{ openAdd: false, openEdit: false, editId: null, editNama: '' }">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg p-6">

                {{-- Header dan Tombol Tambah --}}
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                        Daftar Jenis Pelanggaran
                    </h3>
                    <button @click="openAdd = true"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah
                    </button>
                </div>

                {{-- Tabel --}}
                <div class="overflow-x-auto">
                    <table
                        class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold">Nama Jenis</th>
                                <th class="px-6 py-3 text-center text-sm font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $d)
                                <tr
                                    class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">
                                    <td class="px-6 py-3 text-gray-800 dark:text-gray-100">{{ $d->nama_jenis }}</td>
                                    <td class="px-6 py-3 text-center">
                                        <div class="flex items-center justify-center space-x-3">
                                            {{-- Tombol Edit --}}
                                            <button
                                                @click="openEdit = true; editId = '{{ $d->id }}'; editNama = '{{ $d->nama_jenis }}';"
                                                class="text-blue-600 hover:text-blue-800 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5h2m-1 0v14m-7 2h14a2 2 0 002-2V7l-5-5H5a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                                Edit
                                            </button>

                                            {{-- Tombol Hapus --}}
                                            <form method="POST"
                                                action="{{ route('admin.jenis-pelanggaran.destroy', $d->id) }}"
                                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-800 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center py-4 text-gray-600 dark:text-gray-300">
                                        Belum ada data jenis pelanggaran.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        {{-- Modal Tambah --}}
        <div x-show="openAdd" class="fixed inset-0 bg-gray-900/60 flex items-center justify-center z-50" x-cloak>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">Tambah Jenis Pelanggaran</h3>
                <form method="POST" action="{{ route('admin.jenis-pelanggaran.store') }}">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="nama_jenis" :value="__('Nama Jenis')" />
                        <x-text-input id="nama_jenis" name="nama_jenis" type="text" class="block mt-1 w-full"
                            required />
                    </div>
                    <div class="flex justify-end space-x-2 mt-6">
                        <x-secondary-button type="button" @click="openAdd = false">Batal</x-secondary-button>
                        <x-primary-button>Simpan</x-primary-button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal Edit --}}
        <div x-show="openEdit" class="fixed inset-0 bg-gray-900/60 flex items-center justify-center z-50" x-cloak>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">Edit Jenis Pelanggaran</h3>
                <form method="POST" :action="'/admin/jenis-pelanggaran/' + editId">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <x-input-label for="edit_nama_jenis" :value="__('Nama Jenis')" />
                        <x-text-input id="edit_nama_jenis" name="nama_jenis" type="text" class="block mt-1 w-full"
                            x-model="editNama" required />
                    </div>
                    <div class="flex justify-end space-x-2 mt-6">
                        <x-secondary-button type="button" @click="openEdit = false">Batal</x-secondary-button>
                        <x-primary-button>Update</x-primary-button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
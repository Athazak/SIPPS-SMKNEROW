<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Penghargaan Siswa') }}
        </h2>
    </x-slot>

    <div class="py-6" x-data="{ 
            openModal: false, 
            editMode: false, 
            penghargaanId: null, 
            formData: { bentuk: '', kriteria: '', skor: '' } 
        }">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg p-6">

                {{-- Header --}}
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Daftar Penghargaan</h3>
                    <button
                        @click="openModal = true; editMode = false; formData = { bentuk: '', kriteria: '', skor: '' }"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none">
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
                                <th class="px-4 py-3 text-left text-sm font-semibold">Bentuk</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold">Kriteria</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold">Skor</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penghargaans as $p)
                                <tr
                                    class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/40 transition">
                                    <td class="px-4 py-3 text-gray-800 dark:text-gray-100">{{ $p->bentuk }}</td>
                                    <td class="px-4 py-3 text-gray-800 dark:text-gray-100">{{ $p->kriteria }}</td>
                                    <td class="px-4 py-3 text-center text-gray-800 dark:text-gray-100">{{ $p->skor }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex items-center justify-center space-x-3">
                                            {{-- Tombol Edit --}}
                                            <button @click="
                                                        openModal = true;
                                                        editMode = true;
                                                        penghargaanId = {{ $p->id }};
                                                        formData = { 
                                                            bentuk: '{{ $p->bentuk }}', 
                                                            kriteria: '{{ $p->kriteria }}', 
                                                            skor: '{{ $p->skor }}' 
                                                        };
                                                    " class="text-blue-600 hover:text-blue-800 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5h2m-1 0v14m-7 2h14a2 2 0 002-2V7l-5-5H5a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                                Edit
                                            </button>

                                            {{-- Tombol Hapus --}}
                                            <form method="POST" action="{{ route('admin.penghargaan.destroy', $p->id) }}"
                                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf @method('DELETE')
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
                                    <td colspan="4" class="text-center py-4 text-gray-600 dark:text-gray-300">
                                        Belum ada data penghargaan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Pagination (kalau pakai paginate) --}}
                    {{-- <div class="px-4 py-3 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                        {{ $penghargaans->links('vendor.pagination.custom') }}
                    </div> --}}
                </div>
            </div>
        </div>

        {{-- MODAL --}}
        <div x-show="openModal" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50" x-transition>
            <div @click.away="openModal = false"
                class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-lg p-6 relative">

                <h2 class="text-lg font-semibold mb-4" x-text="editMode ? 'Edit Penghargaan' : 'Tambah Penghargaan'">
                </h2>

                <form
                    :action="editMode ? '/admin/penghargaan/' + penghargaanId : '{{ route('admin.penghargaan.store') }}'"
                    method="POST" class="space-y-4">
                    @csrf
                    <template x-if="editMode"><input type="hidden" name="_method" value="PUT"></template>

                    <div>
                        <label class="block font-medium mb-1">Bentuk Penghargaan</label>
                        <input type="text" name="bentuk" x-model="formData.bentuk"
                            class="w-full border-gray-300 rounded-md" required>
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Kriteria</label>
                        <textarea name="kriteria" x-model="formData.kriteria" class="w-full border-gray-300 rounded-md"
                            required></textarea>
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Skor</label>
                        <input type="number" name="skor" x-model="formData.skor"
                            class="w-full border-gray-300 rounded-md" required>
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" @click="openModal = false"
                            class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                            x-text="editMode ? 'Update' : 'Simpan'"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
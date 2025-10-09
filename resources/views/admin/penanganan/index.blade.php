<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center gap-2">
            📊 Kelola Penanganan Pelanggaran
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold">Data Penanganan</h3>
                <x-primary-button onclick="openModal()">+ Tambah</x-primary-button>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full border">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="p-2 text-left">Kategori</th>
                            <th class="p-2 text-center">Skor Min</th>
                            <th class="p-2 text-center">Skor Maks</th>
                            <th class="p-2 text-left">Tindak Lanjut</th>
                            <th class="p-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penanganan as $p)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="p-2">{{ $p->kategori }}</td>
                                <td class="p-2 text-center">{{ $p->skor_min }}</td>
                                <td class="p-2 text-center">{{ $p->skor_maks ?? 'Ke atas' }}</td>
                                <td class="p-2">{{ $p->tindak_lanjut }}</td>
                                <td class="p-2 text-center space-x-2">
                                    <button onclick="openModal({{ $p }})"
                                        class="text-blue-600 hover:underline">Edit</button>
                                    <form action="{{ route('admin.penanganan.destroy', $p->id) }}" method="POST"
                                        class="inline">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Yakin ingin menghapus data ini?')"
                                            class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-gray-500 p-4">Belum ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit -->
    <div id="formModal"
        class="fixed inset-0 hidden bg-gray-900/40 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
            <h2 id="modalTitle" class="text-lg font-semibold mb-4">Tambah Penanganan</h2>

            <form id="formPenanganan" method="POST" action="{{ route('admin.penanganan.store') }}">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" name="id" id="idData">

                <div class="mb-3">
                    <x-input-label for="kategori" value="Kategori" />
                    <x-text-input id="kategori" name="kategori" type="text" class="w-full" required />
                </div>

                <div class="mb-3 flex gap-2">
                    <div class="w-1/2">
                        <x-input-label for="skor_min" value="Skor Minimal" />
                        <x-text-input id="skor_min" name="skor_min" type="number" class="w-full" required />
                    </div>
                    <div class="w-1/2">
                        <x-input-label for="skor_maks" value="Skor Maksimal" />
                        <x-text-input id="skor_maks" name="skor_maks" type="number" class="w-full" />
                    </div>
                </div>

                <div class="mb-3">
                    <x-input-label for="tindak_lanjut" value="Tindak Lanjut" />
                    <textarea id="tindak_lanjut" name="tindak_lanjut" rows="3"
                        class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        required></textarea>
                </div>

                <div class="flex justify-end gap-2">
                    <x-secondary-button type="button" onclick="closeModal()">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(data = null) {
            const modal = document.getElementById('formModal');
            const title = document.getElementById('modalTitle');
            const form = document.getElementById('formPenanganan');
            const method = document.getElementById('formMethod');

            // reset form
            form.reset();

            if (data) {
                // Edit mode
                title.textContent = "Edit Penanganan";
                form.action = `/admin/penanganan/${data.id}`;
                method.value = "PUT";
                document.getElementById('idData').value = data.id;
                document.getElementById('kategori').value = data.kategori;
                document.getElementById('skor_min').value = data.skor_min;
                document.getElementById('skor_maks').value = data.skor_maks ?? '';
                document.getElementById('tindak_lanjut').value = data.tindak_lanjut;
            } else {
                // Tambah mode
                title.textContent = "Tambah Penanganan";
                form.action = "{{ route('admin.penanganan.store') }}";
                method.value = "POST";
                document.getElementById('idData').value = '';
            }

            modal.classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('formModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
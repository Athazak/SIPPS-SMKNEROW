<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Import Guru & Siswa') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            {{-- Generate Akun Ortu --}}
            
                <form action="{{ route('admin.import.generate-ortu') }}" method="POST"
                    onsubmit="return confirm('Yakin ingin generate akun ortu untuk semua siswa?')">
                    @csrf
                    <button class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition">
                        Generate Akun Orang Tua
                    </button>
                </form>

            {{-- Import Siswa --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <form action="{{ route('admin.import.preview-siswa') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-3">
                    @csrf
                    <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">Upload Data Siswa</label>
                    <input type="file" name="file" class="w-full border p-2 rounded dark:bg-gray-700 dark:text-gray-200"
                        required>
                    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Preview Siswa
                    </button>
                </form>
            </div>

            {{-- Import Guru --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <form action="{{ route('admin.import.preview-guru') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-3">
                    @csrf
                    <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">Upload Data Guru</label>
                    <input type="file" name="file" class="w-full border p-2 rounded dark:bg-gray-700 dark:text-gray-200"
                        required>
                    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                        Preview Guru
                    </button>
                </form>
            </div>

            {{-- Table Data Siswa --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">Data Siswa</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left border">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                            <tr>
                                <th class="px-4 py-2 border">NIS</th>
                                <th class="px-4 py-2 border">Nama</th>
                                <th class="px-4 py-2 border">Kelas</th>
                                <th class="px-4 py-2 border">No HP</th>
                                <th class="px-4 py-2 border">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($siswa as $item)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $item->nis }}</td>
                                    <td class="px-4 py-2">{{ $item->name }}</td>
                                    <td class="px-4 py-2">{{ $item->kelas?->nama_kelas ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $item->phone ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $item->email }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-2 text-center">Belum ada data siswa</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">{{ $siswa->links() }}</div>
            </div>

            {{-- Table Data Guru --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">Data Guru</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left border">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                            <tr>
                                <th class="px-4 py-2 border">NIP</th>
                                <th class="px-4 py-2 border">Nama</th>
                                <th class="px-4 py-2 border">No HP</th>
                                <th class="px-4 py-2 border">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($guru as $item)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $item->nip }}</td>
                                    <td class="px-4 py-2">{{ $item->name }}</td>
                                    <td class="px-4 py-2">{{ $item->phone ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $item->email }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-center">Belum ada data guru</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">{{ $guru->links() }}</div>
            </div>

        </div>
    </div>
</x-app-layout>
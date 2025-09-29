<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Kelas') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg sm:rounded-lg p-6">

                <!-- Tombol Tambah -->
                <div class="flex justify-between items-center mb-4">
                    <a href="{{ route('admin.kelas.create') }}">
                        <x-primary-button>
                            {{ __('Tambah Kelas') }}
                        </x-primary-button>
                    </a>
                </div>

                <!-- Tabel -->
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                            <tr>
                                <th class="px-4 py-3 border">Tingkat</th>
                                <th class="px-4 py-3 border">Jurusan</th>
                                <th class="px-4 py-3 border">Nama Kelas</th>
                                <th class="px-4 py-3 border text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kelas as $k)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-2 border">{{ $k->tingkat }}</td>
                                    <td class="px-4 py-2 border">{{ $k->jurusan }}</td>
                                    <td class="px-4 py-2 border">{{ $k->nama_kelas }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        <div class="flex justify-center space-x-3">
                                            <!-- Edit -->
                                            <a href="{{ route('admin.kelas.edit', $k->id) }}"
                                                class="text-blue-600 font-medium hover:underline">
                                                Edit
                                            </a>

                                            <!-- Hapus -->
                                            <form action="{{ route('admin.kelas.destroy', $k->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin hapus kelas ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 font-medium hover:underline">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
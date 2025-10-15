<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Siswa dan Ortu') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            {{-- Form Import --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">
                    Upload Data Siswa (Excel)
                </label>

                <form action="{{ route('admin.siswa.import') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf

                    <input type="file" name="file"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                        required>

                    <x-primary-button>Upload</x-primary-button>
                </form>
            </div>

            {{-- Daftar Siswa --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">Daftar Siswa</h3>

                {{-- Form Pencarian --}}
                <form method="GET" action="{{ route('admin.siswa.index') }}" class="mb-4 flex items-center gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama, username, atau NISN..."
                        class="w-full md:w-1/3 border rounded-lg p-2 dark:bg-gray-700 dark:text-gray-200 focus:ring focus:ring-blue-300" />
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.siswa.index') }}"
                            class="bg-gray-300 text-gray-800 px-3 py-2 rounded-lg hover:bg-gray-400 transition">
                            Reset
                        </a>
                    @endif
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left border border-gray-300 dark:border-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                            <tr>
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Nama Siswa</th>
                                <th class="px-4 py-2 border">Username Siswa</th>
                                <th class="px-4 py-2 border">Rombel</th>
                                <th class="px-4 py-2 border">JK</th>
                                <th class="px-4 py-2 border">NISN</th>
                                <th class="px-4 py-2 border">Username Ortu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($siswas as $index => $item)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $siswas->firstItem() + $index }}</td>
                                    <td class="px-4 py-2">{{ $item->user->nama }}</td>
                                    <td class="px-4 py-2 font-mono">{{ $item->user->username }}</td>
                                    <td class="px-4 py-2">{{ $item->rombel->nama_rombel }}</td>
                                    <td class="px-4 py-2">{{ $item->jenis_kelamin }}</td>
                                    <td class="px-4 py-2">{{ $item->nisn ?? '-' }}</td>
                                    <td class="px-4 py-2 font-mono">{{ $item->ortu->user->username ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center px-4 py-2">Belum ada data siswa</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $siswas->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
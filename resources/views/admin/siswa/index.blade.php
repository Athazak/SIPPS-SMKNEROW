<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Siswa & Ortu') }}
        </h2>
    </x-slot>

    <div class="py-1" x-data="{ openImport: false,
        openReset: false,
        resetName: '',
        resetAction: '', }">
        <div class="max-w-7xl mx-auto px-3 lg:px-4">

            @if (session('import_result'))
                @php $result = session('import_result'); @endphp

                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
                    x-transition.opacity.duration.500ms
                    class="p-4 mb-4 text-sm rounded-lg bg-green-100 border border-green-400 text-green-700">
                    <strong>Import Selesai</strong><br>
                    Total data di file: {{ $result['total'] }},
                    Berhasil ditambahkan: {{ $result['inserted'] }},
                    Duplikat dilewati: {{ $result['skipped'] }}.
                </div>
            @endif

            <!-- Subheader -->
            <div class="rounded-2xl shadow px-4 py-4 mb-3 flex items-center bg-white text-white">

                <div class="flex flex-col">
                    <h1 class="text-2xl font-bold text-[#2A166F]">
                        Kelola Data Siswa & Ortu
                    </h1>

                    <p class="text-sm text-gray-600 mt-1">
                        Halaman ini digunakan untuk mengimport data dan mereset password siswa dan ortu.
                    </p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-3 gap-3">
                <!-- Tombol Import -->
                <button @click="openImport = true"
                    class="flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl text-sm font-medium bg-[#512AD5] text-white shadow hover:bg-[#2A166F] transition w-full sm:w-auto">
                    <!-- Icon Import -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v12m0 0l4-4m-4 4l-4-4M4 19h16" />
                    </svg>
                    Import Siswa
                </button>

                <!-- Search Bar -->
                <form method="GET" class="w-full sm:max-w-xs">
                    <div class="relative w-full">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama, username, nisn..." class="w-full pl-11 pr-10 py-2.5 text-sm rounded-xl border border-gray-400
                       shadow-sm bg-white placeholder-gray-400
                       focus:ring-1 focus:ring-[#512AD5]/40
                       transition-all duration-200">

                        <!-- Icon Search -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>

                        <!-- Tombol Reset -->
                        @if (request('search'))
                            <a href="{{ route('admin.siswa.index') }}"
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

            {{-- Daftar Siswa --}}
            <div class="bg-white shadow rounded-xl px-4 py-3 mb-3 border border-gray-100">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-lg font-semibold text-gray-600">
                        Daftar Siswa
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead>
                            <tr class="bg-[#F4F5FF] dark:bg-gray-700 text-[#2A166F] dark:text-gray-200 border-b">
                                <th class="px-4 py-3 font-semibold">No</th>
                                <th class="px-4 py-3 font-semibold">Nama Siswa</th>
                                <th class="px-4 py-3 font-semibold">Username Siswa</th>
                                <th class="px-4 py-3 font-semibold">Rombel</th>
                                <th class="px-4 py-3 font-semibold">JK</th>
                                <th class="px-4 py-3 font-semibold">NISN</th>
                                <th class="px-4 py-3 font-semibold">Username Ortu</th>
                                <th class="px-4 py-3 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($siswas as $index => $item)
                                <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-4 py-2">{{ $siswas->firstItem() + $index }}</td>
                                    <td class="px-4 py-2">{{ $item->user->nama }}</td>
                                    <td class="px-4 py-2 font-mono text-gray-700 dark:text-gray-300">
                                        {{ $item->user->username }}
                                    </td>
                                    <td class="px-4 py-2">{{ $item->rombel->nama_rombel }}</td>
                                    <td class="px-4 py-2">{{ $item->jenis_kelamin }}</td>
                                    <td class="px-4 py-2">{{ $item->nisn ?? '-' }}</td>
                                    <td class="px-4 py-2 font-mono text-gray-700 dark:text-gray-300">
                                        {{ $item->ortu->user->username ?? '-' }}
                                    </td>
                                    <td
                                        class="px-4 py-2 text-center flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                        <button
                                            @click="openReset = true; resetName = '{{ $item->user->nama }}'; resetAction = '{{ route('admin.siswa.reset-password', $item->user->id) }}';"
                                            class="px-3 py-1.5 text-xs rounded-md bg-red-500 hover:bg-red-600 text-white transition shadow-sm">
                                            Reset Siswa
                                        </button>
                                        <button
                                            @click="openReset = true; resetName = 'Orangtua dari {{ $item->user->nama }}'; resetAction = '{{ route('admin.siswa.reset-password', $item->ortu->user->id) }}';"
                                            class="px-3 py-1.5 text-xs rounded-md bg-red-500 hover:bg-red-600 text-white transition shadow-sm">
                                            Reset Ortu
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-5 text-center text-gray-500">
                                        Belum ada data guru.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $siswas->appends(request()->query())->links('vendor.pagination.simple-modern') }}
                </div>
            </div>

            <x-modal title="Import Data Siswa" show="openImport">
                <form action="{{ route('admin.siswa.import') }}" method="POST" enctype="multipart/form-data"
                    x-data="{ fileName: '' }">
                    @csrf

                    <div class="mb-2">
                        <!-- Drop Zone -->
                        <label
                            class="w-full flex flex-col items-center justify-center gap-2 py-8 mb-2 border-2 border-dashed border-[#512AD5]/40 rounded-xl cursor-pointer hover:border-[#512AD5] transition">

                            <!-- Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#512AD5]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 4v16m8-8H4" />
                            </svg>

                            <span class="text-gray-600 text-sm font-medium">
                                Klik untuk memilih file Excel
                            </span>

                            <input type="file" name="file" class="hidden" required
                                @change="fileName = $event.target.files[0]?.name ?? ''" />
                        </label>

                        <!-- PREVIEW FILE TERPILIH -->
                        <template x-if="fileName">
                            <p class="text-sm text-gray-700">
                                <span class="font-medium">File terpilih:</span>
                                <span class="text-[#512AD5]/80 font-semibold" x-text="fileName"></span>
                            </p>
                        </template>
                    </div>

                    <div class="flex justify-end">
                        <!-- Submit -->
                        <button type="submit"
                            class="px-4 py-2 rounded-lg font-medium text-white bg-[#512AD5] hover:bg-[#2A166F] transition shadow">
                            Upload
                        </button>
                    </div>
                </form>
            </x-modal>

            <!-- MODAL RESET PASSWORD -->
            <x-modal title="Reset Password" show="openReset">
                <p class="text-gray-700 mb-4">
                    Apakah Anda yakin ingin mereset password untuk
                    <span class="font-semibold text-[#512AD5]" x-text="resetName"></span>?
                </p>

                <form :action="resetAction" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="flex justify-end gap-2">
                        <button type="button" @click="openReset = false"
                            class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                            Batal
                        </button>

                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                            Reset
                        </button>
                    </div>
                </form>
            </x-modal>
        </div>
    </div>
</x-app-layout>
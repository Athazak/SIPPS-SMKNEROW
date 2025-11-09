<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Guru') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 lg:px-5">

            {{-- Form Import --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-2xl p-6 mb-6">
                <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">
                    Upload Data Guru (Excel)
                </label>

                <form action="{{ route('admin.guru.import') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf

                    <input type="file" name="file"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                        required>

                    <x-primary-button>Upload</x-primary-button>
                </form>
            </div>

            {{-- Daftar Guru --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">Daftar Guru</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                        <thead class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Nama</th>
                                <th class="px-4 py-2 border">Username</th>
                                <th class="px-4 py-2 border">NUPTK</th>
                                <th class="px-4 py-2 border">NIP</th>
                                <th class="px-4 py-2 border">JK</th>
                                <th class="px-4 py-2 border">Status Kepegawaian</th>
                                <th class="px-4 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($guru as $index => $item)
                                <tr class="border-b border-gray-300 dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $guru->firstItem() + $index }}</td>
                                    <td class="px-4 py-2">{{ $item->user->nama }}</td>
                                    <td class="px-4 py-2 font-mono">{{ $item->user->username }}</td>
                                    <td class="px-4 py-2">{{ $item->nuptk ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $item->nip ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $item->jenis_kelamin }}</td>
                                    <td class="px-4 py-2">{{ $item->status_kepegawaian ?? '-' }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        <form action="{{ route('admin.guru.reset-password', $item->user->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Reset password untuk {{ $item->user->nama }}?')">
                                            @csrf
                                            @method('PUT')
                                            <x-primary-button
                                                class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded-md">
                                                Reset
                                            </x-primary-button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">Belum ada data guru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $guru->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
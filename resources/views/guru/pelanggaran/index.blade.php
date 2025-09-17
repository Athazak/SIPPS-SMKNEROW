<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Pelanggaran') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('guru.pelanggaran.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                    Tambah
                </a>
            </div>

            <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="p-3">Siswa</th>
                            <th class="p-3">Bentuk</th>
                            <th class="p-3">Tanggal</th>
                            <th class="p-3">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                            <tr class="border-t border-gray-200 dark:border-gray-700">
                                <td class="p-3">{{ $row->siswa->name }}</td>
                                <td class="p-3">{{ $row->bentuk->bentuk }}</td>
                                <td class="p-3">{{ $row->tanggal }}</td>
                                <td class="p-3">{{ $row->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
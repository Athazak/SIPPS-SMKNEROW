<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Guru') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow rounded mb-4">
                <p class="text-gray-700 dark:text-gray-300">
                    Total pelanggaran yang Anda catat:
                    <span class="font-semibold">{{ $pelanggaranSaya }}</span>
                </p>
            </div>

            <a href="{{ route('guru.pelanggaran.create') }}"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                Tambah Pelanggaran
            </a>
        </div>
    </div>
</x-app-layout>
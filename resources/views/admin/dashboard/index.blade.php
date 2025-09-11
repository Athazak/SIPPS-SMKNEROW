<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Jumlah Siswa -->
                <div class="p-6 bg-blue-500 dark:bg-blue-700 text-white shadow rounded-xl hover:scale-105 transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-80">Jumlah Siswa</p>
                            <p class="text-2xl font-bold">{{ $jumlahSiswa }}</p>
                        </div>
                        <x-heroicon-o-academic-cap class="w-6 h-6 opacity-70" />
                    </div>
                </div>

                <!-- Jumlah Guru -->
                <div class="p-6 bg-green-500 dark:bg-green-700 text-white shadow rounded-xl hover:scale-105 transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-80">Jumlah Guru</p>
                            <p class="text-3xl font-bold">{{ $jumlahGuru }}</p>
                        </div>
                        <x-heroicon-o-user-group class="w-10 h-10 opacity-70" />
                    </div>
                </div>

                <!-- Pelanggaran -->
                <div class="p-6 bg-red-500 dark:bg-red-700 text-white shadow rounded-xl hover:scale-105 transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-80">Pelanggaran</p>
                            <p class="text-3xl font-bold">{{ $pelanggaran }}</p>
                        </div>
                        <x-heroicon-o-exclamation-triangle class="w-10 h-10 opacity-70" />
                    </div>
                </div>

                <!-- Penghargaan -->
                <div class="p-6 bg-yellow-500 dark:bg-yellow-600 text-white shadow rounded-xl hover:scale-105 transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-80">Penghargaan</p>
                            <p class="text-3xl font-bold">{{ $penghargaan }}</p>
                        </div>
                        <x-heroicon-o-star class="w-10 h-10 opacity-70" />
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
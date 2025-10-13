<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"">
            {{ __('Tambah Pelanggaran') }}
        </h2>
    </x-slot>

    <div class=" py-8">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 p-8 shadow-lg rounded-2xl">
                    <h1 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-6">Form Tambah Pelanggaran</h1>

                    <form method="POST" action="{{ route('guru.pelanggaran.store') }}" class="space-y-6">
                        @csrf

                        <!-- Pilih Siswa -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Siswa</label>
                            <select name="siswa_id"
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-blue-500">
                                @foreach($siswa as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->nis }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Bentuk Pelanggaran -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Bentuk
                                Pelanggaran</label>
                            <select name="bentuk_pelanggaran_id"
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-blue-500">
                                @foreach($bentuk as $b)
                                    <option value="{{ $b->id }}">{{ $b->bentuk }} (Skor: {{ $b->skor }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tanggal -->
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal</label>
                            <input type="date" name="tanggal"
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Keterangan -->
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Keterangan</label>
                            <textarea name="keterangan" rows="4"
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>

                        <!-- Tombol -->
                        <div class="flex justify-end">
                            <a href="{{ route('guru.pelanggaran.index') }}"
                                class="mr-3 inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 text-sm font-medium rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
</x-app-layout>
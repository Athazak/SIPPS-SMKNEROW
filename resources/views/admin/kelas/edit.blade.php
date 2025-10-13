<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kelas') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.kelas.update', $kelas->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Tingkat -->
                    <div class="mb-4">
                        <x-input-label for="tingkat" :value="__('Tingkat')" />
                        <select id="tingkat" name="tingkat"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Pilih Tingkat --</option>
                            <option value="1" {{ old('tingkat', $kelas->tingkat) == 1 ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('tingkat', $kelas->tingkat) == 2 ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('tingkat', $kelas->tingkat) == 3 ? 'selected' : '' }}>3</option>
                        </select>
                        <x-input-error :messages="$errors->get('tingkat')" class="mt-2" />
                    </div>

                    <!-- Jurusan -->
                    <div class="mb-4">
                        <x-input-label for="jurusan" :value="__('Jurusan')" />
                        <input list="jurusanList" id="jurusan" name="jurusan"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            value="{{ old('jurusan', $kelas->jurusan) }}">

                        <!-- Datalist untuk rekomendasi jurusan -->
                        <datalist id="jurusanList">
                            @foreach($jurusanList as $jurusan)
                                <option value="{{ $jurusan }}"></option>
                            @endforeach
                        </datalist>

                        <x-input-error :messages="$errors->get('jurusan')" class="mt-2" />
                    </div>

                    <!-- Nama Kelas -->
                    <div class="mb-4">
                        <p class="text-sm text-gray-500 mt-1">Nama kelas akan digenerate otomatis berdasarkan tingkat &
                            jurusan.</p>
                    </div>

                    <!-- Tombol -->
                    <div class="flex items-center justify-end mt-6 space-x-3">
                        <a href="{{ route('admin.kelas.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                            {{ __('Batal') }}
                        </a>
                        <x-primary-button>
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
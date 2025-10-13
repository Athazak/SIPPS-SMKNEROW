<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"">
            {{ __('Dashboard Siswa') }}
        </h2>
    </x-slot>

    <div class=" py-10">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

                <!-- Pelanggaran -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6">
                    <div class="flex items-center mb-4">
                        <!-- Heroicon: X Circle -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m-2 8a9 9 0 100-18 9 9 0 000 18z" />
                        </svg>
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Pelanggaran</h2>
                    </div>

                    @forelse($pelanggaran as $p)
                        <div class="flex items-center justify-between p-3 bg-red-50 dark:bg-red-900/30 rounded-lg mb-2">
                            <span class="text-sm text-gray-700 dark:text-gray-300">
                                {{ $p->tanggal }} - {{ $p->bentuk->bentuk }}
                            </span>
                            <span class="text-sm font-bold text-red-600 dark:text-red-400">
                                {{ $p->bentuk->skor }} poin
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada data pelanggaran.</p>
                    @endforelse
                </div>

                <!-- Penghargaan -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6">
                    <div class="flex items-center mb-4">
                        <!-- Heroicon: Star -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l2.065 6.348h6.685c.969 0 1.371 1.24.588 1.81l-5.412 3.928 2.065 6.348c.3.922-.755 1.688-1.54 1.118L12 18.347l-5.402 3.132c-.785.57-1.84-.196-1.54-1.118l2.065-6.348-5.412-3.928c-.783-.57-.38-1.81.588-1.81h6.685l2.065-6.348z" />
                        </svg>
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Penghargaan</h2>
                    </div>

                    @forelse($penghargaan as $h)
                        <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/30 rounded-lg mb-2">
                            <span class="text-sm text-gray-700 dark:text-gray-300">
                                {{ $h->tanggal }} - {{ $h->penghargaan->bentuk }}
                            </span>
                            <span class="text-sm font-bold text-green-600 dark:text-green-400">
                                {{ $h->penghargaan->skor }} poin
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada data penghargaan.</p>
                    @endforelse
                </div>

            </div>
            </div>
</x-app-layout>
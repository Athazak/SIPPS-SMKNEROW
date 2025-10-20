<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Siswa') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">
                    {{ $siswa->user->nama }} - {{ $siswa->rombel->nama_rombel }}
                </h3>

                <div class="grid md:grid-cols-2 gap-6">
                    {{-- Pelanggaran --}}
                    <div>
                        <h4 class="text-md font-semibold mb-2 text-red-600">Riwayat Pelanggaran</h4>
                        <ul class="list-disc pl-5 space-y-1">
                            @forelse ($siswa->catatanPelanggarans as $p)
                                <li>{{ $p->pelanggaran->bentuk ?? '-' }} ({{ $p->pelanggaran->skor ?? 0 }} skor)</li>
                            @empty
                                <li>Tidak ada pelanggaran.</li>
                            @endforelse
                        </ul>
                    </div>

                    {{-- Penghargaan --}}
                    <div>
                        <h4 class="text-md font-semibold mb-2 text-green-600">Riwayat Penghargaan</h4>
                        <ul class="list-disc pl-5 space-y-1">
                            @forelse ($siswa->catatanPenghargaans as $p)
                                <li>{{ $p->penghargaan->kriteria ?? '-' }} ({{ $p->penghargaan->skor ?? 0 }} skor)</li>
                            @empty
                                <li>Tidak ada penghargaan.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
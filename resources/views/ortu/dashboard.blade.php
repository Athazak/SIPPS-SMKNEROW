<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w-7xl mx-auto px-3 lg:px-4">
            {{-- ====== HEADER SAPAAN ====== --}}
            <div
                class="rounded-2xl shadow-lg px-4 py-4 mb-3 flex items-center bg-gradient-to-r from-[#2A166F] to-[#0092DF] text-white">
                <div class="flex flex-col">
                    <p class="text-sm opacity-80 tracking-wide">Orang Tua</p>
                    <h2 class="text-2xl font-bold leading-tight">
                        Monitoring Anak
                    </h2>
                    <p class="text-sm opacity-90 mt-1">
                        Pantau perkembangan dan sikap anak Anda di sekolah
                    </p>
                </div>
            </div>

            {{-- ====== INFORMASI ANAK (RESPONSIF) ====== --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-2xl p-4 mb-3">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">

                    {{-- Identitas --}}
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 md:w-12 md:h-12 rounded-full bg-[#0092DF]/20
                        flex items-center justify-center shrink-0">
                            <x-heroicon-o-user class="w-5 h-5 md:w-6 md:h-6 text-[#0092DF]" />
                        </div>

                        <div class="min-w-0">
                            <h3 class="text-sm md:text-base font-semibold text-gray-800 dark:text-gray-200 truncate">
                                {{ ucwords(strtolower($siswa->user->nama)) }}
                            </h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                {{ $siswa->rombel->nama_rombel ?? '-' }} · {{ $siswa->jenis_kelamin }}
                            </p>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="md:self-center">
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                @if($penanganan?->kategori === 'berat') bg-red-100 text-red-700
                @elseif($penanganan?->kategori === 'sedang') bg-yellow-100 text-yellow-700
                @elseif($penanganan?->kategori === 'ringan') bg-blue-100 text-blue-700
                @else bg-green-100 text-green-700 @endif">
                            {{ strtoupper($penanganan->kategori ?? 'AMAN') }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- ====== RINGKASAN KONDISI ANAK (SERAGAM) ====== --}}
            @php
                $kategori = $penanganan->kategori ?? 'aman';

                $ringkasan = match ($kategori) {
                    'berat' => [
                        'bg' => 'bg-red-50 border-red-400',
                        'icon' => 'exclamation-triangle',
                        'iconColor' => 'text-red-600',
                        'judul' => 'Perlu Perhatian Khusus',
                        'pesan' => 'Anak berada pada kategori pelanggaran berat. Disarankan orang tua segera berkoordinasi dengan wali kelas atau guru BK.'
                    ],
                    'sedang' => [
                        'bg' => 'bg-yellow-50 border-yellow-400',
                        'icon' => 'exclamation-circle',
                        'iconColor' => 'text-yellow-600',
                        'judul' => 'Perlu Pendampingan',
                        'pesan' => 'Anak memerlukan pengawasan dan pendampingan agar tidak terjadi pelanggaran berulang.'
                    ],
                    'ringan' => [
                        'bg' => 'bg-blue-50 border-blue-400',
                        'icon' => 'information-circle',
                        'iconColor' => 'text-blue-600',
                        'judul' => 'Perlu Perhatian Ringan',
                        'pesan' => 'Terdapat pelanggaran ringan. Diharapkan orang tua tetap memberikan arahan dan motivasi.'
                    ],
                    default => [
                        'bg' => 'bg-green-50 border-green-400',
                        'icon' => 'check-circle',
                        'iconColor' => 'text-green-600',
                        'judul' => 'Kondisi Aman',
                        'pesan' => 'Kondisi anak tergolong baik. Terus dukung dan motivasi anak agar tetap konsisten.'
                    ],
                };
            @endphp

            <div class="border {{ $ringkasan['bg'] }} rounded-2xl p-4 mb-3">
                <div class="flex items-start gap-3">
                    <div class="p-2 rounded-xl bg-white shadow-sm">
                        <x-heroicon-o-check-circle class="w-6 h-6 {{ $ringkasan['iconColor'] }}" />
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gray-800">
                            {{ $ringkasan['judul'] }}
                        </p>
                        <p class="text-xs text-gray-600 mt-1 leading-relaxed">
                            {{ $ringkasan['pesan'] }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
                {{-- Pelanggaran --}}
                <div class="px-3 py-3 bg-[#DB261D] text-white rounded-xl shadow
                flex items-center gap-3 hover:scale-[1.04]
                hover:-translate-y-1 hover:shadow-lg transition-all">
                    <div class="p-2 bg-white/20 rounded-lg">
                        <x-heroicon-o-exclamation-triangle class="w-6 h-6" />
                    </div>
                    <div>
                        <p class="text-xs opacity-80">Pelanggaran</p>
                        <p class="text-lg font-bold">{{ $totalPelanggaran }}</p>
                    </div>
                </div>

                {{-- Penghargaan --}}
                <div class="px-3 py-3 bg-[#FFF601] text-black rounded-xl shadow
                flex items-center gap-3 hover:scale-[1.04]
                hover:-translate-y-1 hover:shadow-lg transition-all">
                    <div class="p-2 bg-black/20 rounded-lg">
                        <x-heroicon-o-star class="w-6 h-6" />
                    </div>
                    <div>
                        <p class="text-xs opacity-80">Penghargaan</p>
                        <p class="text-lg font-bold">{{ $totalPenghargaan }}</p>
                    </div>
                </div>

                {{-- Skor --}}
                <div class="px-3 py-3 bg-[#0092DF] text-white rounded-xl shadow
                flex items-center gap-3 hover:scale-[1.04]
                hover:-translate-y-1 hover:shadow-lg transition-all">
                    <div class="p-2 bg-white/20 rounded-lg">
                        <x-heroicon-o-scale class="w-6 h-6" />
                    </div>
                    <div>
                        <p class="text-xs opacity-80">Skor</p>
                        <p class="text-lg font-bold">{{ $skorAkhir }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-2xl p-4 mb-3">
                <div class="flex flex-col sm:flex-row justify-between gap-2">
                    <h3 class="font-semibold text-gray-700">
                        Riwayat Anak Terbaru
                    </h3>

                    {{-- ====== TERAKHIR DIPERBARUI (SERAGAM) ====== --}}
                    <div class="flex items-center gap-2 bg-[#2A166F]/10 border border-[#2A166F]/20
                        rounded-xl px-3 py-2 mb-3 shadow-sm w-fit">
                        <x-heroicon-o-clock class="w-4 h-4 text-gray-500" />

                        <p class="text-xs text-gray-600">
                            Terakhir diperbarui:
                            <span class="font-medium text-gray-800">
                                {{ $tanggalTerakhir ? \Carbon\Carbon::parse($tanggalTerakhir)->diffForHumans() : '-' }}
                            </span>
                        </p>
                    </div>
                </div>

                <div class="space-y-3">
                    @forelse ($riwayat as $item)
                                    <div class="flex items-start gap-3 p-3 rounded-xl
                                                                                                                                                                                                                {{ $item['tipe'] === 'pelanggaran'
                        ? 'bg-red-50 border border-red-100'
                        : 'bg-yellow-50 border border-yellow-100' }}">
                                        <div class="mt-1">
                                            @if($item['tipe'] === 'pelanggaran')
                                                <x-heroicon-o-exclamation-circle class="w-5 h-5 text-red-500" />
                                            @else
                                                <x-heroicon-o-check-circle class="w-5 h-5 text-yellow-500" />
                                            @endif
                                        </div>

                                        <div class="flex-1">
                                            <p class="text-sm font-semibold capitalize">
                                                {{ $item['tipe'] }}
                                            </p>
                                            <p class="text-xs text-gray-600">
                                                {{ $item['pesan'] }}
                                            </p>
                                            <p class="text-xs text-gray-400 mt-1">
                                                {{ $item['tanggal'] }}
                                            </p>
                                        </div>
                                    </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">
                            Belum ada riwayat terbaru.
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
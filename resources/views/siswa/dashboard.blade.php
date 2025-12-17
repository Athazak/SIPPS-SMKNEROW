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
                    <p class="text-sm opacity-80 tracking-wide">Halo 👋</p>
                    <h2 class="text-2xl font-bold leading-tight">
                        {{ ucwords(strtolower($user->nama)) }}
                    </h2>
                    <p class="text-sm opacity-90 mt-1">
                        Rombel {{ $siswa?->rombel?->nama_rombel ?? '-' }} · Tetap jaga sikap dan prestasi kamu hari ini
                        💪
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-3">
                {{-- STATUS SIKAP --}}
                <div class="bg-white rounded-xl shadow px-3 py-3 hover:shadow-md transition">
                    <p class="text-xs text-gray-500 mb-1">Status Penanganan</p>

                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full
                            {{ $statusKategori === 'berat' ? 'bg-red-100 text-red-700' :
    ($statusKategori === 'sedang' ? 'bg-yellow-100 text-yellow-700' :
        ($statusKategori === 'ringan' ? 'bg-blue-100 text-blue-700' :
            'bg-green-100 text-green-700')) }}">
                            {{ strtoupper($statusKategori) }}
                        </span>

                        <x-heroicon-o-shield-check class="w-4 h-4
                            {{ $statusKategori === 'berat' ? 'text-red-600' :
    ($statusKategori === 'sedang' ? 'text-yellow-600' :
        ($statusKategori === 'ringan' ? 'text-blue-600' :
            'text-green-600')) }}" />
                    </div>
                </div>

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

                <div class="px-3 py-3 bg-[#0092DF] text-white rounded-xl shadow
                            flex items-center gap-3 hover:scale-[1.04]
                            hover:-translate-y-1 hover:shadow-lg transition-all">
                    <div class="p-2 bg-white/20 rounded-lg">
                        <x-heroicon-o-scale class="w-6 h-6" />
                    </div>
                    <div>
                        <p class="text-xs opacity-80">Skor Saat Ini</p>
                        <p class="text-lg font-bold">{{ $skorAkhir }}</p>
                    </div>
                </div>
            </div>

            {{-- ====== RIWAYAT TERBARU ====== --}}
            <div class="bg-white shadow rounded-2xl p-4 mb-3">
                <h3 class="font-semibold text-gray-700 mb-3">
                    Riwayat Terbaru
                </h3>

                <div class="space-y-3">
                    @forelse ($notifikasi as $notif)
                                    <div class="flex items-start gap-3 p-3 rounded-xl {{ $notif['tipe'] === 'pelanggaran'
                        ? 'bg-red-50 border border-red-100'
                        : 'bg-yellow-50 border border-yellow-100' }}">

                                        <div class="mt-1">
                                            @if($notif['tipe'] === 'pelanggaran')
                                                <x-heroicon-o-exclamation-circle class="w-5 h-5 text-red-500" />
                                            @else
                                                <x-heroicon-o-check-circle class="w-5 h-5 text-yellow-500" />
                                            @endif
                                        </div>

                                        <div class="flex-1">
                                            <p class="text-sm font-semibold capitalize">
                                                {{ $notif['tipe'] }}
                                            </p>
                                            <p class="text-xs text-gray-600">
                                                {{ $notif['pesan'] }}
                                            </p>
                                            <p class="text-xs text-gray-400 mt-1">
                                                {{ $notif['tanggal'] }}
                                            </p>
                                        </div>
                                    </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">
                            Belum ada riwayat yang tercatat.
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
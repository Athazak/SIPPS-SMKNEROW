<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w-7xl mx-auto px-3 lg:px-4">
            <div
                class="rounded-2xl shadow-lg px-4 py-4 mb-3 flex items-center bg-gradient-to-r from-[#2A166F] to-[#0092DF] text-white">

                <!-- Text -->
                <div class="flex flex-col">
                    <p class="text-sm opacity-80 tracking-wide">Administrator</p>

                    <h2 class="text-2xl font-bold leading-tight">
                        Selamat Datang,
                        <span class="font-extrabold text-[#FFF601]">
                            {{ ucwords(strtolower(auth()->user()->nama)) }}
                        </span>
                    </h2>
                </div>
            </div>

            <!-- Kartu Statistik -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-3">
                <!-- Guru -->
                <div class="px-3 py-3 bg-[#2A166F] text-white rounded-xl shadow 
                flex items-center gap-3
                hover:scale-[1.04] hover:-translate-y-1 hover:shadow-lg 
                transition-all duration-200">
                    <div class="p-2 bg-white/20 rounded-lg">
                        <x-heroicon-o-user-group class="w-6 h-6" />
                    </div>
                    <div>
                        <p class="text-xs opacity-80">Guru</p>
                        <p class="text-lg font-bold">{{ $total['guru'] }}</p>
                    </div>
                </div>

                <!-- Siswa -->
                <div class="px-3 py-3 bg-[#0092DF] text-white rounded-xl shadow 
                flex items-center gap-3
                hover:scale-[1.04] hover:-translate-y-1 hover:shadow-lg 
                transition-all duration-200">
                    <div class="p-2 bg-white/20 rounded-lg">
                        <x-heroicon-o-academic-cap class="w-6 h-6" />
                    </div>
                    <div>
                        <p class="text-xs opacity-80">Siswa</p>
                        <p class="text-lg font-bold">{{ $total['siswa'] }}</p>
                    </div>
                </div>

                <!-- Pelanggaran -->
                <div class="px-3 py-3 bg-[#DB261D] text-white rounded-xl shadow
                flex items-center gap-3
                hover:scale-[1.04] hover:-translate-y-1 hover:shadow-lg 
                transition-all duration-200">
                    <div class="p-2 bg-white/20 rounded-lg">
                        <x-heroicon-o-exclamation-triangle class="w-6 h-6" />
                    </div>
                    <div>
                        <p class="text-xs opacity-80">Pelanggaran</p>
                        <p class="text-lg font-bold">{{ $total['pelanggaran'] }}</p>
                    </div>
                </div>

                <!-- Penghargaan -->
                <div class="px-3 py-3 bg-[#FFF601] text-black rounded-xl shadow 
                flex items-center gap-3
                hover:scale-[1.04] hover:-translate-y-1 hover:shadow-lg 
                transition-all duration-200">
                    <div class="p-2 bg-[#2A166F]/20 rounded-lg">
                        <x-heroicon-o-star class="w-6 h-6 text-black" />
                    </div>
                    <div>
                        <p class="text-xs text-black/70">Penghargaan</p>
                        <p class="text-lg font-bold">{{ $total['penghargaan'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Grafik -->
            <div class="bg-white px-4 py-3 rounded-2xl shadow overflow-x-auto mb-3">
                <h3 class="font-semibold text-gray-700 mb-3">Grafik Pelanggaran & Penghargaan per Bulan</h3>

                <div class="min-w-[600px] relative h-64 md:h-72">
                    <canvas id="chartPelanggaranPenghargaan"></canvas>
                </div>
            </div>

            <!-- Mini Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 mb-3">
                <!-- Pelanggaran Terbaru -->
                <div class="p-4 bg-white rounded-2xl shadow">
                    <h3 class="font-semibold text-gray-700 mb-3">
                        Pelanggaran Terbaru
                    </h3>

                    <div class="space-y-3">
                        @foreach ($pelanggaranTerbaru as $p)
                            <div
                                class="flex items-center justify-between p-3 rounded-xl border border-red-100 bg-red-50/40 hover:bg-red-50 transition-all duration-200 hover:shadow-sm hover:scale-[1.01]">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">{{ $p->siswa->user->nama }}</p>
                                    <p class="text-xs text-gray-600">{{ $p->pelanggaran->jenis_pelanggaran }}</p>
                                    <p class="text-xs text-gray-400">{{ $p->created_at->format('d M Y') }}</p>
                                </div>
                                <span class="px-2 py-1 bg-[#DB261D]/15 text-[#DB261D] text-xs font-medium rounded-md">
                                    Baru
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Penghargaan Terbaru -->
                <div class="p-4 bg-white rounded-2xl shadow">
                    <h3 class="font-semibold text-gray-700 mb-3">
                        Penghargaan Terbaru
                    </h3>

                    <div class="space-y-3">
                        @foreach ($penghargaanTerbaru as $p)
                            <div
                                class="flex items-center justify-between p-3 rounded-xl border border-yellow-100 bg-yellow-50/40 hover:bg-yellow-50 transition-all duration-200 hover:shadow-sm hover:scale-[1.01]">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">{{ $p->siswa->user->nama }}</p>
                                    <p class="text-xs text-gray-600">{{ $p->penghargaan->bentuk }}</p>
                                    <p class="text-xs text-gray-400">{{ $p->created_at->format('d M Y') }}</p>
                                </div>
                                <span class="px-2 py-1 bg-[#FFF601]/30 text-black text-xs font-medium rounded-md">
                                    Baru
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartPelanggaranPenghargaan');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($bulan),
            datasets: [
                {
                    label: 'Pelanggaran',
                    data: @json($pelanggaranChart),
                    borderWidth: 2,
                    borderColor: 'rgb(239, 68, 68)',
                    backgroundColor: 'rgba(239, 68, 68, 0.3)',
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: 'rgb(239, 68, 68)',
                },
                {
                    label: 'Penghargaan',
                    data: @json($penghargaanChart),
                    borderWidth: 2,
                    borderColor: 'rgb(234, 179, 8)',
                    backgroundColor: 'rgba(234, 179, 8, 0.3)',
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: 'rgb(234, 179, 8)',
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        font: { size: 12 },
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        autoSkip: false,
                        font: { size: 11 },
                    },
                    grid: { color: "rgba(0,0,0,0.05)" }
                },
                y: {
                    ticks: {
                        font: { size: 11 },
                    },
                    grid: { color: "rgba(0,0,0,0.05)" }
                }
            }
        }
    });
</script>
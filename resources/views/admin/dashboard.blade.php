<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow mb-6">
                <!-- Kartu Statistik -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                    <!-- Guru -->
                    <div
                        class="p-6 bg-green-500 dark:bg-green-700 text-white shadow rounded-xl hover:scale-105 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm opacity-80">Jumlah Guru</p>
                                <p class="text-3xl font-bold">{{ $total['guru'] }}</p>
                            </div>
                            <x-heroicon-o-user-group class="w-10 h-10 opacity-70" />
                        </div>
                    </div>

                    <!-- Siswa -->
                    <div
                        class="p-6 bg-blue-500 dark:bg-blue-700 text-white shadow rounded-xl hover:scale-105 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm opacity-80">Jumlah Siswa</p>
                                <p class="text-3xl font-bold">{{ $total['siswa'] }}</p>
                            </div>
                            <x-heroicon-o-academic-cap class="w-10 h-10 opacity-70" />
                        </div>
                    </div>

                    <!-- Rombel -->
                    <div
                        class="p-6 bg-indigo-500 dark:bg-indigo-700 text-white shadow rounded-xl hover:scale-105 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm opacity-80">Jumlah Rombel</p>
                                <p class="text-3xl font-bold">{{ $total['rombel'] }}</p>
                            </div>
                            <x-heroicon-o-building-office class="w-10 h-10 opacity-70" />
                        </div>
                    </div>

                    <!-- Pelanggaran -->
                    <div class="p-6 bg-red-500 dark:bg-red-700 text-white shadow rounded-xl hover:scale-105 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm opacity-80">Total Pelanggaran</p>
                                <p class="text-3xl font-bold">{{ $total['pelanggaran'] }}</p>
                            </div>
                            <x-heroicon-o-exclamation-triangle class="w-10 h-10 opacity-70" />
                        </div>
                    </div>

                    <!-- Penghargaan -->
                    <div
                        class="p-6 bg-yellow-500 dark:bg-yellow-600 text-white shadow rounded-xl hover:scale-105 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm opacity-80">Total Penghargaan</p>
                                <p class="text-3xl font-bold">{{ $total['penghargaan'] }}</p>
                            </div>
                            <x-heroicon-o-star class="w-10 h-10 opacity-70" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
                <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-200">
                    Grafik Pelanggaran & Penghargaan Tahun {{ date('Y') }}
                </h3>
                <canvas id="chartDashboard" height="100"></canvas>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('chartDashboard');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($bulanNama),
                    datasets: [
                        {
                            label: 'Pelanggaran',
                            data: @json($pelanggaranChart),
                            backgroundColor: 'rgba(239, 68, 68, 0.8)',
                        },
                        {
                            label: 'Penghargaan',
                            data: @json($penghargaanChart),
                            backgroundColor: 'rgba(234, 179, 8, 0.8)',
                        },
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#fff'
                            }
                        }
                    },
                    scales: {
                        x: {
                            ticks: { color: '#fff' },
                            grid: { color: 'rgba(255,255,255,0.1)' }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: { color: '#fff' },
                            grid: { color: 'rgba(255,255,255,0.1)' }
                        }
                    }
                }
            });
        </script>
    @endpush
</x-app-layout>
<div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
    <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">
        Filter Data Penghargaan
    </h3>

    <form method="GET" action="{{ route('admin.laporan.index') }}" class="grid md:grid-cols-4 gap-4">
        <input type="hidden" name="tab" value="penghargaan">

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dari Tanggal</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}"
                class="w-full mt-1 border-gray-300 rounded-lg shadow-sm dark:bg-gray-700 dark:text-gray-200">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sampai Tanggal</label>
            <input type="date" name="end_date" value="{{ request('end_date') }}"
                class="w-full mt-1 border-gray-300 rounded-lg shadow-sm dark:bg-gray-700 dark:text-gray-200">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rombel</label>
            <select name="rombel_id"
                class="w-full mt-1 border-gray-300 rounded-lg shadow-sm dark:bg-gray-700 dark:text-gray-200">
                <option value="">Semua</option>
                @foreach ($rombels as $rombel)
                    <option value="{{ $rombel->id }}" {{ request('rombel_id') == $rombel->id ? 'selected' : '' }}>
                        {{ $rombel->nama_rombel }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis</label>
            <select name="jenis"
                class="w-full mt-1 border-gray-300 rounded-lg shadow-sm dark:bg-gray-700 dark:text-gray-200">
                <option value="">Semua</option>
                <option value="Akademik" {{ request('jenis') == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                <option value="Non-Akademik" {{ request('jenis') == 'Non-Akademik' ? 'selected' : '' }}>Non-Akademik
                </option>
            </select>
        </div>

        <div class="md:col-span-4 flex justify-end gap-2 mt-4">
            <a href="{{ route('admin.laporan.index', ['tab' => 'penghargaan']) }}"
                class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400">Reset</a>
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Tampilkan</button>
        </div>
    </form>
</div>

<div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 mt-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Daftar Penghargaan
        </h3>
        <div>
            <a href="{{ route('admin.laporan.cetak', array_merge(request()->all(), ['tab' => 'penghargaan', 'format' => 'pdf'])) }}"
                class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">Cetak PDF</a>
            <a href="{{ route('admin.laporan.cetak', array_merge(request()->all(), ['tab' => 'penghargaan', 'format' => 'excel'])) }}"
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Export Excel</a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
            <thead class="bg-gray-200 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Nama Siswa</th>
                    <th class="px-4 py-2 border">Rombel</th>
                    <th class="px-4 py-2 border">Guru Pencatat</th>
                    <th class="px-4 py-2 border">Bentuk</th>
                    <th class="px-4 py-2 border text-center">Skor</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($catatanPenghargaans as $index => $item)
                    <tr class="border-b border-gray-300 dark:border-gray-700">
                        <td class="px-4 py-2">{{ $catatanPenghargaans->firstItem() + $index }}</td>
                        <td class="px-4 py-2">{{ $item->created_at->format('d-m-Y') }}</td>
                        <td class="px-4 py-2">{{ $item->siswa->user->nama }}</td>
                        <td class="px-4 py-2">{{ $item->siswa->rombel->nama_rombel }}</td>
                        <td class="px-4 py-2">{{ $item->guru->user->nama }}</td>
                        <td class="px-4 py-2">{{ $item->penghargaan->bentuk }}</td>
                        <td class="px-4 py-2 text-center text-green-600 font-semibold">{{ $item->penghargaan->skor }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">Tidak ada data ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $catatanPenghargaans->appends(['tab' => 'penghargaan'])->links() }}</div>
</div>
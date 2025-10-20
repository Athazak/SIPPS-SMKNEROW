<div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
    <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">
        Filter Data Pelanggaran
    </h3>

    <form method="GET" action="{{ route('admin.laporan.index') }}" class="grid md:grid-cols-4 gap-4">
        <input type="hidden" name="tab" value="pelanggaran">

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
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
            <select name="kategori"
                class="w-full mt-1 border-gray-300 rounded-lg shadow-sm dark:bg-gray-700 dark:text-gray-200">
                <option value="">Semua</option>
                <option value="Sikap perilaku" {{ request('kategori') == 'Sikap perilaku' ? 'selected' : '' }}>Sikap
                    perilaku</option>
                <option value="Kerapian" {{ request('kategori') == 'Kerapian' ? 'selected' : '' }}>Kerapian</option>
                <option value="Kerajinan" {{ request('kategori') == 'Kerajinan' ? 'selected' : '' }}>Kerajinan
                </option>
            </select>
        </div>

        <div class="md:col-span-4 flex justify-end gap-2 mt-4">
            <a href="{{ route('admin.laporan.index', ['tab' => 'pelanggaran']) }}"
                class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400">Reset</a>
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Tampilkan</button>
            <a href="{{ route('admin.laporan.cetak', array_merge(request()->all(), ['tab' => 'pelanggaran', 'format' => 'pdf'])) }}"
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Cetak PDF</a>
            <a href="{{ route('admin.laporan.cetak', array_merge(request()->all(), ['tab' => 'pelanggaran', 'format' => 'excel'])) }}"
                class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">Export Excel</a>
        </div>
    </form>
</div>

{{-- Tabel Data --}}
<div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 mt-6">
    <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">Data Pelanggaran</h3>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
            <thead class="bg-gray-200 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Nama Siswa</th>
                    <th class="px-4 py-2 border">Rombel</th>
                    <th class="px-4 py-2 border">Guru Pencatat</th>
                    <th class="px-4 py-2 border">Jenis</th>
                    <th class="px-4 py-2 border">Bentuk</th>
                    <th class="px-4 py-2 border text-center">Skor</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($catatanPelanggarans as $index => $item)
                    <tr class="border-b border-gray-300 dark:border-gray-700">
                        <td class="px-4 py-2">{{ $catatanPelanggarans->firstItem() + $index }}</td>
                        <td class="px-4 py-2">{{ $item->created_at->format('d-m-Y') }}</td>
                        <td class="px-4 py-2">{{ $item->siswa->user->nama }}</td>
                        <td class="px-4 py-2">{{ $item->siswa->rombel->nama_rombel }}</td>
                        <td class="px-4 py-2">{{ $item->guru->user->nama }}</td>
                        <td class="px-4 py-2">{{ $item->pelanggaran->jenis_pelanggaran }}</td>
                        <td class="px-4 py-2">{{ $item->pelanggaran->bentuk }}</td>
                        <td class="px-4 py-2 text-center font-semibold text-red-600">{{ $item->pelanggaran->skor }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">Tidak ada data ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $catatanPelanggarans->links() }}</div>
</div>
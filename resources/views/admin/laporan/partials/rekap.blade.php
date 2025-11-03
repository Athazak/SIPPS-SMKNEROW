<div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
    <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Filter Rekap</h3>

    <form method="GET" action="{{ route('admin.laporan.index') }}" class="grid md:grid-cols-3 gap-4">
        <input type="hidden" name="tab" value="rekap">

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

        <div class="md:col-span-3 flex justify-end gap-2 mt-4">
            <a href="{{ route('admin.laporan.index', ['tab' => 'rekap']) }}"
                class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400">Reset</a>
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Tampilkan</button>
        </div>
    </form>
</div>

<div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 mt-6">
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-4">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Daftar Pelanggaran
        </h3>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.laporan.cetak', array_merge(request()->all(), ['tab' => 'rekap', 'format' => 'pdf'])) }}"
                class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">Cetak PDF</a>
            <a href="{{ route('admin.laporan.cetak', array_merge(request()->all(), ['tab' => 'rekap', 'format' => 'excel'])) }}"
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Export Excel</a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
            <thead class="bg-gray-200 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Rombel</th>
                    <th class="px-4 py-2 border text-center">Pelanggaran</th>
                    <th class="px-4 py-2 border text-center">Penghargaan</th>
                    <th class="px-4 py-2 border text-center">Skor Akhir</th>
                    <th class="px-4 py-2 border text-center">Kategori</th>
                    <th class="px-4 py-2 border">Tindak Lanjut</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataRekap as $index => $item)
                    <tr class="border-b border-gray-300 dark:border-gray-700">
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $item['nama'] }}</td>
                        <td class="px-4 py-2">{{ $item['rombel'] }}</td>
                        <td class="px-4 py-2 text-center text-red-600 font-semibold">{{ $item['total_pelanggaran'] }}</td>
                        <td class="px-4 py-2 text-center text-green-600 font-semibold">{{ $item['total_penghargaan'] }}</td>
                        <td class="px-4 py-2 text-center font-bold">{{ $item['skor_akhir'] }}</td>
                        <td class="px-4 py-2 text-center capitalize">{{ $item['kategori'] }}</td>
                        <td class="px-4 py-2">{{ $item['penanganan'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">Tidak ada data ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $dataRekap->appends(['tab' => 'rekap'])->links() }}
    </div>
</div>
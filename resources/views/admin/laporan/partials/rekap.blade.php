{{-- ====================== FILTER CARD ====================== --}}
<div class="bg-white shadow rounded-xl px-4 py-3 mb-3 border border-gray-100">
    <div class="flex justify-between items-center mb-2">
        <h3 class="text-lg font-semibold text-gray-600">Filter Rekap</h3>
    </div>

    <form method="GET" action="{{ route('admin.laporan.index') }}" class="grid md:grid-cols-1 gap-4">
        <input type="hidden" name="tab" value="rekap">

        {{-- Rombel --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Rombel</label>
            <select name="rombel_id"
                class="w-full mt-1 border-gray-300 rounded-xl px-3 py-2 focus:ring-[#512AD5] focus:border-[#512AD5]">
                <option value="">Semua</option>
                @foreach ($rombels as $rombel)
                    <option value="{{ $rombel->id }}" {{ request('rombel_id') == $rombel->id ? 'selected' : '' }}>
                        {{ $rombel->nama_rombel }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="md:col-span-4 flex justify-end gap-3 ">
            <a href="{{ route('admin.laporan.index', ['tab' => 'rekap']) }}"
                class="px-4 py-2 rounded-xl bg-gray-300 hover:bg-gray-400">
                Reset
            </a>

            <button type="submit" class="px-4 py-2 rounded-xl bg-[#512AD5] hover:bg-[#2A166F] text-white transition">
                Tampilkan
            </button>
        </div>
    </form>
</div>

{{-- ====================== TABLE WRAPPER ====================== --}}
<div class="bg-white shadow rounded-xl px-4 py-3 mb-3 border border-gray-100">
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-2">
        <h3 class="text-lg font-semibold text-gray-600">Rekap
        </h3>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.laporan.cetak', array_merge(request()->all(), ['tab' => 'rekap', 'format' => 'pdf'])) }}"
                class="px-3 py-2 text-sm rounded-lg bg-[#D97706] hover:bg-[#b56504] text-white transition">Cetak PDF</a>
            <a href="{{ route('admin.laporan.cetak', array_merge(request()->all(), ['tab' => 'rekap', 'format' => 'excel'])) }}"
                class="px-3 py-2 text-sm rounded-lg bg-[#22A447] hover:bg-[#1c8a3c] text-white transition">Export
                Excel</a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <!-- Table Header -->
            <thead>
                <tr class="bg-[#F4F5FF] dark:bg-gray-700 text-[#2A166F] dark:text-gray-200 border-b">
                    <th class="px-4 py-3 font-semibold">No</th>
                    <th class="px-4 py-3 font-semibold">Nama</th>
                    <th class="px-4 py-3 font-semibold">Rombel</th>
                    <th class="px-4 py-3 font-semibold text-center">Pelanggaran</th>
                    <th class="px-4 py-3 font-semibold text-center">Penghargaan</th>
                    <th class="px-4 py-3 font-semibold text-center">Skor Akhir</th>
                    <th class="px-4 py-3 font-semibold text-center">Kategori</th>
                    <th class="px-4 py-3 font-semibold">Tindak Lanjut</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataRekap as $index => $item)
                    <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 font-medium">{{ $item['nama'] }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $item['rombel'] }}</td>
                        <td class="px-4 py-2 text-center">
                            <span class=" bg-[#FEE2E2] text-[#B91C1C] px-3 py-1 rounded-full text-xs font-semibold">
                                {{ $item['total_pelanggaran'] }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <span class="bg-[#FFF4D6] text-[#D97706] px-3 py-1 rounded-full text-xs font-semibold">
                                {{ $item['total_penghargaan'] }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <span
                                class="bg-gray-200 text-gray-800 px-3 py-1 rounded-full text-xs font-semibold">{{ $item['skor_akhir'] }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-center capitalize font-medium">{{ $item['kategori'] }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $item['penanganan'] }}</td>
                    </tr>
                @empty
                    <td colspan="5" class="py-5 text-center text-gray-500">
                        Tidak ada data ditemukan.
                    </td>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $dataRekap->appends(['tab' => 'rekap'])->links('vendor.pagination.simple-modern') }}
    </div>
</div>
{{-- ====================== FILTER CARD ====================== --}}
<div class="bg-white shadow rounded-xl px-4 py-3 mb-3 border border-gray-100">
    <div class="flex justify-between items-center mb-2">
        <h3 class="text-lg font-semibold text-gray-600">
            Filter Data Penghargaan
        </h3>
    </div>

    <form method="GET" action="{{ route('admin.laporan.index') }}" class="grid md:grid-cols-4 gap-4">
        <input type="hidden" name="tab" value="penghargaan">

        {{-- Tanggal Mulai --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Dari Tanggal</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}"
                class="w-full mt-1 border-gray-300 rounded-xl px-3 py-2 focus:ring-[#512AD5] focus:border-[#512AD5]">
        </div>

        {{-- Tanggal Akhir --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Sampai Tanggal</label>
            <input type="date" name="end_date" value="{{ request('end_date') }}"
                class="w-full mt-1 border-gray-300 rounded-xl px-3 py-2 focus:ring-[#512AD5] focus:border-[#512AD5]">
        </div>

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

        <div>
            <label class="block text-sm font-medium text-gray-700">Jenis</label>
            <select name="jenis"
                class="w-full mt-1 border-gray-300 rounded-xl px-3 py-2 focus:ring-[#512AD5] focus:border-[#512AD5]">
                <option value="">Semua</option>
                <option value="Akademik" {{ request('jenis') == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                <option value="Non-Akademik" {{ request('jenis') == 'Non-Akademik' ? 'selected' : '' }}>Non-Akademik
                </option>
            </select>
        </div>

        <div class="md:col-span-4 flex justify-end gap-3 ">
            <a href="{{ route('admin.laporan.index', ['tab' => 'penghargaan']) }}"
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
        <h3 class="text-lg font-semibold text-gray-600">Catatan Penghargaan
        </h3>

        <div class="flex sm:flex-row sm:items-center gap-2">
            <a href="{{ route('admin.laporan.cetak', array_merge(request()->all(), ['tab' => 'penghargaan', 'format' => 'pdf'])) }}"
                class="px-3 py-2 text-sm rounded-lg bg-[#D97706] hover:bg-[#b56504] text-white transition">Cetak PDF</a>
            <a href="{{ route('admin.laporan.cetak', array_merge(request()->all(), ['tab' => 'penghargaan', 'format' => 'excel'])) }}"
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
                    <th class="px-4 py-3 font-semibold">Tanggal</th>
                    <th class="px-4 py-3 font-semibold">Nama Siswa</th>
                    <th class="px-4 py-3 font-semibold">Rombel</th>
                    <th class="px-4 py-3 font-semibold">Guru Pencatat</th>
                    <th class="px-4 py-3 font-semibold">Bentuk</th>
                    <th class="px-4 py-3 font-semibold">Kriteria</th>
                    <th class="px-4 py-3 font-semibold text-center">Skor</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($catatanPenghargaans as $index => $item)
                    <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-4 py-2">{{ $catatanPenghargaans->firstItem() + $index }}</td>
                        <td class="px-4 py-2">{{ $item->created_at->format('d-m-Y') }}</td>
                        <td class="px-4 py-2 font-medium">{{ $item->siswa->user->nama }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $item->siswa->rombel->nama_rombel }}</td>
                        <td class="px-4 py-2">{{ $item->guru->user->nama }}</td>
                        <td class="px-4 py-2 font-medium">{{ $item->penghargaan->bentuk }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $item->penghargaan->kriteria }}</td>
                        <td class="px-4 py-2 text-center">
                            <span class="bg-[#FFF4D6] text-[#D97706] px-3 py-1 rounded-full text-xs font-semibold">
                                {{ $item->penghargaan->skor }}
                            </span>
                        </td>
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
        {{ $catatanPenghargaans->appends(['tab' => 'penghargaan'])->links('vendor.pagination.simple-modern') }}</div>
</div>
<table border="1" style="border-collapse: collapse; width:100%;">
    <thead>
        <tr style="background:#E0E7FF; font-weight:bold; text-align:center;">
            <th style="width:40px;">No</th>
            <th style="width:90px;">Tanggal</th>
            <th style="width:180px;">Nama Siswa</th>
            <th style="width:100px;">Rombel</th>
            <th style="width:160px;">Guru Pencatat</th>
            <th style="width:150px;">Jenis Pelanggaran</th>
            <th style="width:220px;">Bentuk Pelanggaran</th>
            <th style="width:60px;">Skor</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $i => $item)
            <tr>
                <td style="text-align:center;">{{ $i + 1 }}</td>
                <td>{{ $item->created_at?->format('d-m-Y') }}</td>
                <td>{{ $item->siswa->user->nama ?? '-' }}</td>
                <td>{{ $item->siswa->rombel->nama_rombel ?? '-' }}</td>
                <td>{{ $item->guru->user->nama ?? '-' }}</td>
                <td>{{ $item->pelanggaran->jenis_pelanggaran ?? '-' }}</td>
                <td>{{ $item->pelanggaran->bentuk ?? '-' }}</td>
                <td style="text-align:center; font-weight:bold;">
                    {{ $item->pelanggaran->skor ?? 0 }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
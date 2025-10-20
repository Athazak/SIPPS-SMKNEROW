<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Pelanggaran Siswa</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #eee;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Laporan Pelanggaran Siswa</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Siswa</th>
                <th>Rombel</th>
                <th>Guru Pencatat</th>
                <th>Jenis Pelanggaran</th>
                <th>Bentuk</th>
                <th>Skor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    <td>{{ $item->siswa->user->nama }}</td>
                    <td>{{ $item->siswa->rombel->nama_rombel ?? '-' }}</td>
                    <td>{{ $item->guru->user->nama }}</td>
                    <td>{{ $item->pelanggaran->jenis_pelanggaran }}</td>
                    <td>{{ $item->pelanggaran->bentuk }}</td>
                    <td>{{ $item->pelanggaran->skor }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
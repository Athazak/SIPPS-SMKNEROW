<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Rekap Skor Siswa</title>
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
    <h2 style="text-align: center;">Rekap Skor Siswa</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Rombel</th>
                <th>Skor Pelanggaran</th>
                <th>Skor Penghargaan</th>
                <th>Skor Akhir</th>
                <th>Kategori</th>
                <th>Tindak Lanjut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['rombel'] }}</td>
                    <td>{{ $item['total_pelanggaran'] }}</td>
                    <td>{{ $item['total_penghargaan'] }}</td>
                    <td>{{ $item['skor_akhir'] }}</td>
                    <td>{{ $item['kategori'] }}</td>
                    <td>{{ $item['penanganan'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
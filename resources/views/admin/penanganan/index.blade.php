@extends('layouts.admin')
@section('title','Penanganan Pelanggaran')

@section('content')
<a href="{{ route('admin.penanganan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Penanganan</a>

<table class="w-full mt-4 bg-white shadow">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2">#</th>
            <th>Kategori</th>
            <th>Skor Min</th>
            <th>Skor Max</th>
            <th>Tindak Lanjut</th>
            <th>Level</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $i => $row)
        <tr class="border-t">
            <td class="p-2">{{ $i+1 }}</td>
            <td>{{ ucfirst($row->kategori) }}</td>
            <td>{{ $row->skor_min }}</td>
            <td>{{ $row->skor_max }}</td>
            <td>{{ $row->tindak_lanjut }}</td>
            <td>{{ $row->level_penanganan }}</td>
            <td>
                <a href="{{ route('admin.penanganan.edit',$row->id) }}" class="text-blue-500">Edit</a> |
                <form method="POST" action="{{ route('admin.penanganan.destroy',$row->id) }}" class="inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Yakin hapus?')" class="text-red-500">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="p-2 text-center">Belum ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
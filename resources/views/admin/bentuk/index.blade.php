@extends('layouts.admin')
@section('title','Bentuk Pelanggaran')

@section('content')
<a href="{{ route('admin.bentuk.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Bentuk</a>

<table class="w-full mt-4 bg-white shadow">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2">#</th>
            <th>Jenis</th>
            <th>Bentuk</th>
            <th>Skor</th>
            <th>Sanksi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $i => $row)
        <tr class="border-t">
            <td class="p-2">{{ $i+1 }}</td>
            <td>{{ $row->jenis->nama_jenis }}</td>
            <td>{{ $row->bentuk }}</td>
            <td>{{ $row->skor }}</td>
            <td>{{ $row->sanksi }}</td>
            <td>
                <a href="{{ route('admin.bentuk.edit',$row->id) }}" class="text-blue-500">Edit</a> |
                <form method="POST" action="{{ route('admin.bentuk.destroy',$row->id) }}" class="inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Yakin hapus?')" class="text-red-500">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="p-2 text-center">Belum ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
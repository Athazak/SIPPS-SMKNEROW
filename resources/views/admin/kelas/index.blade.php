@extends('layouts.admin')
@section('title','Data Kelas')

@section('content')
<a href="{{ route('admin.kelas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Kelas</a>

<table class="w-full mt-4 bg-white shadow">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2">Nama Kelas</th>
            <th>Tingkat</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
        <tr class="border-t">
            <td class="p-2">{{ $row->nama_kelas }}</td>
            <td>{{ $row->tingkat }}</td>
            <td>{{ $row->jurusan }}</td>
            <td>
                <a href="{{ route('admin.kelas.edit',$row->id) }}" class="text-blue-500">Edit</a> |
                <form method="POST" action="{{ route('admin.kelas.destroy',$row->id) }}" class="inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Yakin hapus?')" class="text-red-500">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
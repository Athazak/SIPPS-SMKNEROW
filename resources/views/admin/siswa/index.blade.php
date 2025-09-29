@extends('layouts.admin')
@section('title','Data Siswa')

@section('content')
<a href="{{ route('admin.siswa.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Siswa</a>

<table class="w-full mt-4 bg-white shadow">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2">#</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $i => $row)
        <tr class="border-t">
            <td class="p-2">{{ $i+1 }}</td>
            <td>{{ $row->nis }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->kelas?->nama_kelas }}</td>
            <td>{{ $row->email }}</td>
            <td>
                <form method="POST" action="{{ route('admin.siswa.destroy',$row->id) }}" class="inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Yakin hapus siswa ini?')" class="text-red-500">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="p-2 text-center">Belum ada data siswa</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
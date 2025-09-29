@extends('layouts.admin')
@section('title','Tambah Siswa')

@section('content')
<form method="POST" action="{{ route('admin.siswa.store') }}" class="bg-white p-4 shadow rounded w-1/2">
    @csrf
    <div class="mb-3">
        <label class="block mb-1">NIS</label>
        <input type="text" name="nis" class="border p-2 w-full" required>
    </div>
    <div class="mb-3">
        <label class="block mb-1">Nama</label>
        <input type="text" name="name" class="border p-2 w-full" required>
    </div>
    <div class="mb-3">
        <label class="block mb-1">Email</label>
        <input type="email" name="email" class="border p-2 w-full" required>
    </div>
    <div class="mb-3">
        <label class="block mb-1">Kelas</label>
        <select name="kelas_id" class="border p-2 w-full" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach($kelas as $k)
            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="block mb-1">Password</label>
        <input type="password" name="password" class="border p-2 w-full" required>
    </div>
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    <a href="{{ route('admin.siswa.index') }}" class="ml-2 text-gray-600">Batal</a>
</form>
@endsection
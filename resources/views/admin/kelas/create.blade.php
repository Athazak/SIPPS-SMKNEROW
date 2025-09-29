@extends('layouts.admin')
@section('title','Tambah Kelas')

@section('content')
<form method="POST" action="{{ route('admin.kelas.store') }}" class="bg-white p-4 shadow rounded">
    @csrf
    <div class="mb-3">
        <label>Nama Kelas</label>
        <input type="text" name="nama_kelas" class="border p-2 w-full" required>
    </div>
    <div class="mb-3">
        <label>Tingkat</label>
        <input type="text" name="tingkat" class="border p-2 w-full">
    </div>
    <div class="mb-3">
        <label>Jurusan</label>
        <input type="text" name="jurusan" class="border p-2 w-full">
    </div>
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
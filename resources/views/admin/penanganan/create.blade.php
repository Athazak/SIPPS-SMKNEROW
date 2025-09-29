@extends('layouts.admin')
@section('title','Tambah Penanganan Pelanggaran')

@section('content')
<form method="POST" action="{{ route('admin.penanganan.store') }}" class="bg-white p-4 shadow rounded w-1/2">
    @csrf
    <div class="mb-3">
        <label class="block mb-1">Kategori</label>
        <select name="kategori" class="border p-2 w-full" required>
            <option value="ringan">Ringan</option>
            <option value="sedang">Sedang</option>
            <option value="berat">Berat</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="block mb-1">Skor Minimal</label>
        <input type="number" name="skor_min" class="border p-2 w-full" required>
    </div>
    <div class="mb-3">
        <label class="block mb-1">Skor Maksimal</label>
        <input type="number" name="skor_max" class="border p-2 w-full" required>
    </div>
    <div class="mb-3">
        <label class="block mb-1">Tindak Lanjut</label>
        <textarea name="tindak_lanjut" class="border p-2 w-full"></textarea>
    </div>
    <div class="mb-3">
        <label class="block mb-1">Level Penanganan</label>
        <input type="text" name="level_penanganan" class="border p-2 w-full">
    </div>
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    <a href="{{ route('admin.penanganan.index') }}" class="ml-2 text-gray-600">Batal</a>
</form>
@endsection
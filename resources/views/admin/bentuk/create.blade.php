@extends('layouts.admin')
@section('title','Tambah Bentuk Pelanggaran')

@section('content')
<form method="POST" action="{{ route('admin.bentuk.store') }}" class="bg-white p-4 shadow rounded w-1/2">
    @csrf
    <div class="mb-3">
        <label class="block mb-1">Jenis Pelanggaran</label>
        <select name="jenis_id" class="border p-2 w-full" required>
            <option value="">-- Pilih Jenis --</option>
            @foreach($jenis as $j)
            <option value="{{ $j->id }}">{{ $j->nama_jenis }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="block mb-1">Bentuk</label>
        <input type="text" name="bentuk" class="border p-2 w-full" required>
    </div>
    <div class="mb-3">
        <label class="block mb-1">Skor</label>
        <input type="number" name="skor" class="border p-2 w-full" required>
    </div>
    <div class="mb-3">
        <label class="block mb-1">Sanksi</label>
        <input type="text" name="sanksi" class="border p-2 w-full">
    </div>
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    <a href="{{ route('admin.bentuk.index') }}" class="ml-2 text-gray-600">Batal</a>
</form>
@endsection
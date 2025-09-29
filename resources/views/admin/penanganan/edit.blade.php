@extends('layouts.admin')
@section('title','Edit Penanganan Pelanggaran')

@section('content')
<form method="POST" action="{{ route('admin.penanganan.update',$penanganan->id) }}" class="bg-white p-4 shadow rounded w-1/2">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="block mb-1">Kategori</label>
        <select name="kategori" class="border p-2 w-full" required>
            <option value="ringan" @if($penanganan->kategori == 'ringan') selected @endif>Ringan</option>
            <option value="sedang" @if($penanganan->kategori == 'sedang') selected @endif>Sedang</option>
            <option value="berat" @if($penanganan->kategori == 'berat') selected @endif>Berat</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="block mb-1">Skor Minimal</label>
        <input type="number" name="skor_min" class="border p-2 w-full" value="{{ $penanganan->skor_min }}" required>
    </div>
    <div class="mb-3">
        <label class="block mb-1">Skor Maksimal</label>
        <input type="number" name="skor_max" class="border p-2 w-full" value="{{ $penanganan->skor_max }}" required>
    </div>
    <div class="mb-3">
        <label class="block mb-1">Tindak Lanjut</label>
        <textarea name="tindak_lanjut" class="border p-2 w-full">{{ $penanganan->tindak_lanjut }}</textarea>
    </div>
    <div class="mb-3">
        <label class="block mb-1">Level Penanganan</label>
        <input type="text" name="level_penanganan" class="border p-2 w-full" value="{{ $penanganan->level_penanganan }}">
    </div>
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    <a href="{{ route('admin.penanganan.index') }}" class="ml-2 text-gray-600">Batal</a>
</form>
@endsection
@extends('layouts.admin')
@section('title','Edit Penghargaan')

@section('content')
<form method="POST" action="{{ route('admin.penghargaan.update',$penghargaan->id) }}" class="bg-white p-4 shadow rounded w-1/2">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="block mb-1">Kategori</label>
        <select name="kategori" class="border p-2 w-full" required>
            <option value="akademik" @if($penghargaan->kategori == 'akademik') selected @endif>Akademik</option>
            <option value="organisasi" @if($penghargaan->kategori == 'organisasi') selected @endif>Organisasi</option>
            <option value="ketertiban" @if($penghargaan->kategori == 'ketertiban') selected @endif>Ketertiban</option>
            <option value="lainnya" @if($penghargaan->kategori == 'lainnya') selected @endif>Lainnya</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="block mb-1">Bentuk</label>
        <input type="text" name="bentuk" class="border p-2 w-full" value="{{ $penghargaan->bentuk }}" required>
    </div>
    <div class="mb-3">
        <label class="block mb-1">Kriteria</label>
        <textarea name="kriteria" class="border p-2 w-full">{{ $penghargaan->kriteria }}</textarea>
    </div>
    <div class="mb-3">
        <label class="block mb-1">Skor</label>
        <input type="number" name="skor" class="border p-2 w-full" value="{{ $penghargaan->skor }}" required>
    </div>
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    <a href="{{ route('admin.penghargaan.index') }}" class="ml-2 text-gray-600">Batal</a>
</form>
@endsection
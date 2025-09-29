@extends('layouts.admin')
@section('title','Edit Jenis Pelanggaran')

@section('content')
<form method="POST" action="{{ route('admin.jenis.update',$jeni->id) }}" class="bg-white p-4 shadow rounded w-1/2">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="block mb-1">Nama Jenis</label>
        <input type="text" name="nama_jenis" class="border p-2 w-full" value="{{ $jeni->nama_jenis }}" required>
    </div>
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    <a href="{{ route('admin.jenis.index') }}" class="ml-2 text-gray-600">Batal</a>
</form>
@endsection
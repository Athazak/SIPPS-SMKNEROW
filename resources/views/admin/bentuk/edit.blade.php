@extends('layouts.admin')
@section('title','Edit Bentuk Pelanggaran')

@section('content')
<form method="POST" action="{{ route('admin.bentuk.update',$bentuk->id) }}" class="bg-white p-4 shadow rounded w-1/2">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="block mb-1">Jenis Pelanggaran</label>
        <select name="jenis_id" class="border p-2 w-full" required>
            @foreach($jenis as $j)
            <option value="{{ $j->id }}" @if($bentuk->jenis_id == $j->id) selected @endif>
                {{ $j->nama_jenis }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="block mb-1">Bentuk</label>
        <input type="text" name="bentuk" class="border p-2 w-full" value="{{ $bentuk->bentuk }}" required>
    </div>
    <div class="mb-3">
        <label class="block mb-1">Skor</label>
        <input type="number" name="skor" class="border p-2 w-full" value="{{ $bentuk->skor }}" required>
    </div>
    <div class="mb-3">
        <label class="block mb-1">Sanksi</label>
        <input type="text" name="sanksi" class="border p-2 w-full" value="{{ $bentuk->sanksi }}">
    </div>
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    <a href="{{ route('admin.bentuk.index') }}" class="ml-2 text-gray-600">Batal</a>
</form>
@endsection
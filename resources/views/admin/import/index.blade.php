@extends('layouts.admin')
@section('title','Import Data')

@section('content')
<div class="grid grid-cols-2 gap-6">
    <div class="bg-white p-4 shadow rounded">
        <h2 class="font-semibold mb-2">Import Guru</h2>
        <form method="POST" action="{{ route('admin.import.guru') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="border p-2 w-full mb-2" required>
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Upload Guru</button>
        </form>
    </div>

    <div class="bg-white p-4 shadow rounded">
        <h2 class="font-semibold mb-2">Import Siswa</h2>
        <form method="POST" action="{{ route('admin.import.siswa') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="border p-2 w-full mb-2" required>
            <button class="bg-green-600 text-white px-4 py-2 rounded">Upload Siswa</button>
        </form>
    </div>
</div>
@endsection
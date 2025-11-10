@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Pemilih</h2>

    <form action="{{ route('data-pemilih.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="name" class="w-full border p-2 rounded" required>
        </div>
        <div class="mb-3">
            <label>NIM</label>
            <input type="text" name="nim" class="w-full border p-2 rounded" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded" required>
        </div>
        <div class="mb-3">
            <label>Fakultas</label>
            <input type="text" name="faculty" class="w-full border p-2 rounded">
        </div>
        <div class="mb-3">
            <label>Jurusan</label>
            <input type="text" name="major" class="w-full border p-2 rounded">
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="w-full border p-2 rounded" required>
        </div>
        <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
    </form>
</div>
@endsection

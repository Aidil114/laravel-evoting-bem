@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Admin</h2>
<a href="{{ route('data-admin.index') }}" class="text-sm text-blue-600 hover:underline mb-4 inline-block">← Kembali</a>

    <form action="{{ route('data-admin.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="w-full border p-2 rounded" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="w-full border p-2 rounded" required>
        </div>
        <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
    </form>
</div>
@endsection

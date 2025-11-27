@extends('layouts.app')

@section('title', 'Tambah Periode Voting')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-md shadow">
    <h3 class="text-xl font-bold mb-4">➕ Tambah Periode Voting</h3>

    <form action="{{ route('admin.periode.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Waktu Mulai</label>
            <input type="datetime-local" name="start_time" class="w-full p-2 border rounded" required>
            @error('start_time')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Waktu Selesai</label>
            <input type="datetime-local" name="end_time" class="w-full p-2 border rounded" required>
            @error('end_time')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
        <a href="{{ route('admin.periode.index') }}" class="ml-2 text-gray-600 hover:text-gray-900">Kembali</a>
    </form>
</div>
@endsection

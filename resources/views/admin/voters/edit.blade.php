@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Edit Pemilih</h2>

    <form action="{{ route('data-pemilih.update', $voter) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Lengkap</label>
        <input 
            type="text" 
            name="name" 
            value="{{ old('name', $voter->name) }}" 
            class="w-full border p-2 rounded @error('name') border-red-500 @enderror"
            required
        >
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label>NIM</label>
        <input 
            type="text" 
            name="nim" 
            value="{{ old('nim', $voter->nim) }}" 
            class="w-full border p-2 rounded @error('nim') border-red-500 @enderror"
            required
        >
        @error('nim')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input 
            type="email" 
            name="email" 
            value="{{ old('email', $voter->email) }}" 
            class="w-full border p-2 rounded @error('email') border-red-500 @enderror"
            required
        >
        @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label>Fakultas</label>
        <input 
            type="text" 
            name="faculty" 
            value="{{ old('faculty', $voter->faculty) }}" 
            class="w-full border p-2 rounded"
        >
    </div>

    <div class="mb-3">
        <label>Jurusan</label>
        <input 
            type="text" 
            name="major" 
            value="{{ old('major', $voter->major) }}" 
            class="w-full border p-2 rounded"
        >
    </div>

    <div class="mb-3">
        <label>Password (opsional)</label>
        <input 
            type="password" 
            name="password" 
            class="w-full border p-2 rounded"
        >
    </div>

    <button class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
        Update
    </button>
</form>

</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="p-6 bg-white shadow rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Daftar Kandidat</h2>
        <a href="{{ route('candidates.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            + Tambah Kandidat
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="min-w-full border text-sm text-gray-700">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-3 text-left">Foto</th>
                <th class="py-2 px-3 text-left">Nama</th>
                <th class="py-2 px-3 text-left">Visi</th>
                <th class="py-2 px-3 text-left">Misi</th>
                <th class="py-2 px-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($candidates as $candidate)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-3">
                        @if($candidate->photo)
                            <img src="{{ asset('storage/'.$candidate->photo) }}" class="w-12 h-12 rounded object-cover">
                        @else
                            <span class="text-gray-400 text-xs italic">Tidak ada foto</span>
                        @endif
                    </td>
                    <td class="py-2 px-3 font-semibold">{{ $candidate->name }}</td>
                    <td class="py-2 px-3">{{ Str::limit($candidate->visi, 50) }}</td>
                    <td class="py-2 px-3">{{ Str::limit($candidate->misi, 50) }}</td>
                    <td class="py-2 px-3 text-center">
                        <a href="{{ route('candidates.edit', $candidate) }}" class="text-blue-600 hover:underline">Edit</a> |
                        <form action="{{ route('candidates.destroy', $candidate) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kandidat ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-4 text-center text-gray-500">Belum ada kandidat.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

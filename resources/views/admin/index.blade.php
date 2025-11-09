@extends('layouts.app')

@section('content')
<div class="p-6 bg-white shadow rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Daftar Admin</h2>
        <a href="{{ route('data-admin.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">+ Tambah Admin</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-3">{{ session('success') }}</div>
    @endif

    <table class="min-w-full text-sm">
        <thead>
            <tr class="border-b">
                <th class="py-2 text-left">Nama</th>
                <th class="py-2 text-left">Email</th>
                <th class="py-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
                <tr class="border-b">
                    <td class="py-2">{{ $admin->name }}</td>
                    <td class="py-2">{{ $admin->email }}</td>
                    <td class="py-2 text-center">
                        <a href="{{ route('data-admin.edit', $admin) }}" class="text-blue-600 hover:underline">Edit</a> |
                        <form action="{{ route('data-admin.destroy', $admin) }}" method="POST" class="inline" onsubmit="return confirm('Hapus admin ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

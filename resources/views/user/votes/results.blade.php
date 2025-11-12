@extends('layouts.app')

@section('title', 'Hasil Voting')
@section('header', '📊 Hasil Voting')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6 text-center">📊 Hasil Voting Ketua BEM</h2>

    @if($candidates->isEmpty())
        <p class="text-center text-gray-500">Belum ada kandidat yang terdaftar.</p>
    @else
        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">No</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Nama Kandidat</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Visi</th>
                    <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Total Suara</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($candidates as $index => $candidate)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 font-semibold text-gray-800 flex items-center space-x-3">
                            @if($candidate->photo)
                                <img src="{{ asset('storage/' . $candidate->photo) }}" alt="Foto Kandidat"
                                     class="w-10 h-10 rounded-full object-cover">
                            @else
                                <span class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-500">?</span>
                            @endif
                            <span>{{ $candidate->name }}</span>
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-600">{{ $candidate->visi ?? '-' }}</td>
                        <td class="px-4 py-2 text-center text-sm font-bold text-blue-600">
                            {{ $candidate->votes_count }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

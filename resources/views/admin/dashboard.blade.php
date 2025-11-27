@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('header', 'Dashboard Admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">

    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-gray-600 text-sm font-medium">Total Kandidat</h3>
        <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalCandidates }}</p>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-gray-600 text-sm font-medium">Total Pemilih</h3>
        <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalVoters }}</p>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-gray-600 text-sm font-medium">Total Suara Masuk</h3>
        <p class="text-3xl font-bold text-purple-600 mt-2">{{ $totalVotes }}</p>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-gray-600 text-sm font-medium">Partisipasi Pemilih</h3>
        <p class="text-3xl font-bold text-orange-500 mt-2">{{ $percentageVoted }}%</p>
    </div>
</div>

<div class="mt-6 bg-white rounded-xl shadow p-6">
    <h3 class="text-gray-600 text-sm font-medium mb-2">Status Voting</h3>

    @if($activeVoting)
        <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full font-medium">
            🔔 Voting Sedang Berlangsung
        </span>
    @else
        <span class="px-4 py-2 bg-red-100 text-red-700 rounded-full font-medium">
            ⛔ Tidak Ada Voting Aktif
        </span>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('header', 'Dashboard Admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-gray-600 text-sm font-medium">Total Kandidat</h3>
        <p class="text-3xl font-bold text-blue-600 mt-2">4</p>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-gray-600 text-sm font-medium">Total Pemilih</h3>
        <p class="text-3xl font-bold text-green-600 mt-2">230</p>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-gray-600 text-sm font-medium">Voting Aktif</h3>
        <p class="text-3xl font-bold text-yellow-500 mt-2">Ya</p>
    </div>
</div>
@endsection

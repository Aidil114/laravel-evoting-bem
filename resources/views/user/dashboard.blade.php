@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')
@section('header', 'Dashboard Mahasiswa')

@section('content')
<div class="bg-white shadow rounded-xl p-6">
    <h2 class="text-xl font-bold mb-3">Selamat Datang, {{ Auth::user()->name }} 👋</h2>
    <p class="text-gray-600 mb-4">
        Silakan lihat daftar kandidat dan gunakan hak suara Anda.
    </p>
    <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        🗳️ Mulai Voting
    </a>
</div>
@endsection

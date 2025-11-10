@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')
@section('header', 'Dashboard Mahasiswa')

@section('content')
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    Selamat Datang, {{ Auth::user()->name }} 👋
                </h2>
                <p class="text-gray-600">
                    Pilih pemilihan yang ingin Anda ikuti dari daftar di bawah ini.
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm text-blue-800">{{ $totalKandidat }} kandidat tersedia</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100">
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $totalKandidat }}</p>
                    <p class="text-gray-600">Total Kandidat</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $totalSuara }}</p>
                    <p class="text-gray-600">Total Suara Masuk</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100">
                    <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-900">{{ $persentasePemilih }}%</p>
                    <p class="text-gray-600">Partisipasi Mahasiswa</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-orange-100">
                    <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    @if ($sudahVote)
                        <p class="text-2xl font-bold text-green-600">✅</p>
                        <p class="text-gray-600">Anda Sudah Vote</p>
                    @else
                        <p class="text-2xl font-bold text-red-600">❌</p>
                        <p class="text-gray-600">Belum Memilih</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Card Voting -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    <span class="w-2 h-2 bg-green-600 rounded-full mr-2 animate-pulse"></span>
                    Aktif
                </span>
                <span class="text-sm text-gray-500">Berakhir: 25 Des 2025</span>
            </div>

            <h3 class="text-xl font-bold text-gray-900 mb-2">Pemilihan Ketua BEM</h3>
            <p class="text-gray-600 mb-4">
                Pilih calon terbaik untuk masa depan BEM Universitas Riau!
            </p>

            @if (!$sudahVote)
                <a href="{{ route('vote.index') }}"
                   class="block w-full bg-blue-600 text-white text-center py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors duration-200">
                    🗳️ Vote Sekarang
                </a>
            @else
                <button disabled
                        class="block w-full bg-gray-300 text-gray-700 text-center py-3 rounded-lg font-medium cursor-not-allowed">
                    ✅ Anda Sudah Memilih
                </button>
            @endif
        </div>
    </div>
</main>

<footer class="bg-white border-t border-gray-200 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-center text-gray-600">
        © {{ date('Y') }} Sistem Voting Online Kampus. All rights reserved.
    </div>
</footer>
@endsection

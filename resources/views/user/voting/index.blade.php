@extends('layouts.app')

@section('title', 'Voting Sekarang')
@section('header', 'Voting Sekarang')

@section('content')
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">🗳️ Voting Ketua BEM</h2>
        <p class="text-gray-600">Pilih kandidat pilihanmu dengan bijak. Kamu hanya bisa memilih 1 kali!</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    @if($hasVoted)
        <div class="bg-green-50 border border-green-200 p-4 rounded text-center">
            <h3 class="text-lg font-semibold text-green-700">✅ Anda sudah memberikan suara!</h3>
            <p class="text-gray-600 mt-1">Terima kasih telah berpartisipasi dalam pemilihan ini.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($candidates as $candidate)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                <img src="{{ $candidate->photo ? asset('storage/'.$candidate->photo) : asset('images/default.png') }}"
                     alt="{{ $candidate->name }}" class="w-full h-56 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $candidate->name }}</h3>
                    <p class="text-gray-700 mb-2"><strong>Visi:</strong> {{ $candidate->visi }}</p>
                    <p class="text-gray-700 mb-4"><strong>Misi:</strong> {{ $candidate->misi }}</p>

                    <form action="{{ route('vote.store') }}" method="POST" onsubmit="return confirm('Yakin memilih {{ $candidate->name }}?')">
                        @csrf
                        <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                        <button type="submit"
                                class="w-full bg-blue-600 text-white py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                            Pilih Kandidat Ini
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</main>
@endsection

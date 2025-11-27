@extends('layouts.app')

@section('title', 'Voting Sekarang')
@section('header', 'Voting Sekarang')

@section('content')
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">🗳️ Voting Ketua BEM</h2>
        <p class="text-gray-600">Pilih kandidat pilihanmu dengan bijak. Kamu hanya bisa memilih 1 kali!</p>
    </div>

    {{-- Informasi Periode Voting --}}
    @if(isset($periode))
        <div class="bg-blue-50 border border-blue-300 text-blue-800 p-4 rounded-lg mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <p><strong>Periode Voting:</strong> {{ $periode->name ?? 'Periode' }}</p>
                    <p>Mulai: {{ \Carbon\Carbon::parse($periode->start_time)->format('d M Y H:i') }}</p>
                    <p>Berakhir: {{ \Carbon\Carbon::parse($periode->end_time)->format('d M Y H:i') }}</p>
                </div>
                <div class="text-right font-semibold" id="countdown"></div>
            </div>
        </div>

        <script>
            const endTime = new Date("{{ $periode->end_time }}").getTime();
            const countdownElement = document.getElementById('countdown');

            let countdownInterval = setInterval(() => {
                let now = new Date().getTime();
                let distance = endTime - now;

                if (distance < 0) {
                    clearInterval(countdownInterval);
                    countdownElement.innerHTML = "<span class='text-red-600'>⛔ Voting Telah Berakhir</span>";
                } else {
                    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    countdownElement.innerHTML = `
                        Sisa waktu: <br>
                        <span class="text-lg">${days} hari ${hours} jam ${minutes} menit ${seconds} detik</span>
                    `;
                }
            }, 1000);
        </script>
    @endif

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    @php
        $now = \Carbon\Carbon::now();
        $end_time = isset($periode) ? \Carbon\Carbon::parse($periode->end_time) : null;
    @endphp

    {{-- Cek apakah user sudah voting --}}
    @if($hasVoted)
        <div class="bg-green-50 border border-green-200 p-4 rounded text-center">
            <h3 class="text-lg font-semibold text-green-700">✅ Anda sudah memberikan suara!</h3>
            <p class="text-gray-600 mt-1">Terima kasih telah berpartisipasi dalam pemilihan ini.</p>
        </div>
    @elseif($now->gt($end_time))
        <div class="bg-red-50 border border-red-200 p-4 rounded text-center">
            <h3 class="text-lg font-semibold text-red-700">⛔ Voting telah berakhir.</h3>
            <p class="text-gray-600 mt-1">Terima kasih atas perhatian Anda.</p>
        </div>
    @else
        {{-- Daftar Kandidat --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($candidates as $candidate)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                <img src="{{ $candidate->photo ? asset('storage/'.$candidate->photo) : asset('images/default.png') }}"
                     alt="{{ $candidate->name }}" class="w-full h-56 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $candidate->name }}</h3>
                    <p class="text-gray-700 mb-2"><strong>Visi:</strong> {{ $candidate->visi }}</p>
                    <p class="text-gray-700 mb-4"><strong>Misi:</strong> {{ $candidate->misi }}</p>

                    <form action="{{ route('vote.store') }}" method="POST"
                          onsubmit="return confirm('Yakin memilih {{ $candidate->name }}?')">
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

@extends('layouts.app')

@section('title', 'Hasil Voting')
@section('header', '📊 Hasil Voting')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Hasil Voting Kandidat</h2>

    <!-- Statistik Ringkas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-blue-50 p-4 rounded-lg text-center">
            <p class="text-gray-600 text-sm">Total Kandidat</p>
            <h3 class="text-2xl font-bold text-blue-700">{{ $candidates->count() }}</h3>
        </div>
        <div class="bg-green-50 p-4 rounded-lg text-center">
            <p class="text-gray-600 text-sm">Total Suara Masuk</p>
            <h3 class="text-2xl font-bold text-green-700">{{ $totalVotes }}</h3>
        </div>
        <div class="bg-yellow-50 p-4 rounded-lg text-center">
            <p class="text-gray-600 text-sm">Persentase Partisipasi</p>
            <h3 class="text-2xl font-bold text-yellow-700">
                {{ $totalVotes > 0 ? round(($totalVotes / max(1, $candidates->count() * 100)) * 100, 2) : 0 }}%
            </h3>
        </div>
    </div>

    <!-- Tabel Daftar Kandidat -->
    <table class="min-w-full border text-sm text-gray-700 mb-8">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-3 text-left">Kandidat</th>
                <th class="py-2 px-3 text-left">Jumlah Suara</th>
                <th class="py-2 px-3 text-left">Persentase</th>
            </tr>
        </thead>
        <tbody>
            @foreach($candidates as $candidate)
                @php
                    $percentage = $totalVotes > 0
                        ? round(($candidate->votes_count / $totalVotes) * 100, 2)
                        : 0;
                @endphp
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-3 font-semibold flex items-center space-x-3">
                        @if($candidate->photo)
                            <img src="{{ asset('storage/'.$candidate->photo) }}" class="w-10 h-10 rounded object-cover">
                        @endif
                        <span>{{ $candidate->name }}</span>
                    </td>
                    <td class="py-2 px-3">{{ $candidate->votes_count }}</td>
                    <td class="py-2 px-3">{{ $percentage }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Chart.js Grafik -->
    <div>
        <canvas id="voteChart" height="120"></canvas>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('voteChart');
    const voteChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($candidates->pluck('name')),
            datasets: [{
                label: 'Jumlah Suara',
                data: @json($candidates->pluck('votes_count')),
                backgroundColor: [
                    '#3b82f6',
                    '#10b981',
                    '#f59e0b',
                    '#ef4444',
                    '#8b5cf6'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Jumlah Suara' }
                }
            }
        }
    });
</script>
@endsection

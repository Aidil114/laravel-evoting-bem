<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vote;
use App\Models\Candidate;
use App\Models\PeriodeVoting;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalCandidates = Candidate::count();
        $totalVotes = Vote::count();
        $totalVoters = User::where('role', 'user')->count();

        $percentageVoted = $totalVoters > 0
            ? round(($totalVotes / $totalVoters) * 100, 1)
            : 0;

        $now = Carbon::now();

        // Cek apakah periode voting sedang aktif
        $activeVoting = PeriodeVoting::where('start_time', '<=', $now)
                        ->where('end_time', '>=', $now)
                        ->exists();

        return view('admin.dashboard', compact(
            'totalCandidates',
            'totalVotes',
            'totalVoters',
            'percentageVoted',
            'activeVoting'
        ));
    }
}
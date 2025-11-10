<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vote;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalKandidat = Candidate::count();
        $totalSuara = Vote::count();
        $totalPemilih = User::where('role', 'user')->count();

        $persentasePemilih = $totalPemilih > 0 ? round(($totalSuara / $totalPemilih) * 100, 1) : 0;
        $sudahVote = Vote::where('user_id', $user->id)->exists();

        return view('user.dashboard', compact(
            'totalKandidat', 'totalSuara', 'persentasePemilih', 'sudahVote'
        ));
    }
}
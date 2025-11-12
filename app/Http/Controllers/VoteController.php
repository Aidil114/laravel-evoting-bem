<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    /**
     * Halaman Voting
     */
    public function index()
    {
        // Cek apakah user sudah melakukan voting
        $hasVoted = Vote::where('user_id', Auth::id())->exists();
        $candidates = Candidate::all();

        return view('user.voting.index', compact('candidates', 'hasVoted'));
    }

    /**
     * Simpan hasil voting user
     */
    public function store(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        // Cegah vote ganda
        if (Vote::where('user_id', Auth::id())->exists()) {
            return redirect()->route('vote.index')->with('error', 'Anda sudah melakukan voting.');
        }

        // Simpan suara
        Vote::create([
            'user_id' => Auth::id(),
            'candidate_id' => $request->candidate_id,
            'voted_at' => now(),
        ]);

        return redirect()->route('vote.index')->with('success', 'Terima kasih, suara Anda telah tersimpan!');
    }

    /**
     * Tampilkan hasil voting (untuk admin & user)
     */
    public function results()
    {
        // Ambil semua kandidat beserta jumlah suaranya
        $candidates = Candidate::withCount('votes')->get();
        $totalVotes = Vote::count();

        // Tentukan view berdasarkan role pengguna
        if (Auth::user()->role === 'admin') {
            return view('admin.votes.results', compact('candidates', 'totalVotes'));
        } else {
            return view('user.votes.results', compact('candidates', 'totalVotes'));
        }
    }
}
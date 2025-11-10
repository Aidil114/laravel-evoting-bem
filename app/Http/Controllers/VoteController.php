<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function index()
    {
        // Cek apakah user sudah vote
        $hasVoted = Vote::where('user_id', Auth::id())->exists();
        $candidates = Candidate::all();

        return view('user.voting.index', compact('candidates', 'hasVoted'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        // Pastikan user hanya bisa vote 1 kali
        if (Vote::where('user_id', Auth::id())->exists()) {
            return redirect()->route('vote.index')->with('error', 'Anda sudah melakukan voting.');
        }

        Vote::create([
            'user_id' => Auth::id(),
            'candidate_id' => $request->candidate_id,
            'voted_at' => now(),
        ]);

        return redirect()->route('vote.index')->with('success', 'Terima kasih, suara Anda telah tersimpan!');
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PeriodeVoting;
use Carbon\Carbon;

class CheckVotingPeriod
{
    public function handle(Request $request, Closure $next)
    {
        // Ambil periode aktif (asumsi hanya ada satu periode aktif)
        $periode = PeriodeVoting::orderBy('start_time', 'desc')->first();

        if (!$periode) {
            return redirect()->route('vote.index')->with('error', 'Belum ada periode voting yang diatur.');
        }

        $now = Carbon::now();

        if ($now->lt(Carbon::parse($periode->start_time))) {
            return redirect()->route('vote.index')->with('error', 'Voting belum dimulai.');
        }

        if ($now->gt(Carbon::parse($periode->end_time))) {
            return redirect()->route('vote.index')->with('error', 'Voting telah berakhir.');
        }

        // Voting dalam rentang waktu berlaku → lanjutkan
        return $next($request);
    }
}
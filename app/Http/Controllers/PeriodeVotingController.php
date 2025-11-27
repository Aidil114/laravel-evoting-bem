<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\PeriodeVoting;
use Illuminate\Http\Request;

class PeriodeVotingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan daftar periode dengan urutan terbaru
        $periodes = PeriodeVoting::orderBy('start_time', 'desc')->get();

        return view('admin.periode.index', compact('periodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.periode.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        PeriodeVoting::create([
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('admin.periode.index')->with('success', 'Periode voting berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PeriodeVoting $periode)
    {
        return view('admin.periode.edit', compact('periode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PeriodeVoting $periode)
    {
        $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $periode->update([
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('admin.periode.index')->with('success', 'Periode voting berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PeriodeVoting $periode)
    {
        $periode->delete();

        return redirect()->route('admin.periode.index')->with('success', 'Periode voting berhasil dihapus.');
    }
}
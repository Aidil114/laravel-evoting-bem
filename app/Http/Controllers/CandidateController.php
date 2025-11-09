<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::all();
        return view('admin.candidates.index', compact('candidates'));
    }

    public function create()
    {
        return view('admin.candidates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
        ]);

        $path = null;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('candidates', 'public');
        }

        Candidate::create([
            'name' => $request->name,
            'photo' => $path,
            'visi' => $request->visi,
            'misi' => $request->misi,
        ]);

        return redirect()->route('candidates.index')->with('success', 'Kandidat berhasil ditambahkan!');
    }

    public function edit(Candidate $candidate)
    {
        return view('admin.candidates.edit', compact('candidate'));
    }

    public function update(Request $request, Candidate $candidate)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
        ]);

        $path = $candidate->photo;
        if ($request->hasFile('photo')) {
            if ($candidate->photo) {
                Storage::disk('public')->delete($candidate->photo);
            }
            $path = $request->file('photo')->store('candidates', 'public');
        }

        $candidate->update([
            'name' => $request->name,
            'photo' => $path,
            'visi' => $request->visi,
            'misi' => $request->misi,
        ]);

        return redirect()->route('candidates.index')->with('success', 'Kandidat berhasil diperbarui!');
    }

    public function destroy(Candidate $candidate)
    {
        if ($candidate->photo) {
            Storage::disk('public')->delete($candidate->photo);
        }
        $candidate->delete();

        return redirect()->route('candidates.index')->with('success', 'Kandidat berhasil dihapus!');
    }
}
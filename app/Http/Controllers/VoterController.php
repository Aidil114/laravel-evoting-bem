<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VoterController extends Controller
{
    public function index()
    {
        $voters = User::where('role', 'user')->get();
        return view('admin.voters.index', compact('voters'));
    }

    public function create()
    {
        return view('admin.voters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:users',
            'email' => 'required|email|unique:users',
            'faculty' => 'nullable|string',
            'major' => 'nullable|string',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'faculty' => $request->faculty,
            'major' => $request->major,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect()->route('data-pemilih.index')->with('success', 'Data pemilih berhasil ditambahkan!');
    }

    public function edit(User $data_pemilih)
    {
        return view('admin.voters.edit', ['voter' => $data_pemilih]);
    }

    public function update(Request $request, User $data_pemilih)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:users,nim,' . $data_pemilih->id,
            'email' => 'required|email|unique:users,email,' . $data_pemilih->id,
            'faculty' => 'nullable|string',
            'major' => 'nullable|string',
        ]);

        $data_pemilih->update([
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'faculty' => $request->faculty,
            'major' => $request->major,
            'password' => $request->password
                ? Hash::make($request->password)
                : $data_pemilih->password,
        ]);

        return redirect()->route('data-pemilih.index')->with('success', 'Data pemilih berhasil diperbarui!');
    }

    public function destroy(User $data_pemilih)
    {
        $data_pemilih->delete();
        return redirect()->route('data-pemilih.index')->with('success', 'Data pemilih berhasil dihapus!');
    }
}
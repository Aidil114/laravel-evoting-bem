<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\VoterController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login');
});

// =======================
// ROUTE UNTUK ADMIN
// =======================
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // CRUD Admin Management
    Route::resource('/data-admin', AdminController::class);
    Route::resource('/candidates', CandidateController::class); // ✅ CRUD kandidat
    Route::resource('/data-pemilih', VoterController::class);
});

// =======================
// ROUTE UNTUK MAHASISWA / PEMILIH
// =======================

Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    // Dashboard mahasiswa (dinamis dari controller)
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Fitur Voting
    Route::get('/voting', [VoteController::class, 'index'])->name('vote.index');
    Route::post('/voting', [VoteController::class, 'store'])->name('vote.store');
});

// =======================
// PROFILE USER (BISA DIAKSES OLEH KEDUA ROLE)
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
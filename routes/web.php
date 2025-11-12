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
    Route::resource('/candidates', CandidateController::class);
    Route::resource('/data-pemilih', VoterController::class);

    // ✅ Hasil Voting (khusus admin)
    Route::get('/hasil-voting', [VoteController::class, 'results'])->name('admin.votes.results');
});

// =======================
// ROUTE UNTUK MAHASISWA / PEMILIH
// =======================
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Fitur Voting
    Route::get('/voting', [VoteController::class, 'index'])->name('vote.index');
    Route::post('/voting', [VoteController::class, 'store'])->name('vote.store');

    // ✅ Hasil Voting (khusus user)
    Route::get('/hasil-voting', [VoteController::class, 'results'])->name('vote.results');
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
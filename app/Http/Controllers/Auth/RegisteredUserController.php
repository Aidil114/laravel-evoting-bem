<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
          $request->validate([
        'fullname' => ['required', 'string', 'max:255'],
        'nim' => ['required', 'string', 'max:20', 'unique:users'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'faculty' => ['required', 'string', 'max:255'],
        'major' => ['required', 'string', 'max:255'],
        'password' => ['required', 'confirmed', 'min:8'],
    ]);

    $user = User::create([
        'fullname' => $request->fullname,
        'nim' => $request->nim,
        'email' => $request->email,
        'faculty' => $request->faculty,
        'major' => $request->major,
        'password' => Hash::make($request->password),
    ]);

    event(new Registered($user));

    Auth::login($user);

     return redirect()->route('dashboard');
    }
}
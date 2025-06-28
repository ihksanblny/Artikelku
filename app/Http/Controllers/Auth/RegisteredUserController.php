<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
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
    // Hapus baris debug di bawah ini (jika belum dihapus)
    // dd($request->all());

    $request->validate([
        'username' => ['required', 'string', 'max:255', 'unique:users'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'role' => ['required', 'in:admin,editor,writer,reader'],
        'bio' => ['nullable', 'string', 'max:1000'],
        'avatar' => ['nullable', 'image', 'max:2048'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    // Simpan file avatar jika ada
    $avatarPath = null;
    if ($request->hasFile('avatar')) {
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
    }

    $user = User::create([
        'username' => $request->username,
        'email' => $request->email,
        'role' => $request->role,
        'bio' => $request->bio,
        'avatar' => $avatarPath,
        'password' => Hash::make($request->password),
    ]);

    event(new Registered($user));
    Auth::login($user);

    return redirect()->intended(RouteServiceProvider::HOME);
}

}

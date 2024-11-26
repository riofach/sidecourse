<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'occupation' => ['required', 'string', 'max:255'],
            'avatar' => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        //proses upload file avatar
        //variable avatarpath apa bila ada request file dari avatar akan disimpan folder avatars dan public
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        } else {
            $avatarPath = 'images/avatar-default.png';
        }

        $user = User::create([
            'name' => $request->name,
            'occupation' => $request->occupation,
            'avatar' => $avatarPath,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //ctrl tahan + klik di registered dan click 2x pada class
        //setting register student
        event(new Registered($user));
        $user->assignRole('student');
        Auth::login($user);

        // return redirect(route('dashboard', absolute: false));
        return redirect()->route('dashboard');
    }
}
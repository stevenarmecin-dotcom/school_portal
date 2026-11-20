<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $userData = $request->validate([
            'name' => ['required', 'string'],
            'username' => ['required', 'string', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
        ]);

        $userData['password'] = bcrypt($userData['password']);

        $user = User::create($userData);
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }
}
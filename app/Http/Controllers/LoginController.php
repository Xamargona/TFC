<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('inicio');
        }

        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
        ]);

        $user = new User([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->get('password')),
            'role' => 'user',
        ]);

        $user->save();

        Auth::login($user);

        return redirect()->route('inicio');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('inicio');
        }

        $credenciales = $request->only('username', 'password');

        if (Auth::guard('web')->attempt($credenciales)) {
            $request->session()->regenerateToken();
            return redirect()->route('inicio');
        }

        $credenciales = [
            'email' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (Auth::guard('web')->attempt($credenciales)) {
            $request->session()->regenerateToken();
            return redirect()->route('inicio');
        }

        return redirect()->back()->withErrors([
            'error' => 'Las credenciales proporcionadas no són correctas.',
        ]);
    }

    public function logout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        Auth::guard('web')->logout();
        return redirect()->route('inicio');
    }

}

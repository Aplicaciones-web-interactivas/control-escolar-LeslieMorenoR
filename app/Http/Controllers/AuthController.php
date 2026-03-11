<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Procesar login
    public function login(Request $request)
    {
        $request->validate([
            'user_key' => 'required|string',
            'pass'     => 'required|string',
        ]);

        $user = User::where('institutional_key', $request->user_key)->first();

        if (!$user || !Hash::check($request->pass, $user->password)) {
            return back()->withErrors([
                'user_key' => 'Las credenciales no son correctas.',
            ]);
        }

        if (!$user->is_activate) {
            return back()->withErrors([
                'user_key' => 'Usuario desactivado.',
            ]);
        }

        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
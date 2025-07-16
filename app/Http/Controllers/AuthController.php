<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function ShowFormLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $login = $request->input('login');
        $password = $request->input('password');

        // Cek apakah yang dimasukkan adalah email atau NIP
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nip';

        if (Auth::attempt([$fieldType => $login, 'password' => $password])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'Login gagal. Silakan periksa kembali email/NIP dan kata sandi Anda.');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // keluarin user
        $request->session()->invalidate(); // hapus session
        $request->session()->regenerateToken(); // buat CSRF token baru

        return redirect('/login'); // arahkan ke halaman login
    }
}

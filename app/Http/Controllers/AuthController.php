<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function processLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Meningkatkan keamanan sesi

            $user = Auth::user();

            // Periksa role dan redirect sesuai role
            if (strtolower($user->role) === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin!');
            } elseif (strtolower($user->role) === 'siswa') {
                return redirect()->route('home')->with('success', 'Selamat datang, Siswa!');
            }


            // Jika role tidak dikenali, logout user
            Auth::logout();
            return redirect()->route('login')->with('error', 'Role tidak dikenali.');
        }

        // Jika login gagal
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }

}

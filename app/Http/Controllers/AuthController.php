<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ===================== FORM LOGIN =====================
    public function loginForm()
    {
        return view('auth.login');
    }

    // ===================== PROSES LOGIN =====================
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Coba login
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            // Regenerate session (keamanan)
            $request->session()->regenerate();

            // Ambil data user yang login
            $user = Auth::user();

            // 🔥 CEK PERAN (INI KUNCI PEMBEDA ADMIN & PETANI)
            if ($user->peran === 'admin') {
                return redirect('/admin/dashboard')
                    ->with('success', 'Selamat datang Admin 👋');
            }

            // Jika petani
            return redirect()->route('home')
                ->with('success', 'Selamat datang, ' . $user->nama . ' 👋');
        }

        // Jika login gagal
        return back()->with('error', 'Email atau password salah');
    }

    // ===================== FORM REGISTER =====================
    public function registerForm()
    {
        return view('auth.register');
    }

    // ===================== PROSES REGISTER =====================
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:pengguna',
            'password' => 'required|confirmed|min:6'
        ]);

        Pengguna::create([
            'nama' => $request->name,
            'email' => $request->email,
            'kata_sandi' => Hash::make($request->password),
            'peran' => 'petani' // default petani
        ]);

        return redirect()->route('login')
            ->with('success', 'Akun berhasil dibuat');
    }

    // ===================== LOGOUT =====================
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Menampilkan form registrasi.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Proses data registrasi.
     */
    public function register(Request $request)
    {
        // 🔍 Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        // 🧩 Simpan user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            // Tetap gunakan Hash::make() meskipun ada cast,
            // agar tetap aman dan eksplisit
            'password' => Hash::make($request->password),
        ]);

        // 🔐 Login otomatis setelah registrasi
        Auth::login($user);

        // 🚀 Redirect ke halaman home dengan notifikasi
        return redirect()->route('home')->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name . ' 🎉');
    }
}

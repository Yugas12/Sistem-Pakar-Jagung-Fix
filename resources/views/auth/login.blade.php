@extends('layouts.app')

@section('title', 'Login')

@section('content')

<!-- Hero Login Section -->
        <h2 class="text-center mb-4 fw-bold" style="color:#F2720C;">
            Selamat datang kembali di Sistem Pakar Jagung Hibrida 🌽
        </h2>

        <p class="text-center mb-5" style="font-size:1.1rem; color:#666; line-height:1.6;">
            Yuk masuk ke sistem untuk memantau kondisi jagung dan temukan solusi terbaik untuk hasil panen yang maksimal. <br>
            Melalui sistem ini, dapat mempermudah mengidentifikasi penyakit yang menyerang tanaman jagung dan mengetahui jenis penyakit yang menyerang tanaman jagung. <br>
            Bersama teknologi dan petani cerdas, mari wujudkan pertanian jagung yang lebih produktif, efisien, dan berkelanjutan.
        </p>

<!-- Form Login -->
<section class="py-5" style="background-color:#FFF7E0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm rounded-4 p-4">
                    <h3 class="fw-bold text-center mb-4" style="color:#F2720C;">Login</h3>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control rounded-3" id="email" name="email" 
                                   placeholder="Masukkan email Anda" required autofocus>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control rounded-3" id="password" name="password" 
                                   placeholder="Masukkan password" required>
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                Ingat Saya
                            </label>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn" 
                                style="background-color:#4CAF50; color:white; font-weight:600; border-radius:8px; padding:0.6rem 0;">
                                Masuk
                            </button>
                        </div>

                        <p class="text-center mt-3 mb-0" style="font-size:0.9rem; color:#555;">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" style="color:#F2720C; font-weight:600;">Daftar di sini</a>
                        </p>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@extends('layouts.app')

@section('title', 'Register')

@section('content')

<!-- Hero Register Section -->
        <h2 class="text-center mb-4 fw-bold" style="color:#F2720C;">
            Daftar Akun Baru Sistem Pakar Penyakit Jagung Hibrida 🌽
        </h2>

        <p class="text-center mb-5" style="font-size:1.1rem; color:#666; line-height:1.6;">
            Buat akun Anda untuk mulai menggunakan sistem pakar dan melakukan diagnosis penyakit jagung secara mudah.
        </p>

<!-- Form Register -->
<section class="py-5" style="background-color:#FFF7E0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm rounded-4 p-4">
                    <h3 class="fw-bold text-center mb-4" style="color:#F2720C;">Register</h3>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" class="form-control rounded-3" id="name" name="name"
                                   placeholder="Masukkan nama lengkap Anda" required autofocus>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control rounded-3" id="email" name="email"
                                   placeholder="Masukkan email Anda" required>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control rounded-3" id="password" name="password"
                                   placeholder="Masukkan password" required>
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                            <input type="password" class="form-control rounded-3" id="password_confirmation" name="password_confirmation"
                                   placeholder="Ulangi password Anda" required>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn"
                                style="background-color:#4CAF50; color:white; font-weight:600; border-radius:8px; padding:0.6rem 0;">
                                Daftar Sekarang
                            </button>
                        </div>

                        <p class="text-center mt-3 mb-0" style="font-size:0.9rem; color:#555;">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" style="color:#F2720C; font-weight:600;">Masuk di sini</a>
                        </p>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

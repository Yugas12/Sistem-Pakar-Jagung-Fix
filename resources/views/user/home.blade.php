@extends('layouts.app')

@section('title', 'Home')

@section('content')

<!-- Hero Section -->
<section class="hero text-white py-5" 
    style="background-color:#F2720C;">
    <div class="container py-5 text-center">
        <h1 class="fw-bold mb-3" style="font-size:2.3rem;">
            Selamat Datang di Sistem Pakar Penyakit Jagung Hibrida
        </h1>
        <p class="lead mb-4" style="color:#fff9f0;">
            Aplikasi berbasis web untuk membantu petani mendiagnosis penyakit tanaman jagung Hibrida. 
            <strong></strong>
        </p>
        <a href="{{ route('diagnosis') }}" 
        class="btn me-2 px-4 py-2" 
        style="background-color:#FFA726; color:white; font-weight:600; border-radius:8px;">
        Mulai Diagnosis
        </a>
    </div>
</section>

<!-- Tentang Sistem Pakar -->
<section class="py-5 bg-white">
    <div class="container text-center">
        <div class="row align-items-center">
            <!-- Gambar -->
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="{{ asset('images/petani_jagung.png') }}" 
                     alt="Petani Jagung" 
                     class="img-fluid rounded-4 shadow">
            </div>

            <!-- Teks -->
            <div class="col-md-6 text-start ps-md-5">
                <h3 class="fw-bold mb-3" style="color:#073B4C;">Mengapa Sistem Ini Penting?</h3>
                <p class="text-muted" style="font-size:1.05rem;">
                    Sistem Pakar ini dirancang untuk membantu petani mengenali gejala penyakit pada tanaman jagung 
                    secara cepat dan akurat. Dengan teknologi <strong>Forward Chaining</strong>, sistem memberikan 
                    solusi berdasarkan data gejala yang dimasukkan.
                </p>
            </div>
        </div>
    </div>
</section>


<!-- Fitur Utama -->
<section class="py-5" style="background-color:#FFF7E0;">
    <div class="container text-center">
        <h3 class="fw-bold mb-4" style="color:#073B4C;">Fitur Unggulan Kami</h3>
        <div class="row justify-content-center g-4">
            <!-- Kartu 1 -->
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <div style="font-size:2rem;">📈</div>
                    <h5 class="mt-3 fw-bold">Tingkat Keberhasilan Sistem</h5>
                    <p class="text-muted mb-0">Sistem mampu memberikan hasil diagnosa yang sesuai dengan aturan pengetahuan.</p>
                </div>
            </div>

            <!-- Kartu 2 -->
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <div style="font-size:2rem;">🔗</div>
                    <h5 class="mt-3 fw-bold">Metode Forward Chaining</h5>
                    <p class="text-muted mb-0">Diagnosis menggunakan pendekatan berbasis aturan sistem pakar.</p>
                </div>
            </div>

            <!-- Kartu 3 -->
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <div style="font-size:2rem;">💡</div>
                    <h5 class="mt-3 fw-bold">Solusi Langsung dari Pakar</h5>
                    <p class="text-muted mb-0">Rekomendasi langsung dari pengalaman pakar pertanian lapangan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Galeri Petani dan Jagung -->
<section class="py-5 bg-white">
    <div class="container text-center">
        <h3 class="fw-bold mb-4" style="color:#073B4C;">Tanaman Jagung Hibrida</h3>
        <div class="row g-4">
            <div class="col-md-4">
                <img src="{{ asset('images/jagung1.jpg') }}" 
                     class="img-fluid rounded-4 shadow" alt="Jagung 1">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('images/jagung2.jpg') }}" 
                     class="img-fluid rounded-4 shadow" alt="Petani 2">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('images/jagung3.jpg') }}" 
                     class="img-fluid rounded-4 shadow" alt="Jagung 3">
            </div>
        </div>
    </div>
</section>

@endsection


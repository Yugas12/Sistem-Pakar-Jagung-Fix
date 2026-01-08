@extends('layouts.app')

@section('content')
<section class="py-5" style="background-color:#FFF7ED;">
    <div class="container">
        <h2 class="text-center mb-4 fw-bold" style="color:#F2720C;">
            👩‍🌾 Tentang Saya
        </h2>

        <p class="text-center mb-5" style="font-size:1.1rem; color:#666; line-height:1.6;">
            Saya adalah pengembang Sistem Pakar yang peduli pada pertanian dan teknologi. 
            Melalui sistem ini, saya ingin membantu petani jagung dalam memantau kesehatan tanaman 
            dan mengenali penyakit umum agar panen lebih optimal.
        </p>

        <div class="row justify-content-center align-items-start mb-5">
            <!-- Foto -->
            <div class="col-md-4 text-center">
                <img src="{{ asset('images/E41220410_Wahyu Bagas Prastyo.jpg') }}" 
                     class="img-fluid rounded-2 mb-3" 
                     alt="Wahyu Bagas Prastyo" 
                     style="width:100%; max-height:300px; object-fit:contain; object-position:top;">
            </div>

            <!-- Biodata -->
            <div class="col-md-6">
                <h5 class="fw-bold mb-3" style="font-size:1.5rem;">Wahyu Bagas Prastyo</h5>
                <p class="mb-3" style="font-size:1.1rem; color:#555;">Mahasiswa / Pengembang Sistem Pakar</p>
                
                <ul class="list-unstyled" style="font-size:1.05rem; color:#444; line-height:1.6;">
                    <li><strong>NIM:</strong> E41220410</li>
                    <li><strong>Jurusan:</strong> D4-Teknik Informatika Kab. Nganjuk</li>
                    <li><strong>Program Studi:</strong> Teknologi Informasi</li>
                    <li><strong>Universitas:</strong> Politeknik Negeri Jember</li>
                    <li><strong>Email:</strong> wbagas700@gmail.com</li>
                </ul>

                <div class="mt-4">
                    <a href="https://github.com/Yugas12" target="_blank" class="btn btn-sm btn-outline-primary mx-1">GitHub</a>
                    <a href="https://www.linkedin.com/in/wahyu-bagas" target="_blank" class="btn btn-sm btn-outline-info mx-1">LinkedIn</a>
                </div>
            </div>
        </div>

        <h3 class="fw-bold text-center mb-5" style="color:#F2720C;">
            📸 Dokumentasi Observasi Penelitian
        </h3>

        <div class="row justify-content-center" style="margin-top:20px;">
            <!-- Foto 1 -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <img src="{{ asset('images/observasi3.jpeg') }}" class="card-img-top" alt="Observasi bersama ahli">
                    <div class="card-body">
                        <h6 class="fw-bold">Observasi Bersama Ahli Pertanian</h6>
                        <p class="mb-0" style="font-size:0.9rem; color:#555;">
                            Melakukan observasi langsung bersama pakar pertanian atau Dosen Pertanian untuk memahami penyakit jagung.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Foto 2 -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <img src="{{ asset('images/observasi1.jpeg') }}" class="card-img-top" alt="Observasi bersama petani">
                    <div class="card-body">
                        <h6 class="fw-bold">Observasi Bersama Petani</h6>
                        <p class="mb-0" style="font-size:0.9rem; color:#555;">
                            Mendokumentasikan wawancara pertanian di lapangan dan interaksi langsung dengan petani jagung.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Foto 3 -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <img src="{{ asset('images/observasi2.jpeg') }}" class="card-img-top" alt="Analisis lapangan">
                    <div class="card-body">
                        <h6 class="fw-bold">Analisis Lapangan dengan Dosen MNA</h6>
                        <p class="mb-0" style="font-size:0.9rem; color:#555;">
                            Mengumpulkan data untuk penelitian sistem pakar penyakit jagung bersama Dosen MNA selaku Ahli Pertanian.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

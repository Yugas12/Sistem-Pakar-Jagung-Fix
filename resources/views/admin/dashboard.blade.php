@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-success">📊 Dashboard Admin</h2>
    <p class="text-muted mb-4">Selamat datang, <strong>{{ Auth::user()->name ?? 'Admin' }}</strong>!</p>

    <div class="row g-4">
        <!-- Card jumlah penyakit -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 text-center p-4">
                <h3 class="fw-bold text-warning">{{ $total_penyakit ?? 0 }}</h3>
                <p class="text-muted mb-0">Data Penyakit</p>
            </div>
        </div>

        <!-- Card jumlah gejala -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 text-center p-4">
                <h3 class="fw-bold text-warning">{{ $total_gejala ?? 0 }}</h3>
                <p class="text-muted mb-0">Data Gejala</p>
            </div>
        </div>

        <!-- Card jumlah relasi -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 text-center p-4">
                <h3 class="fw-bold text-warning">{{ $total_relasi ?? 0 }}</h3>
                <p class="text-muted mb-0">Relasi Penyakit-Gejala</p>
            </div>
        </div>
    </div>
</div>
@endsection

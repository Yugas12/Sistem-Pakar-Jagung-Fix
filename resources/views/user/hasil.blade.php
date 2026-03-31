@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            
            {{-- HEADER --}}
            <div class="text-center mb-5">
                <h3 class="fw-bold text-success mb-3">
                    <i class="fas fa-stethoscope me-2"></i>Hasil Diagnosis
                </h3>
                <div style="font-size: 1.1rem; color: #dc3545;"> <!-- Contoh warna merah -->
                    <!-- konten Anda di sini -->
                </div>
                <p class="text-muted">Berikut adalah hasil analisis sistem terhadap gejala yang Anda pilih</p>
            </div>

            {{-- JIKA TIDAK ADA HASIL --}}
            @if(!$hasil)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Perhatian!</strong> {{ $pesan ?? 'Tidak ada penyakit yang terdeteksi.' }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                {{-- TAMPILKAN GEJALA YANG DIPILIH --}}
                @if(isset($gejalaDipilih) && $gejalaDipilih->count() > 0)
                    <div class="card border-warning mb-4">
                        <div class="card-header bg-warning bg-opacity-10">
                            <h5 class="mb-0">
                                <i class="fas fa-clipboard-list me-2"></i>Gejala yang Anda Pilih
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($gejalaDipilih as $index => $g)
                                    <div class="col-md-6 mb-2">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-primary me-2">{{ $index + 1 }}</span>
                                            <span>{{ $g->nama_gejala }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <div class="text-center mt-4">
                    <a href="{{ route('diagnosis') }}" class="btn btn-success px-4">
                        <i class="fas fa-redo me-2"></i>Diagnosa Ulang
                    </a>
                </div>

            {{-- JIKA ADA HASIL --}}
            @else
                <div class="card border-success shadow-lg">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-diagnoses me-2"></i>Hasil Diagnosis Sistem
                        </h4>
                    </div>
                    <div class="card-body">

                        {{-- GEJALA YANG DIPILIH --}}
                        <div class="mb-4">
                            <h5 class="fw-bold text-dark mb-3">
                                <i class="fas fa-check-circle text-primary me-2"></i>Gejala yang Dipilih
                            </h5>
                            <div class="row">
                                @foreach($gejalaDipilih as $index => $g)
                                    <div class="col-md-6 mb-2">
                                        <div class="alert alert-light d-flex align-items-center">
                                            <span class="badge bg-success me-2">{{ $index + 1 }}</span>
                                            <div>
                                                <strong>{{ $g->kode }}</strong> - {{ $g->nama_gejala }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- HASIL DIAGNOSIS --}}
                        <div class="mb-4">
                            <h5 class="fw-bold text-primary mb-3">
                                <i class="fas fa-search me-2"></i>Hasil Diagnosis
                            </h5>
                            <div class="alert alert-info bg-info bg-opacity-10 border-info">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-virus text-info fs-4 me-3 mt-1"></i>
                                    <div>
                                        <h4 class="text-success mb-2">{{ $hasil->nama }}</h4>
                                        <p class="mb-0">
                                            <strong>Penyakit Terdiagnosis adalah </strong> {{ $hasil->nama }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- DESKRIPSI PENYAKIT --}}
                        <div class="mb-4">
                            <h5 class="fw-bold text-dark mb-3">
                                <i class="fas fa-file-alt me-2"></i>Deskripsi Penyakit
                            </h5>
                            <div class="card">
                                <div class="card-body bg-light">
                                    @if($hasil->deskripsi)
                                        <p class="mb-0">{{ $hasil->deskripsi }}</p>
                                    @else
                                        <p class="text-muted mb-0">
                                            <i>Deskripsi tidak tersedia untuk penyakit ini.</i>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- SOLUSI PENANGANAN --}}
                        <div class="mb-4">
                            <h5 class="fw-bold text-dark mb-3">
                                <i class="fas fa-tools me-2"></i>Solusi Penanganan
                            </h5>
                            <div class="card">
                                <div class="card-body bg-light">
                                    @if($hasil->solusi)
                                        <div class="solusi-content">
                                            {!! nl2br(e($hasil->solusi)) !!}
                                        </div>
                                    @else
                                        <p class="text-muted mb-0">
                                            <i>Solusi penanganan belum tersedia.</i>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- FORM SIMPAN HASIL --}}
                        <form action="{{ route('diagnosa.simpan') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="penyakit_id" value="{{ $hasil->id }}">
                            
                            @foreach($gejalaDipilih as $g)
                                <input type="hidden" name="gejala_id[]" value="{{ $g->id }}">
                            @endforeach

                            <div class="d-flex justify-content-between align-items-center border-top pt-4">
                                <a href="{{ route('diagnosis') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-redo me-2"></i>Diagnosa Ulang
                                </a>
                                
                                <div>
                                    <button type="submit" class="btn btn-success px-4">
                                        <i class="fas fa-save me-2"></i>Simpan Hasil Diagnosa
                                    </button>
                                    <a href="{{ route('home') }}" class="btn btn-outline-primary ms-2">
                                        <i class="fas fa-home me-2"></i>Kembali ke Beranda
                                    </a>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="card-footer bg-light text-muted text-center">
                        <small>
                            <i class="fas fa-info-circle me-1"></i>
                            Hasil diagnosis ini berdasarkan gejala yang Anda pilih dan aturan yang tersedia dalam sistem.
                        </small>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>

<style>
    .solusi-content {
        line-height: 1.8;
    }
    .solusi-content ol, .solusi-content ul {
        padding-left: 1.5rem;
        margin-bottom: 1rem;
    }
    .solusi-content li {
        margin-bottom: 0.5rem;
    }
    .card {
        border-radius: 15px;
    }
    .alert-light {
        border-radius: 10px;
    }
</style>
@endsection
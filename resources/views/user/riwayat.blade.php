@extends('layouts.app')

@section('title', 'Riwayat Diagnosa')

@section('content')
<div class="container py-5">
    {{-- HEADER DENGAN DESKRIPSI --}}
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-3" style="color:#F2720C; font-size:2.2rem; letter-spacing:0.5px;">
            <i class="fas fa-history me-2"></i>🌽 Riwayat Diagnosa
        </h2>
        <p class="text-muted fs-5" style="max-width: 700px; margin: 0 auto;">
            Berikut adalah daftar lengkap diagnosis yang telah Anda lakukan sebelumnya. 
            Anda dapat melihat gejala yang dipilih, hasil diagnosis, dan solusi penanganan.
        </p>
        <div class="mt-3">
            <span class="badge bg-success fs-6 px-3 py-2">
                <i class="fas fa-clipboard-check me-1"></i> Total: {{ $riwayat->count() }} Diagnosis
            </span>
        </div>
    </div>

    @if($riwayat->count() > 0)
        {{-- TABEL RIWAYAT --}}
        <div class="card shadow-lg border-0">
            <div class="card-header bg-orange text-white py-3">
                <h5 class="mb-0">
                    <i class="fas fa-list-ol me-2"></i>Daftar Riwayat Diagnosis
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 70px;">No</th>
                                <th style="width: 180px;">
                                    <i class="fas fa-calendar-alt me-1"></i> Tanggal / Waktu
                                </th>
                                <th>
                                    <i class="fas fa-clipboard-list me-1"></i> Gejala yang Dipilih
                                </th>
                                <th style="width: 200px;">
                                    <i class="fas fa-virus me-1"></i> Nama Penyakit
                                </th>
                                <th>
                                    <i class="fas fa-tools me-1"></i> Solusi Penanganan
                                </th>
                                <th class="text-center" style="width:120px;">
                                    <i class="fas fa-eye me-1"></i> Detail
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayat as $index => $r)
                            <tr>
                                <td class="text-center fw-bold align-middle">
                                    <span class="badge bg-primary rounded-circle" style="width: 30px; height: 30px; line-height: 30px;">
                                        {{ $index + 1 }}
                                    </span>
                                </td>
                                
                                <td class="align-middle">
                                    <div class="text-nowrap">
                                        <div class="fw-bold text-dark">{{ \Carbon\Carbon::parse($r->tanggal)->format('d/m/Y') }}</div>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($r->tanggal)->format('H:i:s') }}</small>
                                    </div>
                                </td>
                                
                                <td class="align-middle">
                                    <div class="gejala-list">
                                        @if($r->detailDiagnosa && $r->detailDiagnosa->count() > 0)
                                            @php
                                                $gejalaList = [];
                                                foreach($r->detailDiagnosa as $detail) {
                                                    if($detail->gejala) {
                                                        $gejalaList[] = $detail->gejala->kode;
                                                    }
                                                }
                                                echo implode(', ', $gejalaList);
                                            @endphp
                                        @else
                                            <span class="text-muted fst-italic">Tidak ada data gejala</span>
                                        @endif
                                    </div>
                                </td>
                                
                                <td class="align-middle">
                                    @if($r->penyakit)
                                        <div class="d-flex align-items-center">
                                            <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-2">
                                                <i class="fas fa-leaf text-danger"></i>
                                            </div>
                                            <div>
                                                <strong class="d-block">{{ $r->penyakit->nama }}</strong>
                                                <small class="text-muted">Kode: {{ $r->penyakit->kode }}</small>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted fst-italic">-</span>
                                    @endif
                                </td>
                                
                                <td class="align-middle">
                                    @if($r->penyakit && $r->penyakit->solusi)
                                        <div class="solusi-preview">
                                            {{ Str::limit($r->penyakit->solusi, 120) }}
                                            @if(strlen($r->penyakit->solusi) > 120)
                                                <span class="text-muted">...</span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-muted fst-italic">Tidak ada solusi tersedia</span>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                <button class="btn btn-sm btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $r->id }}">
                                    <i class="fas fa-search"></i> Detail
                                </button>
                            </td>
                            </tr>
                            <!-- MODAL DETAIL -->
                            <div class="modal fade" id="detailModal{{ $r->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">

                                <div class="modal-header bg-orange text-white">
                                    <h5 class="modal-title">
                                        Detail Diagnosa - {{ $r->penyakit->nama }}
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">

                                    <p><strong>Tanggal:</strong>
                                        {{ \Carbon\Carbon::parse($r->tanggal)->format('d/m/Y H:i:s') }}
                                    </p>

                                    <hr>

                                    <h6>Penyakit Terdiagnosa</h6>
                                    <p>
                                        <strong>{{ $r->penyakit->nama }}</strong>
                                        ({{ $r->penyakit->kode }})
                                    </p>

                                    <h6>Solusi Penanganan</h6>
                                    <p>{{ $r->penyakit->solusi }}</p>

                                    <hr>

                                    <h6>Gejala yang Dipilih Saat Itu</h6>
                                    <ul>
                                        @foreach($r->detailDiagnosa as $detail)
                                            <li>
                                                {{ $detail->gejala->kode }} -
                                                {{ $detail->gejala->nama }}
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>

                                </div>
                            </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-light py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Menampilkan {{ $riwayat->count() }} diagnosis
                        </small>
                    </div>
                    <div>
                        <a href="{{ route('diagnosis') }}" class="btn btn-success px-4">
                            <i class="fas fa-plus-circle me-2"></i>Diagnosa Baru
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary ms-2">
                            <i class="fas fa-home me-2"></i>Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- STATE KOSONG --}}
        <div class="card shadow-lg border-0">
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-clipboard text-muted" style="font-size: 5rem; opacity: 0.5;"></i>
                </div>
                <h3 class="text-muted mb-3">Belum Ada Riwayat Diagnosis</h3>
                <p class="text-muted mb-4" style="max-width: 500px; margin: 0 auto;">
                    Anda belum melakukan diagnosis penyakit tanaman jagung. 
                    Mulailah diagnosis untuk melihat riwayat di sini.
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('diagnosis') }}" class="btn btn-success btn-lg px-4">
                        <i class="fas fa-stethoscope me-2"></i>Mulai Diagnosis
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-outline-primary btn-lg px-4">
                        <i class="fas fa-home me-2"></i>Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    .bg-orange {
        background-color: #F2720C !important;
    }
    .gejala-list {
        font-family: 'Courier New', monospace;
        font-weight: 500;
    }
    .solusi-preview {
        line-height: 1.5;
        max-height: 60px;
        overflow: hidden;
    }
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(242, 114, 12, 0.08);
        transition: background-color 0.2s ease;
    }
    .table td {
        vertical-align: middle;
        border-color: #e9ecef;
    }
    .badge.bg-primary {
        background-color: #0d6efd !important;
    }
</style>
@endsection
@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

<!-- ================= HERO DASHBOARD ================= -->
<section class="py-5 text-white" style="background-color:#F2720C;">
    <div class="container text-center">
        <h1 class="fw-bold mb-2">📊 Dashboard Admin</h1>
        <p class="fs-5 mb-0" style="color:#fff9f0;">
            Ringkasan data Sistem Pakar Penyakit Jagung Hibrida
        </p>
    </div>
</section>

<!-- ================= STATISTIK ================= -->
<section class="py-5" style="background-color:#FFF7E0;">
    <div class="container">

        <div class="row g-5 text-center mb-4">
            <div class="col-md-6">
                <div class="bg-white rounded-4 shadow-lg p-5">
                    <div style="font-size:3rem;">👤</div>
                    <h4>Total Pengguna</h4>
                    <h1 class="fw-bold text-primary">{{ $total_pengguna }}</h1>
                </div>
            </div>

            <div class="col-md-6">
                <div class="bg-white rounded-4 shadow-lg p-5">
                    <div style="font-size:3rem;">🦠</div>
                    <h4>Data Penyakit</h4>
                    <h1 class="fw-bold text-success">{{ $total_penyakit }}</h1>
                </div>
            </div>
        </div>

        <div class="row g-5 text-center">
            <div class="col-md-6">
                <div class="bg-white rounded-4 shadow-lg p-5">
                    <div style="font-size:3rem;">📋</div>
                    <h4>Data Gejala</h4>
                    <h1 class="fw-bold text-warning">{{ $total_gejala }}</h1>
                </div>
            </div>

            <div class="col-md-6">
                <div class="bg-white rounded-4 shadow-lg p-5">
                    <div style="font-size:3rem;">🧠</div>
                    <h4>Riwayat Diagnosa</h4>
                    <h1 class="fw-bold text-danger">{{ $total_diagnosa }}</h1>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ================= RIWAYAT DIAGNOSA ================= -->
<section class="py-5" style="background-color:#FFFDF5;">
<div class="container">

    <div class="text-center mb-4">
        <h3 class="fw-bold text-orange">📑 Data Riwayat Diagnosa</h3>
        <span class="badge bg-success fs-6">
            Total: {{ $riwayat->total() }} Diagnosis
        </span>
    </div>

    <!-- SEARCH -->
    <form method="GET" class="mb-4">
        <div class="row g-2 justify-content-center">
            <div class="col-md-4">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Cari berdasarkan nama pengguna..."
                       value="{{ $search }}">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">🔍 Cari</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary w-100">
                    Reset
                </a>
            </div>
        </div>
    </form>

    @if($riwayat->count())
    <div class="card shadow-lg border-0">

        <div class="card-header bg-orange text-white">
            Daftar Riwayat Diagnosis
        </div>

        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Pengguna</th>
                        <th>Tanggal</th>
                        <th>Gejala</th>
                        <th>Penyakit</th>
                        <th>Solusi</th>
                        <th class="text-center" style="width:120px;">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayat as $index => $r)
                    <tr>
                        <td>
                            {{ ($riwayat->currentPage() - 1) * $riwayat->perPage() + $index + 1 }}
                        </td>
                        <td>{{ $r->pengguna->nama ?? '-' }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($r->tanggal)->format('d/m/Y H:i') }}
                        </td>
                        <td>{{ $r->gejala_string }}</td>
                        <td>{{ $r->penyakit->nama ?? '-' }}</td>
                        <td class="solusi-preview">{{ $r->solusi_singkat }}</td>
                        <td class="text-center">
                        <button class="btn btn-sm btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#detailModalAdmin{{ $r->id }}">
                            Detail
                        </button>
                    </td>
    
                    {{-- MODAL DETAIL RIWAYAT DIAGNOSA --}}
                    <!-- MODAL DETAIL ADMIN -->
                    <div class="modal fade" id="detailModalAdmin{{ $r->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">

                        <div class="modal-header bg-orange text-white">
                            <h5 class="modal-title">
                                Detail Diagnosa - {{ $r->pengguna->nama ?? '-' }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <p><strong>Tanggal:</strong>
                                {{ \Carbon\Carbon::parse($r->tanggal)->format('d/m/Y H:i:s') }}
                            </p>

                            <p><strong>Penyakit:</strong>
                                {{ $r->penyakit->nama ?? '-' }}
                            </p>

                            <p><strong>Solusi Lengkap:</strong><br>
                                {{ $r->penyakit->solusi ?? '-' }}
                            </p>

                            <hr>

                            <h6>Gejala yang Dipilih</h6>
                            <ul>
                                @foreach($r->detailDiagnosa as $detail)
                                    <li>
                                        {{ $detail->gejala->kode }} -
                                        {{ $detail->gejala->nama }}
                                    </li>
                                @endforeach
                            </ul>

                        </div>

                        <div class="modal-footer justify-content-end py-2">
                        <!-- Tombol Hapus (gaya kecil & ringkas) -->
                        <form action="{{ route('admin.diagnosa.destroy', $r->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus data diagnosa ini?')"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm px-2 py-1">
                                Hapus
                            </button>
                        </form>
                    </div>

                        </div>
                    </div>
                    </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- TOMBOL NEXT --}}
        @if($riwayat->hasMorePages())
        <div class="card-footer text-center">
            <a href="{{ $riwayat->nextPageUrl() }}" class="btn btn-outline-primary px-4">
                Next ➜
            </a>
        </div>
        @endif

    </div>
    @else
        <div class="alert alert-warning text-center">
            Data tidak ditemukan
        </div>
    @endif

</div>
</section>

<style>
.bg-orange { background:#F2720C }
.solusi-preview { max-height:60px; overflow:hidden }
</style>

@endsection

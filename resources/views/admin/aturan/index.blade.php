@extends('layouts.admin')

@section('title', 'Basis Aturan')

@section('content')
<div class="container py-4">

    <!-- ================= JUDUL ================= -->
    <div class="text-center mb-4">

        <h3 class="fw-bold mb-4">
            📘 Basis Aturan Forward Chaining & Certainty Factor
        </h3>

        <p class="text-muted fs-5">
            Tabel ini menampilkan representasi hubungan antara gejala dan penyakit
            <br>
            yang digunakan sebagai basis pengetahuan dalam
            <br>
            proses penalaran metode Forward Chaining & Certainty Factor.
        </p>

    </div>

    <!-- ================= NOTIFIKASI ================= -->
    @if(session('success'))

        <div class="alert alert-success text-center">

            {{ session('success') }}

        </div>

    @endif

    <!-- ================= TOMBOL TAMBAH ================= -->
    <div class="d-flex justify-content-end mb-4">

        <a href="{{ route('admin.aturan.create') }}"
           class="btn btn-success fs-5 px-4 py-2">

            + Tambah Aturan

        </a>

    </div>

    <!-- ================= CARD ================= -->
    <div class="card shadow rounded-4 border-0">

        <div class="card-body p-0"
             style="overflow-x:auto">

            <!-- ================= TABEL ================= -->
            <table class="table table-bordered table-striped table-hover align-middle mb-0 text-center"
                   style="font-size:22px;">

                <!-- ================= HEADER ================= -->
                <thead class="table-warning">

                    <tr>

                        <!-- KOLOM PENYAKIT -->
                        <th style="min-width:280px;
                                   padding:20px;">

                            Penyakit \ Gejala

                        </th>

                        <!-- KOLOM GEJALA -->
                        @foreach ($gejala as $g)

                            <th style="min-width:70px;
                                       padding:18px;">

                                {{ $g->kode }}

                            </th>

                        @endforeach

                        <!-- KOLOM AKSI -->
                        <th style="min-width:160px;
                                   padding:18px;">

                            Aksi

                        </th>

                    </tr>

                </thead>

                <!-- ================= BODY ================= -->
                <tbody>

                @foreach ($penyakit as $p)

                    <tr>

                        <!-- ================= NAMA PENYAKIT ================= -->
                        <td class="text-start fw-bold"
                            style="padding:20px;
                                   font-size:24px;">

                            {{ $p->kode }}

                            <br>

                            <small style="font-size:22px;">

                                {{ $p->nama }}

                            </small>

                        </td>

                        <!-- ================= MATRIX RULE ================= -->
                        @foreach ($gejala as $g)

                            @php

                                // Ambil nilai CF Pakar
                                $cf = $aturanMap[$p->id][$g->id] ?? null;

                            @endphp

                            <td style="font-size:24px;
                                       font-weight:bold;
                                       padding:18px;">

                                @if($cf !== null)

                                    <!-- Tampilkan CF Pakar -->
                                    {{ rtrim(rtrim($cf, '0'), '.') }}

                                @else

                                    —

                                @endif

                            </td>

                        @endforeach

                        <!-- ================= AKSI ================= -->
                        <td>

                            <div class="d-flex justify-content-center gap-2">

                                <!-- EDIT -->
                                <a href="{{ route('admin.aturan.edit', $p->id) }}"
                                   class="btn btn-warning btn-sm fs-5"
                                   title="Edit aturan">

                                    ✏️

                                </a>

                                <!-- DELETE -->
                                <form action="{{ route('admin.aturan.deleteByPenyakit', $p->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus semua aturan penyakit ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm fs-5"
                                            title="Hapus aturan">

                                        🗑️

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>
@endsection
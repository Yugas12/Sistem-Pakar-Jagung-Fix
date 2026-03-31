@extends('layouts.admin')

@section('title', 'Basis Aturan')

@section('content')
<div class="container py-4">

    <!-- Judul -->
    <div class="text-center mb-4">
        <h3 class="fw-bold mb-4">📘 Basis Aturan Forward Chaining</h3>
        <p class="text-muted fs-5">
            Tabel ini menampilkan representasi hubungan antara gejala dan penyakit 
            <br>
            yang digunakan sebagai basis pengetahuan dalam 
            <br>
            proses penalaran metode Forward Chaining.
        </p>
    </div>

    <!-- Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <!-- Card -->
    <div class="card shadow-sm rounded-4">
        <div class="card-body p-0" style="overflow-x:auto">

            <table class="table table-bordered table-striped table-hover align-middle fs-4 mb-0 text-center">
                
                <!-- HEADER -->
                <thead class="table-warning">
                    <tr>
                        <th style="min-width:220px">Penyakit \ Gejala</th>
                        @foreach ($gejala as $g)
                            <th>{{ $g->kode }}</th>
                        @endforeach
                        <th style="min-width:140px">Aksi</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody>
                @foreach ($penyakit as $p)
                    <tr>

                        <!-- Nama Penyakit -->
                        <td class="text-start fw-bold">
                            {{ $p->kode }}<br>
                            <small>{{ $p->nama }}</small>
                        </td>

                        <!-- Matrix Rule -->
                        @foreach ($gejala as $g)
                            @php
                                $checked = in_array($g->id, $aturanMap[$p->id] ?? []);
                            @endphp

                            <td style="font-size:20px;font-weight:bold">
                                {!! $checked ? '✔️' : '—' !!}
                            </td>
                        @endforeach

                        <!-- Tombol -->
                        <td>
                            <div class="d-flex justify-content-center gap-2">

                                <!-- EDIT -->
                                <a href="{{ route('admin.aturan.edit', $p->id) }}"
                                   class="btn btn-warning btn-sm"
                                   title="Edit aturan">
                                    ✏️
                                </a>

                                <!-- DELETE -->
                                <form action="{{ route('admin.aturan.deleteByPenyakit',$p->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus semua aturan penyakit ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
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

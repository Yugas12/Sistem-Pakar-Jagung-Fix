@extends('layouts.admin')

@section('title', 'Tambah Aturan')

@section('content')
<div class="container py-4">

    <!-- Judul -->
    <div class="text-center mb-4">
        <h3 class="fw-bold mb-2">➕ Tambah Basis Aturan</h3>
        <p class="text-muted fs-5">
            Form ini digunakan untuk menentukan hubungan
            <br>
            antara penyakit dan gejala pada sistem pakar.
        </p>
    </div>

    <!-- Card -->
    <div class="card shadow-sm rounded-4">
        <div class="card-body fs-5">

            <form action="{{ route('admin.aturan.store') }}" method="POST">
                @csrf

                @include('admin.aturan.form')

                <!-- Tombol -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.aturan.index') }}"
                       class="btn btn-secondary fs-5 px-4 py-2 me-2">
                        Kembali
                    </a>

                    <button type="submit"
                            class="btn btn-success fs-5 px-4 py-2">
                        💾 Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

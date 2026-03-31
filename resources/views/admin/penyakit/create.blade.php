@extends('layouts.admin')

@section('title', 'Tambah Penyakit')

@section('content')
<div class="container py-4">

    <!-- Judul Halaman -->
    <div class="text-center mb-4">
        <h3 class="fw-bold mb-2">➕ Tambah Penyakit</h3>
        <p class="text-muted fs-5">
            Form ini digunakan untuk menambahkan data penyakit baru
            <br>
            yang akan digunakan dalam proses diagnosis pada sistem pakar.
        </p>
    </div>

    <!-- Card Form -->
    <div class="card shadow-sm rounded-4">
        <div class="card-body fs-5">

            <form action="{{ route('admin.penyakit.store') }}" method="POST">
                @csrf

                @include('admin.penyakit.form')

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.penyakit.index') }}"
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


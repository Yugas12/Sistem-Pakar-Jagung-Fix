@extends('layouts.admin')

@section('title', 'Edit Gejala')

@section('content')
<div class="container py-4">

    <!-- Judul Halaman -->
    <div class="text-center mb-4">
        <h3 class="fw-bold mb-2">✏️ Edit Gejala</h3>
        <p class="text-muted fs-5">
            Form ini digunakan untuk memperbarui data gejala
            <br>
            agar tetap sesuai dengan kebutuhan sistem pakar.
        </p>
    </div>

    <!-- Card Form -->
    <div class="card shadow-sm rounded-4">
        <div class="card-body fs-5">

            <form action="{{ route('admin.gejala.update', $gejala->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('admin.gejala.form')

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.gejala.index') }}"
                       class="btn btn-secondary fs-5 px-4 py-2 me-2">
                        Kembali
                    </a>

                    <button type="submit"
                            class="btn btn-warning fs-5 px-4 py-2">
                        🔄 Update
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

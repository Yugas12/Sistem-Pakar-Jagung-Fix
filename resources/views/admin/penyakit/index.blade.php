@extends('layouts.admin')

@section('title', 'Data Penyakit')

@section('content')
<div class="container py-4">

    <!-- Judul Halaman -->
    <div class="text-center mb-4">
        <h3 class="fw-bold mb-5">🦠 Data Penyakit</h3>
        <p class="text-muted fs-5">
            Daftar penyakit yang digunakan sebagai dasar proses diagnosis pada sistem pakar.
            <br>
            Admin dapat menambah, mengubah, dan menghapus data penyakit sesuai kebutuhan.
        </p>
    </div>

    <!-- Tombol Tambah -->
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('admin.penyakit.create') }}"
           class="btn btn-success fs-5 px-4 py-2">
            + Tambah Penyakit
        </a>
    </div>

    <!-- Tabel Data -->
    <div class="card shadow-sm rounded-4">
        <div class="card-body p-0">
            <table class="table table-bordered table-striped table-hover align-middle fs-5 mb-0">
                <thead class="table-warning text-center">
                    <tr>
                        <th class="py-3">No</th>
                        <th class="py-3">Kode</th>
                        <th class="py-3">Nama Penyakit</th>
                        <th class="py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penyakit as $item)
                    <tr>
                        <td class="text-center py-3">{{ $loop->iteration }}</td>
                        <td class="py-3">{{ $item->kode }}</td>
                        <td class="py-3">{{ $item->nama }}</td>
                        <td class="text-center py-3">
                            <a href="{{ route('admin.penyakit.edit', $item->id) }}"
                               class="btn btn-warning fs-5 px-4 py-2 me-2">
                                ✏️ Edit
                            </a>

                            <form action="{{ route('admin.penyakit.destroy', $item->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger fs-5 px-4 py-2"
                                        onclick="return confirm('Yakin hapus data?')">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">
                            Data penyakit belum tersedia.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

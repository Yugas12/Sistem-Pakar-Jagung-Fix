@extends('layouts.app')

@section('title', 'Kelola Data Gejala')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-success">🌾 Kelola Data Gejala</h2>

    <div class="card shadow-sm border-0 rounded-4 p-4">
        <form action="{{ route('admin.gejala.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="row g-2">
                <div class="col-md-10">
                    <input type="text" name="nama_gejala" class="form-control" placeholder="Masukkan nama gejala baru" required>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-success fw-semibold">Tambah</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered align-middle">
            <thead class="table-warning text-center">
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Gejala</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($gejala as $index => $g)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $g->nama_gejala }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.gejala.edit', $g->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.gejala.destroy', $g->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus gejala ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center text-muted">Belum ada data gejala.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

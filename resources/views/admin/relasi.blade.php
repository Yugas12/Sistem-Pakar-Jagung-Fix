@extends('layouts.app')

@section('title', 'Kelola Relasi Penyakit-Gejala')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-success">🔗 Kelola Relasi Penyakit-Gejala</h2>

    <div class="card shadow-sm border-0 rounded-4 p-4">
        <form action="{{ route('admin.relasi.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="row g-2 align-items-center">
                <div class="col-md-5">
                    <select name="penyakit_id" class="form-select" required>
                        <option value="">-- Pilih Penyakit --</option>
                        @foreach ($penyakit as $p)
                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <select name="gejala_id" class="form-select" required>
                        <option value="">-- Pilih Gejala --</option>
                        @foreach ($gejala as $g)
                            <option value="{{ $g->id }}">{{ $g->nama_gejala }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-success fw-semibold">Tambah Relasi</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered align-middle">
            <thead class="table-warning text-center">
                <tr>
                    <th width="5%">No</th>
                    <th>Penyakit</th>
                    <th>Gejala</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($relasi as $index => $r)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $r->penyakit->nama ?? '-' }}</td>
                    <td>{{ $r->gejala->nama_gejala ?? '-' }}</td>
                    <td class="text-center">
                        <form action="{{ route('admin.relasi.destroy', $r->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus relasi ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted">Belum ada relasi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

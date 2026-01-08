@extends('layouts.app')

@section('title', 'Data Penyakit Jagung')

@section('content')
    <div class="container py-5">
    <h2 class="fw-bold text-center"
        style="color:#F2720C; font-size:2rem; letter-spacing:0.5px; margin-bottom:3rem;">
        🌽 Data Penyakit Jagung Hibrida
    </h2>

    <div class="row">
        @forelse ($penyakit as $p)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 rounded-4 h-100">
                    
                    {{-- GAMBAR --}}
                    @if(!empty($p['gambar']))
                        <img 
                            src="{{ asset('images/' . $p['gambar']) }}" 
                            class="card-img-top rounded-top-4"
                            alt="{{ $p['nama'] }}"
                            style="height: 200px; object-fit: cover;"
                        >
                    @endif

                    {{-- KONTEN --}}
                    <div class="card-body">
                        <h5 class="card-title fw-bold"
                            style="color:#F2720C;">
                            {{ $p['nama'] }}
                        </h5>
                        
                    <p class="card-text">
                        <strong>Gejala:</strong><br>
                        {{ $p['gejala'] }}
                    </p>

                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-muted">
                    Belum ada data penyakit.
                </p>
            </div>
        @endforelse
    </div>
</div>
@endsection

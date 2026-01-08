@extends('layouts.app')

@section('content')
<section class="py-5" style="background-color:#FFF7ED;">
    <div class="container">
        <!-- Judul -->
        <h2 class="text-center fw-bold mb-5" 
            style="color:#F2720C; font-size:2rem; letter-spacing:0.5px;">
            🌽 Diagnosis Penyakit Jagung
        </h2>
        <p class="text-center mb-4" style="font-size: 1.1rem; color:#555;">
            Silakan pilih gejala yang muncul pada tanaman jagung Anda untuk mengetahui kemungkinan penyakit yang menyerang.
        </p>

        <!-- Form -->
        <form action="{{ route('diagnosis.proses') }}" method="POST" 
              class="p-5 rounded-4 shadow-sm bg-white" 
              style="max-width:1500px; margin:auto;">
            @csrf

            <div class="row g-3">
                @foreach ($gejala as $item)
                <div class="col-md-6">
                    <div class="form-check ps-4" style="font-size:1.05rem;">
                        <input class="form-check-input me-2" type="checkbox" 
                               name="gejala[]" value="{{ $item['kode'] }}" id="{{ $item['kode'] }}" 
                               style="width:18px; height:18px; cursor:pointer;">
                        <label class="form-check-label" for="{{ $item['kode'] }}" style="cursor:pointer;">
                            <strong>{{ $item['kode'] }}</strong> - {{ $item['nama'] }}
                        </label>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Tombol -->
            <div class="text-center mt-5">
                <button type="submit" class="btn px-5 py-2" 
                        style="background-color:#4CAF50; color:white; font-weight:600; 
                               border-radius:10px; font-size:1.1rem;">
                    Proses Diagnosis
                </button>
            </div>
        </form>
    </div>
</section>
@endsection

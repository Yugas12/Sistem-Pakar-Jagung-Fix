@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="text-center fw-bold" style="color:#F2720C;">🩺 Hasil Diagnosis Sementara</h3>

    @if(count($pilihan) > 0)
        <ul class="list-group mt-4">
            @foreach($pilihan as $g)
                <li class="list-group-item">Gejala yang dipilih: {{ $g }}</li>
            @endforeach
        </ul>
    @else
        <p class="text-center mt-4">Tidak ada gejala yang dipilih.</p>
    @endif

    <div class="text-center mt-4">
        <a href="{{ route('diagnosis') }}" class="btn btn-success px-4 py-2">Kembali</a>
    </div>
</div>
@endsection

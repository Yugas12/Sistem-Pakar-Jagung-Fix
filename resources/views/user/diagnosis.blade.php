@extends('layouts.app')

@section('content')
<section class="py-5" style="background-color:#FFF7ED;">
    <div class="container">

        <!-- Judul -->
        <h2 class="text-center fw-bold mb-5"
            style="color:#F2720C; font-size:2rem; letter-spacing:0.5px;">
            🌽 Diagnosis Penyakit Jagung
        </h2>

        <p class="text-center mb-4"
           style="font-size: 1.1rem; color:#555;">
            Silakan pilih gejala yang muncul pada tanaman jagung Anda
            beserta tingkat keyakinannya untuk mengetahui kemungkinan
            penyakit yang menyerang.
        </p>

        <!-- Form -->
        <form action="{{ route('diagnosis.proses') }}"
              method="POST"
              class="p-5 rounded-4 shadow-sm bg-white"
              style="max-width:1500px; margin:auto;">

            @csrf

            <div class="row g-4">

                @foreach ($gejala as $item)

                <div class="col-md-6">

                    <div class="border rounded-4 p-4 h-100 shadow-sm"
                         style="background-color:#fff;
                                border:2px solid #F2720C !important;">

                        <!-- Checkbox -->
                        <div class="form-check mb-4">

                            <input class="form-check-input gejala-checkbox"
                                   type="checkbox"
                                   name="gejala[]"
                                   value="{{ $item['kode'] }}"
                                   id="{{ $item['kode'] }}"
                                   data-target="cf_{{ $item['kode'] }}"
                                   style="
                                        width:24px;
                                        height:24px;
                                        cursor:pointer;
                                        border:2px solid #F2720C;
                                   ">

                            <label class="form-check-label ms-2"
                                   for="{{ $item['kode'] }}"
                                   style="
                                        cursor:pointer;
                                        font-size:1.08rem;
                                        font-weight:600;
                                        color:#333;
                                   ">

                                <strong>{{ $item['kode'] }}</strong>
                                - {{ $item['nama'] }}

                            </label>

                        </div>

                        <!-- Tingkat Keyakinan -->
                        <div>

                            <label class="form-label fw-semibold"
                                   style="color:#444;">
                                Tingkat Keyakinan
                            </label>

                            <select name="cf_user[{{ $item['kode'] }}]"
                                    id="cf_{{ $item['kode'] }}"
                                    class="form-select"
                                    disabled>

                                <option value="0">
                                    -- Pilih Keyakinan --
                                </option>

                                <option value="1">
                                    Sangat Yakin
                                </option>

                                <option value="0.8">
                                    Yakin
                                </option>

                                <option value="0.6">
                                    Cukup Yakin
                                </option>

                                <option value="0.4">
                                    Sedikit Yakin
                                </option>

                                <option value="0.2">
                                    Tidak Yakin
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

            <!-- Tombol -->
            <div class="text-center mt-5">

                <button type="submit"
                        class="btn px-5 py-2"
                        style="
                            background-color:#4CAF50;
                            color:white;
                            font-weight:600;
                            border-radius:10px;
                            font-size:1.1rem;
                        ">

                    Proses Diagnosis

                </button>

            </div>

        </form>

    </div>
</section>

<!-- Script Enable Disable Dropdown -->
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const checkboxes = document.querySelectorAll('.gejala-checkbox');

        checkboxes.forEach(function (checkbox) {

            checkbox.addEventListener('change', function () {

                const targetId = this.getAttribute('data-target');
                const selectBox = document.getElementById(targetId);

                if (this.checked) {
                    selectBox.disabled = false;
                } else {
                    selectBox.disabled = true;
                    selectBox.value = 0;
                }

            });

        });

    });
</script>
@endsection
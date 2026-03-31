<!-- Input Kode Gejala -->
<!-- Digunakan sebagai kode unik untuk mengidentifikasi gejala -->
<div class="mb-3">
    <label class="form-label">Kode Gejala</label>
    <input type="text"
           name="kode"
           class="form-control"
           value="{{ old('kode', $gejala->kode ?? '') }}"
           required>
</div>

<!-- Input Nama Gejala -->
<!-- Digunakan untuk menampilkan nama gejala pada proses diagnosis -->
<div class="mb-3">
    <label class="form-label">Nama Gejala</label>
    <input type="text"
           name="nama"
           class="form-control"
           value="{{ old('nama', $gejala->nama ?? '') }}"
           required>
</div>

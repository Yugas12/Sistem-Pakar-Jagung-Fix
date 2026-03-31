<!-- Input Kode Penyakit -->
<!-- Digunakan sebagai kode unik untuk mengidentifikasi penyakit -->
<div class="mb-3">
    <label class="form-label">Kode Penyakit</label>
    <input type="text" name="kode"
           value="{{ old('kode_penyakit', $penyakit->kode ?? '') }}"
           class="form-control"
           required>
</div>

<!-- Input Nama Penyakit -->
<!-- Digunakan untuk menampilkan nama penyakit pada sistem dan hasil diagnosis -->
<div class="mb-3">
    <label class="form-label">Nama Penyakit</label>
    <input type="text" name="nama"
           value="{{ old('nama_penyakit', $penyakit->nama ?? '') }}"
           class="form-control"
           required>
</div>

<!-- Input Deskripsi Penyakit -->
<!-- Berisi penjelasan singkat mengenai penyakit -->
<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="deskripsi"
              class="form-control"
              rows="3"
              required>{{ old('deskripsi', $penyakit->deskripsi ?? '') }}</textarea>
</div>

<!-- Input Solusi / Penanganan -->
<!-- Berisi solusi atau saran penanganan penyakit yang akan ditampilkan ke pengguna -->
<div class="mb-3">
    <label class="form-label">Solusi</label>
    <textarea name="solusi"
              class="form-control"
              rows="3"
              required>{{ old('solusi', $penyakit->solusi ?? '') }}</textarea>
</div>

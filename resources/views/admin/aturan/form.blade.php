<!-- Pilih Penyakit -->
<div class="mb-3">
    <label class="form-label">Penyakit</label>
    <select name="penyakit_id" class="form-select" required>
        <option value="">-- Pilih Penyakit --</option>
        @foreach ($penyakit as $p)
            <option value="{{ $p->id }}"
                {{ old('penyakit_id', $selectedPenyakit ?? '') == $p->id ? 'selected' : '' }}>
                {{ $p->kode }} - {{ $p->nama }}
            </option>
        @endforeach
    </select>
</div>

<!-- Pilih Gejala -->
<div class="mb-3">
    <label class="form-label">Gejala</label>
    <div class="border rounded p-3" style="max-height:300px; overflow-y:auto;">
        @foreach ($gejala as $g)
            <div class="form-check">
                <input class="form-check-input"
                       type="checkbox"
                       name="gejala_id[]"
                       value="{{ $g->id }}"
                       {{ in_array($g->id, old('gejala_id', $selectedGejala ?? [])) ? 'checked' : '' }}>
                <label class="form-check-label">
                    {{ $g->kode }} - {{ $g->nama }}
                </label>
            </div>
        @endforeach
    </div>
</div>

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
            <div class="border rounded p-3 mb-2">

                <div class="row align-items-center">

                    <!-- Checkbox -->
                    <div class="col-md-7">

                        <div class="form-check">

                            <input class="form-check-input aturan-checkbox"
                                type="checkbox"
                                name="gejala_id[]"
                                value="{{ $g->id }}"
                                id="g{{ $g->id }}"
                                data-target="cf{{ $g->id }}"

                                {{ in_array($g->id, old('gejala_id', $selectedGejala ?? []))
                                        ? 'checked'
                                        : '' }}>

                            <label class="form-check-label fw-semibold"
                                for="g{{ $g->id }}">

                                {{ $g->kode }} - {{ $g->nama }}

                            </label>

                        </div>

                    </div>

                    <!-- CF Pakar -->
                    <div class="col-md-5">

                        <input type="number"
                            step="0.1"
                            min="0"
                            max="1"

                            name="cf_pakar[{{ $g->id }}]"

                            id="cf{{ $g->id }}"

                            class="form-control"

                            placeholder="CF Pakar (0 - 1)"

                            value="{{ old('cf_pakar.' . $g->id,
                                    $cfPakar[$g->id] ?? '') }}">

                    </div>

                </div>

</div>
        @endforeach
    </div>
</div>

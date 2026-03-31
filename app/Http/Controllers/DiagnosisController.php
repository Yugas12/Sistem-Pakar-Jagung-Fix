<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Aturan;
use App\Models\Diagnosa;
use App\Models\DetailDiagnosa;

class DiagnosisController extends Controller
{
    // =========================
    // Halaman Diagnosis
    // =========================
    public function index()
    {
        $gejala = Gejala::all();
        return view('user.diagnosis', compact('gejala'));
    }

    // =========================
    // PROSES DIAGNOSIS DENGAN FORWARD CHAINING (LOGIKA AND)
    // =========================
        public function proses(Request $request)
    {
        // =========================
        // 1. VALIDASI INPUT
        // Pastikan user memilih minimal 1 gejala
        // =========================
        $request->validate([
            'gejala' => 'required|array|min:1',
            'gejala.*' => 'string'
        ]);

        // Ambil kode gejala yang dipilih user (contoh: G1, G4, G8)
        $kodeGejalaDipilih = $request->gejala;

        // =========================
        // 2. AMBIL DATA GEJALA DARI DATABASE
        // =========================
        $gejalaDipilih = Gejala::whereIn('kode', $kodeGejalaDipilih)->get();

        // Jika tidak ditemukan gejala sama sekali
        if ($gejalaDipilih->count() == 0) {
            return view('user.hasil', [
                'hasil' => null,
                'pesan' => 'Gejala yang dipilih tidak ditemukan.',
                'gejalaDipilih' => collect()
            ]);
        }

        // Ambil ID gejala yang dipilih (dipakai untuk pencocokan rule)
        $gejalaIds = $gejalaDipilih->pluck('id')->toArray();

        // Debug log (boleh dihapus nanti)
        \Log::info('Diagnosis - Gejala dipilih:', $gejalaIds);

        // =========================
        // 3. AMBIL SELURUH RULE (BASIS PENGETAHUAN)
        // =========================
        $semuaAturan = Aturan::all();

        // Kelompokkan rule berdasarkan penyakit
        // Format hasil:
        // [penyakit_id => [gejala_id, gejala_id, ...]]
        $aturanPerPenyakit = [];
        foreach ($semuaAturan as $aturan) {
            $aturanPerPenyakit[$aturan->penyakit_id][] = $aturan->gejala_id;
        }

        // =========================
        // 4. PROSES FORWARD CHAINING
        // Menghitung tingkat kecocokan setiap penyakit
        // =========================

        $hasil = null;                 // Penyakit terpilih
        $persentaseTertinggi = 0;      // Nilai kecocokan terbesar

        foreach ($aturanPerPenyakit as $penyakitId => $gejalaRequired) {

            $totalRule = count($gejalaRequired); // jumlah gejala dalam rule
            $jumlahCocok = 0;                   // jumlah gejala yang cocok

            // Cek satu per satu apakah gejala user ada di rule
            foreach ($gejalaRequired as $gejalaId) {
                if (in_array($gejalaId, $gejalaIds)) {
                    $jumlahCocok++;
                }
            }

            // =========================
            // HITUNG TINGKAT KECOCOKAN
            // (jumlah cocok / total rule) × 100%
            // =========================
            $persentase = ($totalRule > 0)
                ? ($jumlahCocok / $totalRule) * 100
                : 0;

            // Simpan log (untuk pembuktian perhitungan)
            \Log::info("Perhitungan Penyakit ID {$penyakitId}", [
                'jumlah_cocok' => $jumlahCocok,
                'total_rule' => $totalRule,
                'persentase' => $persentase
            ]);

            // Ambil penyakit dengan nilai kecocokan tertinggi
            if ($persentase > $persentaseTertinggi) {
                $persentaseTertinggi = $persentase;
                $hasil = Penyakit::find($penyakitId);
            }
        }

        // =========================
        // 5. VALIDASI AMBANG MINIMAL (THRESHOLD)
        // Agar sistem tidak mendiagnosa dari 1 gejala saja
        // =========================
        $threshold = 40; // Minimal kecocokan 40%

        if ($persentaseTertinggi < $threshold) {
            $hasil = null;

            \Log::info('Diagnosis ditolak (kecocokan rendah)', [
                'persentase' => $persentaseTertinggi,
                'threshold' => $threshold
            ]);
        }

        // =========================
        // 6. JIKA TIDAK ADA HASIL
        // =========================
        if (!$hasil) {
            return view('user.hasil', [
                'hasil' => null,
                'pesan' => 'Tidak ditemukan penyakit yang sesuai dengan gejala yang dipilih. Silakan pilih gejala tambahan.',
                'gejalaDipilih' => $gejalaDipilih
            ]);
        }

        // =========================
        // 7. JIKA DIAGNOSIS DITEMUKAN
        // =========================
        return view('user.hasil', [
            'hasil' => $hasil,
            'gejalaDipilih' => $gejalaDipilih
        ]);
    }


    // =========================
    // SIMPAN DIAGNOSA
    // =========================
    public function simpan(Request $request)
    {
        $request->validate([
            'penyakit_id' => 'required|integer|exists:penyakit,id',
            'gejala_id'   => 'required|array',
            'gejala_id.*' => 'integer|exists:gejala,id'
        ]);

        // Simpan diagnosa utama
        $diagnosa = Diagnosa::create([
            'pengguna_id' => Auth::id(),
            'penyakit_id' => $request->penyakit_id,
            'tanggal'     => now(),
            'catatan'     => 'Diagnosa otomatis sistem'
        ]);

        // Simpan detail gejala yang dipilih
        foreach ($request->gejala_id as $gid) {
            DetailDiagnosa::create([
                'diagnosa_id' => $diagnosa->id,
                'gejala_id'   => $gid
            ]);
        }

        return redirect()->route('riwayat')
            ->with('success', 'Diagnosa berhasil disimpan ke riwayat.');
    }

    // =========================
    // RIWAYAT DIAGNOSA
    // =========================
    public function riwayat()
    {
        $riwayat = Diagnosa::where('pengguna_id', Auth::id())
            ->with(['penyakit', 'detailDiagnosa.gejala'])
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('user.riwayat', compact('riwayat'));
    }
}
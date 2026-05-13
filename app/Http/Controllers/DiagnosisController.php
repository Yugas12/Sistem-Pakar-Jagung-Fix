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
    // HALAMAN INPUT DIAGNOSA
    // =========================
    public function index()
    {
        // Ambil semua data gejala dari database
        $gejala = Gejala::all();

        // Kirim ke view untuk ditampilkan ke user
        return view('user.diagnosis', compact('gejala'));
    }

    // =========================
    // PROSES DIAGNOSA (FORWARD CHAINING + CERTAINTY FACTOR)
    // =========================
    public function proses(Request $request)
    {
        // =========================
        // 1. VALIDASI INPUT
        // =========================
        // Pastikan user memilih minimal 1 gejala
        $request->validate([
            'gejala' => 'required|array|min:1',
            'gejala.*' => 'string'
        ]);

        // Ambil kode gejala yang dipilih user (contoh: G1, G2)
        $kodeGejalaDipilih = $request->gejala;

        // Ambil nilai keyakinan user
        $cfUser = $request->cf_user;

        // =========================
        // 2. AMBIL DATA GEJALA DARI DATABASE
        // =========================
        // Ambil data gejala berdasarkan kode
        $gejalaDipilih = Gejala::whereIn('kode', $kodeGejalaDipilih)->get();

        // Jika tidak ditemukan gejala
        if ($gejalaDipilih->count() == 0) {
            return view('user.hasil', [
                'hasil' => null,
                'pesan' => 'Gejala tidak ditemukan.',
                'gejalaDipilih' => collect()
            ]);
        }

        // Ambil ID gejala (dipakai untuk proses perhitungan)
        $gejalaIds = $gejalaDipilih->pluck('id')->toArray();

        // =========================
        // 3. AMBIL SEMUA ATURAN (RELASI PENYAKIT-GEJALA)
        // =========================
        $semuaAturan = Aturan::all();

        // Kelompokkan aturan berdasarkan penyakit
        // Contoh hasil:
        // [1 => [1,2,3], 2 => [5,6,7]]
        $aturanPerPenyakit = [];
        foreach ($semuaAturan as $aturan) {
            $aturanPerPenyakit[$aturan->penyakit_id][] = $aturan->gejala_id;
        }

        // =========================
        // 4. PROSES PERHITUNGAN CF
        // =========================

        $hasil = null;           // Menyimpan penyakit terbaik
        $nilaiTertinggi = 0;     // Nilai CF tertinggi

        // Loop setiap penyakit
        foreach ($aturanPerPenyakit as $penyakitId => $gejalaRequired) {

            $cfGabungan = 0; // Nilai CF awal

            // Loop setiap gejala dalam rule penyakit
            foreach ($gejalaRequired as $gejalaId) {

                // Cek apakah gejala tersebut dipilih user
                if (in_array($gejalaId, $gejalaIds)) {

                    // Ambil nilai CF pakar dari tabel aturan
                    $aturan = Aturan::where('penyakit_id', $penyakitId)
                                    ->where('gejala_id', $gejalaId)
                                    ->first();

                    if ($aturan) {

                        // Ambil kode gejala
                        $kodeGejala = Gejala::find($gejalaId)->kode;

                        // Ambil nilai CF user berdasarkan kode gejala
                        $cfUserValue = isset($cfUser[$kodeGejala])
                            ? (float) $cfUser[$kodeGejala]
                            : 0;

                        // Hitung CF gejala
                        $cf = $aturan->cf_pakar * $cfUserValue;

                        // Gabungkan CF
                        if ($cfGabungan == 0) {
                            $cfGabungan = $cf;
                        } else {
                            $cfGabungan = $cfGabungan + ($cf * (1 - $cfGabungan));
                        }
                    }
                }
            }

            // Ubah ke persen
            $nilai = $cfGabungan * 100;

            // Debug log (opsional, bisa dihapus)
            \Log::info("CF Penyakit ID {$penyakitId}", [
                'cf' => $cfGabungan,
                'persentase' => $nilai
            ]);

            // Ambil penyakit dengan nilai CF tertinggi
            if ($nilai > $nilaiTertinggi) {
                $nilaiTertinggi = $nilai;
                $hasil = Penyakit::find($penyakitId);
            }
        }

        // =========================
        // 5. THRESHOLD (BATAS MINIMAL)
        // =========================
        // Agar sistem tidak asal menebak dari sedikit gejala
        $threshold = 40;

        if ($nilaiTertinggi < $threshold) {
            return view('user.hasil', [
                'hasil' => null,
                'pesan' => 'Tidak ditemukan penyakit dengan keyakinan cukup.',
                'gejalaDipilih' => $gejalaDipilih
            ]);
        }

        // =========================
        // 6. TAMPILKAN HASIL
        // =========================
        return view('user.hasil', [
            'hasil' => $hasil,
            'gejalaDipilih' => $gejalaDipilih,
            'persentase' => $nilaiTertinggi // nilai CF dalam persen
        ]);
    }

    // =========================
    // SIMPAN HASIL DIAGNOSA
    // =========================
    public function simpan(Request $request)
    {
        $request->validate([
            'penyakit_id' => 'required|integer|exists:penyakit,id',
            'cf_hasil'    => 'required|numeric',

            'gejala_id'   => 'required|array',
            'gejala_id.*' => 'integer|exists:gejala,id',

            'cf_user'     => 'required|array'
        ]);

        // =========================
        // SIMPAN DATA DIAGNOSA
        // =========================
        $diagnosa = Diagnosa::create([

            'pengguna_id' => Auth::id(),
            'penyakit_id' => $request->penyakit_id,

            // Simpan hasil Certainty Factor
            'cf_hasil'    => $request->cf_hasil,

            'tanggal'     => now()
        ]);

        // =========================
        // SIMPAN DETAIL GEJALA
        // =========================
        foreach ($request->gejala_id as $gid) {

            DetailDiagnosa::create([

                'diagnosa_id' => $diagnosa->id,
                'gejala_id'   => $gid,

                // Simpan CF User
                'cf_user'     => $request->cf_user[$gid] ?? 0

            ]);
        }

        // =========================
        // REDIRECT
        // =========================
        return redirect()->route('riwayat')
            ->with('success', 'Diagnosa berhasil disimpan.');
    }

    // =========================
    // RIWAYAT DIAGNOSA USER
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
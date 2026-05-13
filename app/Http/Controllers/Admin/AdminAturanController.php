<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aturan;
use App\Models\Penyakit;
use App\Models\Gejala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Controller ini digunakan untuk mengelola basis aturan
// antara penyakit dan gejala pada metode
// Forward Chaining + Certainty Factor.
class AdminAturanController extends Controller
{
    // =====================================================
    // TAMPILKAN TABEL MATRIX ATURAN
    // =====================================================
    // Menampilkan relasi penyakit dan gejala
    // dalam bentuk tabel matrix.
    public function index()
    {
        // Ambil semua penyakit
        $penyakit = Penyakit::all();

        // Ambil semua gejala
        $gejala = Gejala::all();

        // Ambil semua aturan
        $aturan = Aturan::all();

        // Mapping aturan:
        // penyakit_id => [gejala_id => cf_pakar]
        $aturanMap = [];

        foreach ($aturan as $a) {

            $aturanMap[$a->penyakit_id][$a->gejala_id]
                = $a->cf_pakar;

        }

        return view('admin.aturan.index', compact(
            'penyakit',
            'gejala',
            'aturanMap'
        ));
    }


    // =====================================================
    // FORM TAMBAH ATURAN
    // =====================================================
    // Menampilkan halaman tambah aturan.
    public function create()
    {
        return view('admin.aturan.create', [

            // Dropdown penyakit
            'penyakit' => Penyakit::all(),

            // List gejala
            'gejala' => Gejala::all(),

        ]);
    }


    // =====================================================
    // SIMPAN ATURAN
    // =====================================================
    // Menyimpan relasi penyakit-gejala beserta CF pakar.
    public function store(Request $request)
    {
        // ==========================
        // VALIDASI
        // ==========================
        $request->validate([

            'penyakit_id' => 'required|exists:penyakit,id',

            'gejala_id' => 'nullable|array',

            'cf_pakar' => 'nullable|array'

        ]);

        // ==========================
        // SIMPAN DATA
        // ==========================
        DB::transaction(function () use ($request) {

            // Hapus aturan lama
            // supaya tidak duplikat
            Aturan::where(
                'penyakit_id',
                $request->penyakit_id
            )->delete();

            // Simpan aturan baru
            foreach ($request->gejala_id ?? [] as $gid) {

                Aturan::create([

                    // Penyakit
                    'penyakit_id' => $request->penyakit_id,

                    // Gejala
                    'gejala_id' => $gid,

                    // Nilai Certainty Factor Pakar
                    'cf_pakar' => $request->cf_pakar[$gid] ?? 0

                ]);
            }

        });

        // Redirect kembali
        return redirect()
            ->route('admin.aturan.index')
            ->with(
                'success',
                'Aturan berhasil disimpan'
            );
    }


    // =====================================================
    // FORM EDIT ATURAN
    // =====================================================
    // Menampilkan aturan berdasarkan penyakit.
    public function edit($penyakitId)
    {
        // ==========================
        // GEJALA TERPILIH
        // ==========================
        $selectedGejala = Aturan::where(
            'penyakit_id',
            $penyakitId
        )
        ->pluck('gejala_id')
        ->toArray();

        // ==========================
        // NILAI CF PAKAR
        // ==========================
        // Format:
        // gejala_id => cf_pakar
        $cfPakar = Aturan::where(
            'penyakit_id',
            $penyakitId
        )
        ->pluck('cf_pakar', 'gejala_id')
        ->toArray();

        return view('admin.aturan.edit', [

            // Semua penyakit
            'penyakit' => Penyakit::all(),

            // Semua gejala
            'gejala' => Gejala::all(),

            // Penyakit yang sedang diedit
            'penyakitId' => $penyakitId,

            // Gejala yang aktif
            'selectedGejala' => $selectedGejala,

            // Penyakit terpilih
            'selectedPenyakit' => $penyakitId,

            // Nilai CF Pakar
            'cfPakar' => $cfPakar

        ]);
    }


    // =====================================================
    // UPDATE ATURAN
    // =====================================================
    // Mengupdate relasi penyakit dan gejala.
    public function update(Request $request, $penyakitId)
    {
        // ==========================
        // VALIDASI
        // ==========================
        $request->validate([

            'gejala_id' => 'nullable|array',

            'cf_pakar' => 'nullable|array'

        ]);

        DB::transaction(function () use (
            $request,
            $penyakitId
        ) {

            // ==========================
            // HAPUS RULE LAMA
            // ==========================
            Aturan::where(
                'penyakit_id',
                $penyakitId
            )->delete();

            // ==========================
            // SIMPAN RULE BARU
            // ==========================
            foreach ($request->gejala_id ?? [] as $gid) {

                Aturan::create([

                    // Penyakit
                    'penyakit_id' => $penyakitId,

                    // Gejala
                    'gejala_id' => $gid,

                    // CF Pakar
                    'cf_pakar' => $request->cf_pakar[$gid] ?? 0

                ]);
            }

        });

        return redirect()
            ->route('admin.aturan.index')
            ->with(
                'success',
                'Aturan berhasil diperbarui'
            );
    }


    // =====================================================
    // HAPUS SEMUA ATURAN PER PENYAKIT
    // =====================================================
    public function deleteByPenyakit($penyakitId)
    {
        // Hapus seluruh aturan penyakit
        Aturan::where(
            'penyakit_id',
            $penyakitId
        )->delete();

        return back()->with(
            'success',
            'Aturan berhasil dihapus'
        );
    }
}
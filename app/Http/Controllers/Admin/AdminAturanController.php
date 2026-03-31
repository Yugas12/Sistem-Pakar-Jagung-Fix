<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aturan;
use App\Models\Penyakit;
use App\Models\Gejala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Controller ini digunakan untuk mengelola basis aturan (knowledge base)
// yang menghubungkan gejala dengan penyakit dalam metode Forward Chaining.
class AdminAturanController extends Controller
{
    // =======================
    // TABEL MATRIKS
    // =======================
    // Menampilkan tabel matriks relasi penyakit vs gejala
    // Digunakan admin untuk melihat aturan yang sudah terbentuk.
    public function index()
    {
        $penyakit = Penyakit::all(); // ambil semua data penyakit
        $gejala   = Gejala::all();   // ambil semua data gejala

        // Mengelompokkan aturan berdasarkan penyakit_id
        // Hasilnya berupa mapping:
        // penyakit_id => [gejala_id, gejala_id, ...]
        $aturanMap = Aturan::all()
            ->groupBy('penyakit_id')
            ->map(function ($rows) {
                return $rows->pluck('gejala_id')->toArray();
            });

        return view('admin.aturan.index', compact(
            'penyakit',
            'gejala',
            'aturanMap'
        ));
    }


    // =======================
    // FORM CREATE
    // =======================
    // Menampilkan form untuk menambahkan aturan baru.
    public function create()
    {
        return view('admin.aturan.create', [
            'penyakit' => Penyakit::all(), // dropdown penyakit
            'gejala' => Gejala::all(),     // checklist gejala
        ]);
    }


    // =======================
    // SIMPAN
    // =======================
    // Menyimpan aturan relasi penyakit dan gejala ke database.
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'penyakit_id' => 'required|exists:penyakit,id',
            'gejala_id' => 'nullable|array'
        ]);

        // Menggunakan transaction agar data aman (rollback jika gagal)
        DB::transaction(function () use ($request) {

            // hapus rule lama jika ada (agar tidak duplikat)
            Aturan::where('penyakit_id', $request->penyakit_id)->delete();

            // simpan rule baru satu per satu
            foreach ($request->gejala_id ?? [] as $gid) {
                Aturan::create([
                    'penyakit_id' => $request->penyakit_id,
                    'gejala_id' => $gid
                ]);
            }
        });

        return redirect()->route('admin.aturan.index')
            ->with('success','Aturan berhasil disimpan');
    }


    // =======================
    // FORM EDIT
    // =======================
    // Menampilkan form edit aturan berdasarkan penyakit tertentu.
    public function edit($penyakitId)
    {
        // Ambil gejala yang sudah dipilih sebelumnya
        $selectedGejala = Aturan::where('penyakit_id', $penyakitId)
            ->pluck('gejala_id')
            ->toArray();

        return view('admin.aturan.edit', [
            'penyakit' => Penyakit::all(),
            'gejala' => Gejala::all(),
            'penyakitId' => $penyakitId,
            'selectedGejala' => $selectedGejala, // untuk checklist yang aktif
            'selectedPenyakit' => $penyakitId,
        ]);
    }


    // =======================
    // UPDATE
    // =======================
    // Memperbarui aturan penyakit dengan mengganti relasi gejala.
    public function update(Request $request, $penyakitId)
    {
        $request->validate([
            'gejala_id' => 'nullable|array'
        ]);

        DB::transaction(function () use ($request, $penyakitId) {

            // hapus rule lama
            Aturan::where('penyakit_id', $penyakitId)->delete();

            // simpan rule baru
            foreach ($request->gejala_id ?? [] as $gid) {
                Aturan::create([
                    'penyakit_id' => $penyakitId,
                    'gejala_id' => $gid
                ]);
            }
        });

        return redirect()->route('admin.aturan.index')
            ->with('success','Aturan berhasil diperbarui');
    }


    // =======================
    // DELETE RULE PER PENYAKIT
    // =======================
    // Menghapus seluruh aturan yang dimiliki satu penyakit.
    public function deleteByPenyakit($penyakitId)
    {
        Aturan::where('penyakit_id',$penyakitId)->delete();

        return back()->with('success','Aturan berhasil dihapus');
    }
}

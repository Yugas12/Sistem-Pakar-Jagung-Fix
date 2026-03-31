<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gejala;
use Illuminate\Http\Request;

// Controller ini digunakan untuk mengelola data gejala (CRUD)
// yang akan menjadi fakta awal dalam proses diagnosa Forward Chaining.
class AdminGejalaController extends Controller
{
    /**
     * Menampilkan daftar data gejala
     */
    public function index()
    {
        // Mengambil semua data gejala
        // lalu diurutkan berdasarkan ANGKA setelah huruf "G"
        // Contoh: G1, G2, G10 → akan dibaca sebagai 1,2,10 (bukan string)
        $gejala = Gejala::orderByRaw('CAST(SUBSTRING(kode, 2) AS UNSIGNED) ASC')->get();

        // Mengirim data ke halaman index gejala
        return view('admin.gejala.index', compact('gejala'));
    }

    /**
     * Menampilkan form tambah gejala
     */
    public function create()
    {
        // Menampilkan halaman form input gejala baru
        return view('admin.gejala.create');
    }

    /**
     * Menyimpan data gejala baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode' => 'required|unique:gejala,kode', // kode harus unik
            'nama' => 'required',                    // nama gejala wajib diisi
        ]);

        // Menyimpan data gejala ke database
        Gejala::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        // Redirect kembali ke halaman daftar gejala dengan pesan sukses
        return redirect()
            ->route('admin.gejala.index')
            ->with('success', 'Data gejala berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit gejala
     */
    public function edit(Gejala $gejala)
    {
        // Mengirim data gejala yang dipilih ke halaman edit
        return view('admin.gejala.edit', compact('gejala'));
    }

    /**
     * Memperbarui data gejala
     */
    public function update(Request $request, Gejala $gejala)
    {
        // Validasi saat update (kode tetap harus unik kecuali milik sendiri)
        $request->validate([
            'kode' => 'required|unique:gejala,kode,' . $gejala->id,
            'nama' => 'required',
        ]);

        // Update data gejala
        $gejala->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()
            ->route('admin.gejala.index')
            ->with('success', 'Data gejala berhasil diperbarui.');
    }

    /**
     * Menghapus data gejala
     */
    public function destroy(Gejala $gejala)
    {
        // Menghapus data gejala dari database
        $gejala->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()
            ->route('admin.gejala.index')
            ->with('success', 'Data gejala berhasil dihapus.');
    }
}

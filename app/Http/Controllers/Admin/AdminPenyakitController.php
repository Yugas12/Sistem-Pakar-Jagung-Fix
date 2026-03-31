<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penyakit;

// Controller ini digunakan untuk mengelola data penyakit (CRUD)
// Penyakit merupakan hasil akhir (kesimpulan) dari proses Forward Chaining.
class AdminPenyakitController extends Controller
{
    public function index()
    {
        // Mengambil semua data penyakit dan diurutkan berdasarkan kode (P01, P02, dst)
        $penyakit = Penyakit::orderBy('kode', 'asc')->get();

        // Mengirim data ke halaman daftar penyakit
        return view('admin.penyakit.index', compact('penyakit'));
    }

    public function create()
    {
        // Menampilkan form tambah data penyakit
        return view('admin.penyakit.create');
    }

    public function store(Request $request)
    {
        // Validasi input sebelum disimpan
        $request->validate([
            'kode'      => 'required|unique:penyakit,kode', // kode harus unik
            'nama'      => 'required',                      // nama penyakit wajib diisi
            'deskripsi' => 'required',                      // deskripsi penyakit wajib diisi
            'solusi'    => 'required',                      // solusi penanganan wajib diisi
        ]);

        // Menyimpan data penyakit ke database
        Penyakit::create([
            'kode'      => $request->kode,
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
            'solusi'    => $request->solusi,
        ]);

        // Redirect ke halaman daftar penyakit dengan pesan sukses
        return redirect()
            ->route('admin.penyakit.index')
            ->with('success', 'Data penyakit berhasil ditambahkan');
    }

    public function edit(Penyakit $penyakit)
    {
        // Menampilkan form edit dengan data penyakit yang dipilih
        return view('admin.penyakit.edit', compact('penyakit'));
    }

    public function update(Request $request, Penyakit $penyakit)
    {
        // Validasi saat update (kode tetap unik kecuali milik data ini)
        $request->validate([
            'kode'      => 'required|unique:penyakit,kode,' . $penyakit->id,
            'nama'      => 'required',
            'deskripsi' => 'required',
            'solusi'    => 'required',
        ]);

        // Memperbarui data penyakit
        $penyakit->update([
            'kode'      => $request->kode,
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
            'solusi'    => $request->solusi,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()
            ->route('admin.penyakit.index')
            ->with('success', 'Data penyakit berhasil diperbarui');
    }

    public function destroy(Penyakit $penyakit)
    {
        // Menghapus data penyakit dari database
        $penyakit->delete();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Data penyakit berhasil dihapus');
    }
}

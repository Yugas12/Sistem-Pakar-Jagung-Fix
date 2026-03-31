<?php

namespace App\Http\Controllers\Admin; // Menentukan namespace controller berada di folder Admin

use App\Http\Controllers\Controller;  // Memanggil class dasar Controller Laravel
use App\Models\Diagnosa;              // Model tabel diagnosa (data utama hasil diagnosa)
use App\Models\DetailDiagnosa;        // Model tabel detail_diagnosa (relasi gejala yang dipilih)

class AdminDiagnosaController extends Controller
{
    // Method destroy digunakan untuk menghapus data diagnosa berdasarkan ID
    public function destroy($id)
    {
        // Menghapus seluruh data detail diagnosa yang berelasi dengan diagnosa ini
        // Hal ini penting karena tabel detail_diagnosa memiliki foreign key diagnosa_id
        // Jika tidak dihapus dulu, akan terjadi error constraint di database
        DetailDiagnosa::where('diagnosa_id', $id)->delete();

        // Menghapus data diagnosa utama berdasarkan ID
        // findOrFail akan menampilkan error jika ID tidak ditemukan
        Diagnosa::findOrFail($id)->delete();

        // Mengembalikan ke halaman sebelumnya (dashboard admin)
        // sekaligus mengirim pesan sukses (flash message)
        return back()->with('success', 'Data diagnosa berhasil dihapus');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Diagnosa;
use App\Models\User;
use App\Models\Penyakit;
use App\Models\Gejala;

// Controller ini digunakan untuk mengelola halaman Dashboard Admin
// yang menampilkan statistik sistem dan riwayat diagnosa pengguna.
class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil nilai pencarian dari input (jika ada)
        $search = $request->search;

        // Mengambil data riwayat diagnosa beserta relasinya
        $riwayat = Diagnosa::with([
                'pengguna',              // relasi ke pengguna yang melakukan diagnosa
                'penyakit',              // relasi ke hasil penyakit
                'detailDiagnosa.gejala'  // relasi ke gejala yang dipilih
            ])
            // Jika ada keyword pencarian, filter berdasarkan nama pengguna
            ->when($search, function ($query) use ($search) {
                $query->whereHas('pengguna', function ($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%');
                });
            })
            // Urutkan berdasarkan tanggal terbaru
            ->orderBy('tanggal', 'desc')
            ->paginate(10)          // ⬅️ Menampilkan 10 data per halaman (pagination)
            ->withQueryString();    // ⬅️ Agar parameter search tetap terbawa saat pindah halaman

        // Mengirim data ke view dashboard admin
        return view('admin.dashboard', [
            'total_pengguna' => User::count(),      // jumlah seluruh pengguna
            'total_penyakit' => Penyakit::count(),  // jumlah data penyakit
            'total_gejala'   => Gejala::count(),    // jumlah data gejala
            'total_diagnosa' => Diagnosa::count(),  // jumlah seluruh diagnosa
            'riwayat'        => $riwayat,           // data riwayat diagnosa (paginated)
            'search'         => $search,            // keyword pencarian
        ]);
    }
}

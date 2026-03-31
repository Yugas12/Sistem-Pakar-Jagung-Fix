<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Diagnosa;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayat = Diagnosa::where('pengguna_id', Auth::id())
            ->with([
                'penyakit', 
                'detailDiagnosa.gejala' // Relasi yang sudah diperbaiki
            ])
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('user.riwayat', compact('riwayat'));
    }
}
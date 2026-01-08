<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    public function index()
    {
        // daftar gejala dari tabel/gambar kamu
        $gejala = [
            ['kode' => 'G1', 'nama' => 'Jagung berwarna kuning'],
            ['kode' => 'G2', 'nama' => 'Ada serbuk keputihan di batang'],
            ['kode' => 'G3', 'nama' => 'Batang berukuran kecil / lambatnya pertumbuhan tongkol'],
            ['kode' => 'G4', 'nama' => 'Jagung berwarna kuning'],
            ['kode' => 'G5', 'nama' => 'Adanya warna coklat pada tengah bercak'],
            ['kode' => 'G6', 'nama' => 'Bercak berwarna coklat kehijauan pada daun'],
            ['kode' => 'G7', 'nama' => 'Bercak berbentuk oval'],
            ['kode' => 'G8', 'nama' => 'Terdapat warna hitam pada bercak'],
            ['kode' => 'G9', 'nama' => 'Banyak bercak bulat hingga lonjong pada daun'],
            ['kode' => 'G10', 'nama' => 'Bercak berwarna kuning pada daun'],
            ['kode' => 'G11', 'nama' => 'Berwarna coklat pada tulang daun'],
            ['kode' => 'G12', 'nama' => 'Batang bawah berwarna coklat'],
            ['kode' => 'G13', 'nama' => 'Batang lembah dan lunak'],
            ['kode' => 'G14', 'nama' => 'Berbau busuk pada batang'],
            ['kode' => 'G15', 'nama' => 'Batang mudah patah'],
            ['kode' => 'G16', 'nama' => 'Terdapat bercak pada pelepah'],
            ['kode' => 'G17', 'nama' => 'Bercak berwarna orange pada pelepah'],
            ['kode' => 'G18', 'nama' => 'Terdapat bercak meluas pada pelepah'],
        ];

        return view('user.diagnosis', compact('gejala'));
    }

    public function proses(Request $request)
    {
        $pilihan = $request->input('gejala', []);

        // Sementara tampilkan hasilnya dulu (nanti bisa diolah pakai Forward Chaining)
        return view('user.hasil', compact('pilihan'));

    }
}

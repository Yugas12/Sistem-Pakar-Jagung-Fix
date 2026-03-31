<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model Penyakit merepresentasikan tabel 'penyakit'
// Tabel ini berisi daftar penyakit yang menjadi tujuan akhir
// dari proses penalaran metode Forward Chaining.
class Penyakit extends Model
{
    // Menentukan nama tabel yang digunakan oleh model ini
    protected $table = 'penyakit';

    // Menonaktifkan timestamps karena tabel tidak memiliki
    // kolom created_at dan updated_at
    public $timestamps = false;

    // Field yang boleh diisi secara mass assignment
    protected $fillable = [
        'kode',       // Kode penyakit (contoh: P01, P02)
        'nama',       // Nama penyakit
        'deskripsi',  // Penjelasan atau informasi penyakit
        'solusi'      // Solusi atau penanganan penyakit
    ];

    // 🔗 Relasi ke tabel aturan
    // Satu penyakit bisa memiliki banyak aturan (gejala-gejala)
    // yang menjadi dasar penentuan penyakit dalam sistem pakar
    public function aturan()
    {
        return $this->hasMany(Aturan::class, 'penyakit_id');
    }
}

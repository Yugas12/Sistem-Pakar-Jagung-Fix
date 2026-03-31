<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model Gejala merepresentasikan tabel 'gejala'
// Tabel ini menyimpan daftar gejala yang digunakan sebagai
// fakta awal dalam proses diagnosa metode Forward Chaining.
class Gejala extends Model
{
    // Menentukan nama tabel yang digunakan oleh model ini
    protected $table = 'gejala';

    // Menonaktifkan timestamps karena tabel tidak memiliki
    // kolom created_at dan updated_at
    public $timestamps = false;

    // Field yang boleh diisi secara mass assignment
    protected $fillable = [
        'kode', // Kode gejala (contoh: G01, G02)
        'nama', // Nama atau deskripsi gejala
    ];

    // 🔗 Relasi ke tabel aturan
    // Satu gejala bisa muncul di banyak aturan
    // karena satu gejala dapat dimiliki oleh beberapa penyakit
    public function aturan()
    {
        return $this->hasMany(Aturan::class, 'gejala_id');
    }
}

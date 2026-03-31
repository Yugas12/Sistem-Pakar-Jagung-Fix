<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model Aturan merepresentasikan tabel 'aturan' di database
// Tabel ini berfungsi sebagai penghubung antara penyakit dan gejala
// dalam basis pengetahuan sistem pakar (Forward Chaining).
class Aturan extends Model
{
    // Menentukan nama tabel yang digunakan oleh model ini
    protected $table = 'aturan';

    // Menonaktifkan timestamps karena tabel tidak memiliki
    // kolom created_at dan updated_at
    public $timestamps = false;

    // Menentukan field yang boleh diisi secara mass assignment
    // Field ini menyimpan relasi antara penyakit dan gejala
    protected $fillable = [
        'penyakit_id', // ID penyakit yang berhubungan dengan aturan
        'gejala_id'    // ID gejala yang menjadi syarat penyakit
    ];

    // Relasi ke model Penyakit
    // Setiap aturan hanya dimiliki oleh satu penyakit
    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'penyakit_id');
    }

    // Relasi ke model Gejala
    // Setiap aturan hanya terkait dengan satu gejala
    public function gejala()
    {
        return $this->belongsTo(Gejala::class, 'gejala_id');
    }
}
